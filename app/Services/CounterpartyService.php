<?php

namespace App\Services;

use App\Exceptions\FailMoyskladException;
use App\Models\Counterparty;
use App\Models\CounterpartyUpdate;
use App\Services\Dto\CounterpartyCreateDto;
use App\Services\Dto\CounterpartyUpdateDto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CounterpartyService
{
    public function create(CounterpartyCreateDto $dto): Counterparty
    {
        DB::beginTransaction();
        $data = [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'code' => $dto->getCode(),
            'actual_adress' => $dto->getAdress(),
        ];
        $localCounterparty = Counterparty::query()->create($data);
        $skladCounterparty = (new MoyskladClient())->createCounterparty($data);

        if($skladCounterparty->failed()) {
            DB::rollBack();            
            throw new FailMoyskladException();
        }

        $counterpartyResponse = json_decode($skladCounterparty, true);
        $localCounterparty->update([
            'sklad_id' => $counterpartyResponse['id'],
        ]);

        DB::commit();

        return $localCounterparty;

    }

    public function read($id): Counterparty
    {
        return Counterparty::query()->findOrFail($id);
    }

    public function update(CounterpartyUpdateDto $dto): Counterparty
    {
        DB::beginTransaction();        
        $data = [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'code' => $dto->getCode(),
            'actual_adress' => $dto->getAdress(),
        ];
        $localCounterparty = Counterparty::query()->find($dto->getId());

        foreach ($data as $field => $value) {
            $localCounterparty->$field = $value;
        }
        $arrayDataChanges = (new UpdateHelpService($localCounterparty))->createArray();

        if(empty($arrayDataChanges)) {
            DB::rollBack();
        } else {
            $skladCounterparty = (new MoyskladClient())->updateCounterparty($localCounterparty['sklad_id'],$data);
            $jsonDataChanges = json_encode($arrayDataChanges);        
            $localCounterparty->save(); 
            $dataCounterpartyUpdate = [
                'counterparty_id' => $localCounterparty->id,
                'changes' => $jsonDataChanges,
                'operator_id' => Auth::id(),
                'update_time' => Carbon::now(),
            ];
            CounterpartyUpdate::query()->create($dataCounterpartyUpdate);

            if($skladCounterparty->failed()) {
                DB::rollBack();            
                throw new FailMoyskladException();           
            }
        }

        DB::commit();       
        
        return $localCounterparty;         
    }

    public function delete($id): bool
    {
        DB::beginTransaction();
        $skladId = Counterparty::query()->where('id', $id)->value('sklad_id');        
        $localCounterparty = Counterparty::query()->where('id', $id)->delete();        
        $skladCounterparty = (new MoyskladClient())->deleteCounterparty($skladId);

        if($skladCounterparty->failed()) {
            DB::rollBack();
            throw new FailMoyskladException();
        }

        DB::commit();

        return $localCounterparty;
    }
}
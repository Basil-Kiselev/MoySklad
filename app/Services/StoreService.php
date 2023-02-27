<?php

namespace App\Services;

use App\Exceptions\FailMoyskladException;
use App\Models\Store;
use App\Services\Dto\StoreCreateDto;
use App\Services\Dto\StoreUpdateDto;
use Illuminate\Support\Facades\DB;

class StoreService
{
    public function create(StoreCreateDto $dto): Store
    {
        DB::beginTransaction();
        $data = [
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'adress' => $dto->getAdress(),
            'description' => $dto->getDescription(),
        ];
        $localStore = Store::query()->create($data);
        $skladStore = (new MoyskladClient())->createStore($data);

        if($skladStore->failed()) {
            DB::rollBack();
            throw new FailMoyskladException();
        }

        $storeResponse = json_decode($skladStore, true);
        $localStore->update([
            'sklad_id' => $storeResponse['id'],
        ]);

        DB::commit();

        return $localStore;
    }

    public function read($id): Store
    {
        return Store::query()->findOrFail($id);
    }

    public function update(StoreUpdateDto $dto): Store
    {
        DB::beginTransaction();
        $data = [
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'adress' => $dto->getAdress(),
            'description' => $dto->getDescription(),
        ];
        $localStore = Store::query()->find($dto->getId());
        $localStore->update($data);
        $skladStore = (new MoyskladClient())->updateStore($localStore['sklad_id'], $data);

        if($skladStore->failed()) {
            DB::rollBack();
            throw new FailMoyskladException();
        }

        DB::commit();

        return $localStore;        
    }

    public function delete($id): bool
    {
        DB::beginTransaction();
        $skladId = Store::query()->where('id', $id)->value('skald_id');
        $localStore = Store::query()->where('id', $id)->delete();
        $skladStore = (new MoyskladClient())->deleteStore($skladId);

        if($skladStore->failed()) {
            DB::rollBack();
            throw new FailMoyskladException();
        }

        DB::commit();

        return $localStore;        
    }
}
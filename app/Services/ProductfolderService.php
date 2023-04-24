<?php

namespace App\Services;

use App\Exceptions\FailMoyskladException;
use App\Models\Productfolder;
use App\Services\Dto\ProductfolderCreateDto;
use App\Services\Dto\ProductfolderUpdateDto;
use Illuminate\Support\Facades\DB;

class ProductfolderService
{
    public function create(ProductfolderCreateDto $dto): Productfolder
    {   
        DB::beginTransaction();
        $data = [
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'description' => $dto->getDescription(),
        ];

        $localProductfolder = Productfolder::query()->create($data);
        $skladProductfolder = (new MoyskladClient())->createProductfolder($data);

        if($skladProductfolder->failed()) {
            DB::rollBack();
            throw new FailMoyskladException();
        }

        $productfolderResponse = json_decode($skladProductfolder, true);
        $localProductfolder->update([
            'sklad_id' => $productfolderResponse['id'],
        ]);

        DB::commit();

        return $localProductfolder;        
    }
    
    public function read($id): Productfolder
    {
        return Productfolder::query()->findOrFail($id);
    }
    
    public function update(ProductfolderUpdateDto $dto): Productfolder
    {   
        DB::beginTransaction();
        $data = [
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'description' => $dto->getDescription(),
        ];        
        $localProductfolder = Productfolder::query()->find($dto->getId());
        $localProductfolder->update($data);
        $skladProductfolder = (new MoyskladClient())->updateProductfolder($localProductfolder['sklad_id'], $data);

        if($skladProductfolder->failed()) {
            DB::rollBack();
            throw new FailMoyskladException();
        }

        DB::commit();

        return $localProductfolder;        
    }
    
    public function delete($id): bool
    {   
        DB::beginTransaction();
        $skladId = Productfolder::query()->where('id', $id)->value('sklad_id');
        $localProductfolder = Productfolder::query()->where('id', $id)->delete();
        $skladProductfolder = (new MoyskladClient())->deleteProductfolder($skladId);

        if($skladProductfolder->failed()) {
            DB::rollBack();
            throw new FailMoyskladException();
        }

        DB::commit();

        return $localProductfolder;
    }
}
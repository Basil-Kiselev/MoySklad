<?php

namespace App\Services;

use App\Models\Productfolder;
use App\Services\Dto\ProductfolderCreateDto;
use App\Services\Dto\ProductfolderUpdateDto;

class ProductfolderService
{
    public function create(ProductfolderCreateDto $dto): Productfolder
    {
        return Productfolder::query()->create([
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'description' => $dto->getDescription(),
        ]);
    }
    
    public function read($id): Productfolder
    {
        return Productfolder::query()->findOrFail($id);
    }
    
    public function update(ProductfolderUpdateDto $dto): Productfolder
    {
        $result = Productfolder::query()->find($dto->getId());
        $result->update([
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'description' => $dto->getDescription(),
        ]);

        return $result;
    }
    
    public function delete($id): bool
    {
        return Productfolder::query()->where('id', $id)->delete();
    }
}
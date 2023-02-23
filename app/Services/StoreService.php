<?php

namespace App\Services;

use App\Models\Store;
use App\Services\Dto\StoreCreateDto;
use App\Services\Dto\StoreUpdateDto;

class StoreService
{
    public function create(StoreCreateDto $dto): Store
    {
        return Store::query()->create([
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'adress' => $dto->getAdress(),
            'description' => $dto->getDescription(),
        ]);
    }

    public function read($id): Store
    {
        return Store::query()->findOrFail($id);
    }

    public function update(StoreUpdateDto $dto): Store
    {
        $result = Store::query()->find($dto->getId());
        $result->update([
            'name' => $dto->getName(),
            'code' => $dto->getCode(),
            'adress' => $dto->getAdress(),
            'description' => $dto->getDescription(),
        ]);

        return $result;
    }

    public function delete($id): bool
    {
        return Store::query()->where('id', $id)->delete();
    }
}
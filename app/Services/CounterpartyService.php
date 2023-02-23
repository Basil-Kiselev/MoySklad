<?php

namespace App\Services;

use App\Models\Counterparty;
use App\Services\Dto\CounterpartyCreateDto;
use App\Services\Dto\CounterpartyUpdateDto;

class CounterpartyService
{
    public function create(CounterpartyCreateDto $dto): Counterparty
    {
        return Counterparty::query()->create([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'code' => $dto->getCode(),
            'actual_adress' => $dto->getAdress(),
        ]);
    }

    public function read($id): Counterparty
    {
        return Counterparty::query()->findOrFail($id);
    }

    public function update(CounterpartyUpdateDto $dto): Counterparty
    {
        $result = Counterparty::query()->find($dto->getId());
        $result->update([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'code' => $dto->getCode(),
            'actual_adress' => $dto->getAdress(),
        ]);

        return $result;
    }

    public function delete($id): bool
    {
        return Counterparty::query()->where('id',$id)->delete();
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Counterparty\CounterpartyCreateRequest;
use App\Http\Requests\Counterparty\CounterpartyUpdateRequest;
use App\Services\CounterpartyService;
use App\Services\Dto\CounterpartyCreateDto;
use App\Services\Dto\CounterpartyUpdateDto;
use Illuminate\Http\JsonResponse;

class CounterpartyController extends Controller
{
    public function createCounterparty(CounterpartyCreateRequest $counterpartyCreateRequest, CounterpartyService $counterpartyService)
    {
        $dto = new CounterpartyCreateDto(
            $counterpartyCreateRequest->getName(),
            $counterpartyCreateRequest->getEmail(),
            $counterpartyCreateRequest->getCode(),
            $counterpartyCreateRequest->getAdress(),
        );

        $result = $counterpartyService->create($dto);

        return new JsonResponse($result);
    }

    public function getCounterparty($id, CounterpartyService $counterpartyService)
    {
        $result = $counterpartyService->read($id);

        return new JsonResponse($result);
    }

    public function updateCounterparty(CounterpartyUpdateRequest $counterpartyUpdateRequest, CounterpartyService $counterpartyService)
    {
        $dto = new CounterpartyUpdateDto(
            $counterpartyUpdateRequest->getId(),
            $counterpartyUpdateRequest->getName(),
            $counterpartyUpdateRequest->getEmail(),
            $counterpartyUpdateRequest->getCode(),
            $counterpartyUpdateRequest->getAdress(),
        );

        $result = $counterpartyService->update($dto);

        return new JsonResponse($result);
    }

    public function deleteCounterparty($id, CounterpartyService $counterpartyService)
    {
        $result = $counterpartyService->delete($id);

        return new JsonResponse(['result' => $result]);
    }
}

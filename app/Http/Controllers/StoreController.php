<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreCreateRequest;
use App\Http\Requests\Store\StoreUpdateRequest;
use App\Services\Dto\StoreCreateDto;
use App\Services\Dto\StoreUpdateDto;
use App\Services\StoreService;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function createStore(StoreCreateRequest $storeCreateRequest, StoreService $storeService)
    {
        $dto = new StoreCreateDto(
            $storeCreateRequest->getName(),
            $storeCreateRequest->getCode(),
            $storeCreateRequest->getAdress(),
            $storeCreateRequest->getDescription(),
        );

        $result = $storeService->create($dto);

        return new JsonResponse($result);
    }

    public function getStore($id, StoreService $storeService)
    {
        $result = $storeService->read($id);

        return new JsonResponse($result);        
    }

    public function updateStore(StoreUpdateRequest $storeUpdateRequest, StoreService $storeService)
    {
        $dto = new StoreUpdateDto(
            $storeUpdateRequest->getId(),
            $storeUpdateRequest->getName(),
            $storeUpdateRequest->getCode(),
            $storeUpdateRequest->getAdress(),
            $storeUpdateRequest->getDescription(),
        );

        $result = $storeService->update($dto);

        return new JsonResponse($result);
    }

    public function deleteStore($id, StoreService $storeService)
    {
        $result = $storeService->delete($id);

        return new JsonResponse(['result' => $result]);
    }
}

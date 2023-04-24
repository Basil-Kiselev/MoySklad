<?php

namespace App\Http\Controllers;

use App\Http\Requests\Productfolder\ProductfolderCreateRequest;
use App\Http\Requests\Productfolder\ProductfolderUpdateRequest;
use App\Services\Dto\ProductfolderCreateDto;
use App\Services\Dto\ProductfolderUpdateDto;
use App\Services\ProductfolderService;
use Illuminate\Http\JsonResponse;

class ProductfolderController extends Controller
{
    public function createProductfolder(ProductfolderCreateRequest $productfolderCreateRequest, ProductfolderService $productfolderService)
    {
        $dto = new ProductfolderCreateDto(
            $productfolderCreateRequest->getName(),
            $productfolderCreateRequest->getCode(),
            $productfolderCreateRequest->getDescription(),
        );

        $result = $productfolderService->create($dto);

        return new JsonResponse($result);
    }

    public function getProductfolder($id, ProductfolderService $productfolderService)
    {
        $result = $productfolderService->read($id);

        return new JsonResponse($result);
    }

    public function updateProductfolder(ProductfolderUpdateRequest $productfolderUpdateRequest, ProductfolderService $productfolderService)
    {
        $dto = new ProductfolderUpdateDto(
            $productfolderUpdateRequest->getId(),
            $productfolderUpdateRequest->getName(),
            $productfolderUpdateRequest->getCode(),
            $productfolderUpdateRequest->getDescription(),
        );

        $result = $productfolderService->update($dto);

        return new JsonResponse($result);
    }

    public function deleteProductfolder($id, ProductfolderService $productfolderService)
    {
        $result = $productfolderService->delete($id);

        return new JsonResponse(['result' => $result]);
    }   
}

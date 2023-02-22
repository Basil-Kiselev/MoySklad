<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\Dto\ProductCreateDto;
use App\Services\Dto\ProductUpdateDto;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;


class ProductController extends Controller
{
    public function createProduct(ProductService $productService, ProductCreateRequest $productCreateRequest)
    {
        $dto = new ProductCreateDto(
            $productCreateRequest->getArticle(),
            $productCreateRequest->getCode(),
            $productCreateRequest->getName(),
            $productCreateRequest->getPrice(), 
        ); 

        $product = $productService->create($dto);

        return new JsonResponse($product);
    }

    public function getProduct($id, ProductService $productService)
    {              
        $result = $productService->read($id);
        
        return new JsonResponse($result);
    }

    public function updateProduct(ProductUpdateRequest $productUpdateRequest, ProductService $productService)
    {
        $dto = new ProductUpdateDto(
            $productUpdateRequest->getId(),
            $productUpdateRequest->getArticle(),
            $productUpdateRequest->getCode(),
            $productUpdateRequest->getName(),
            $productUpdateRequest->getPrice(),
        ); 
        
        $product = $productService->update($dto);

        return new JsonResponse($product);
    }

    public function deleteProduct($id, ProductService $productService)
    {               
        $result = $productService->delete($id);
        
        return new JsonResponse(['result' => $result]);
    }
}

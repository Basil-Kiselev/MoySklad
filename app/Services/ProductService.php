<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Dto\ProductCreateDto;
use App\Services\Dto\ProductUpdateDto;

class ProductService
{
    public function create(ProductCreateDto $dto): Product
    {           
        return Product::query()->create([
            'article' => $dto->getArticle(),    
            'code' => $dto->getCode(),    
            'name' => $dto->getName(),    
            'min_price' => $dto->getMinPrice(),    
        ]);
    }

    public function read(int $id): Product
    {        
        return Product::query()->findOrFail($id);        
    }

    public function update(ProductUpdateDto $dto): Product
    {
        $result = Product::query()->find($dto->getId());        
        $result->update([
            'article' => $dto->getArticle(),    
            'code' => $dto->getCode(),    
            'name' => $dto->getName(),    
            'min_price' => $dto->getMinPrice(),] 
        );

        return $result;
    }

    public function delete(int $id): bool
    {
        return Product::query()->where('id', $id)->delete();        
    }
}
<?php

namespace App\Services;

use App\Exceptions\FailMoyskladException;
use App\Models\Product;
use App\Models\ProductUpdate;
use App\Services\Dto\ProductCreateDto;
use App\Services\Dto\ProductUpdateDto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\UpdateHelpService;
use Carbon\Carbon;

class ProductService
{
    public function create(ProductCreateDto $dto): Product
    {   
        DB::beginTransaction();
        $data = [
            'article' => $dto->getArticle(),    
            'code' => $dto->getCode(),    
            'name' => $dto->getName(),    
            'min_price' => $dto->getMinPrice(),    
        ];        
        $localProduct = Product::query()->create($data); 
        $skladProduct = (new MoyskladClient())->createProduct($data);  

        if($skladProduct->failed()) {
            DB::rollBack();            
            throw new FailMoyskladException();
        }

        $productResponse = json_decode($skladProduct, true);             
        $localProduct->update([
            'sklad_id' => $productResponse['id'],
        ]);
        DB::commit();

        return $localProduct;
    }

    public function read(int $id): Product
    {        
        return Product::query()->findOrFail($id);        
    }

    public function update(ProductUpdateDto $dto): Product
    {   
        DB::beginTransaction();
        $data = [
            'article' => $dto->getArticle(),    
            'code' => $dto->getCode(),    
            'name' => $dto->getName(),    
            'min_price' => $dto->getMinPrice(),
        ];
        $localProduct = Product::query()->find($dto->getId());   
        
        foreach ($data as $field => $value) {
            $localProduct->$field = $value;
        }   
        $arrayDataChanges = (new UpdateHelpService($localProduct))->createArray();
        
        if(empty($arrayDataChanges)) {
            DB::rollBack();
        } else {
            $skladProduct = (new MoyskladClient())->updateProduct($localProduct['sklad_id'],$data);
            $jsonDataChanges = json_encode($arrayDataChanges);        
            $localProduct->save(); 
            $dataProductUpdate = [
                'product_id' => $localProduct->id,
                'changes' => $jsonDataChanges,
                'operator_id' => Auth::id(),
                'update_time' => Carbon::now(),
            ];
            ProductUpdate::query()->create($dataProductUpdate);

            if($skladProduct->failed()) {
                DB::rollBack();            
                throw new FailMoyskladException();           
            }
        }

        DB::commit();       
        
        return $localProduct;        
    }

    public function delete(int $id): bool
    {   
        DB::beginTransaction();
        $skladId = Product::query()->where('id', $id)->value('sklad_id');
        $localProduct = Product::query()->where('id', $id)->delete();  
        $skladProduct = (new MoyskladClient())->deleteProduct($skladId);

        if($skladProduct->failed()) {
            DB::rollBack();            
            throw new FailMoyskladException();
        }

        DB::commit();

        return $localProduct;

    }
}
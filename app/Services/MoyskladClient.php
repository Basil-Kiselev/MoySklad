<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoyskladClient
{  
    public static function authSklad()
    {
        return Http::withBasicAuth(env('MOYSKLAD_LOGIN'), env('MOYSKLAD_PASSWORD'));
    }    

    public function createProduct(array $data)
    {
        return $this->authSklad()->post(env('MOYSKLAD_URL'). '/entity/product', $data);
    }

    public function updateProduct(string $skladId, array $data)
    {       
        return $this->authSklad()->put(env('MOYSKLAD_URL') .'/entity/product/' . "$skladId", $data);
    }

    public function deleteProduct(string $skladId)
    {       
        return $this->authSklad()->delete(env('MOYSKLAD_URL') .'/entity/product/' . "$skladId");
    }
}
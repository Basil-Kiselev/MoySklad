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

    public function createCounterparty(array $data)
    {
        return $this->authSklad()->post(env('MOYSKLAD_URL') . '/entity/counterparty', $data);
    }

    public function updateCounterparty(string $skladId, array $data)
    {
        return $this->authSklad()->put(env('MOYSKLAD_URL') . '/entity/counterparty/' . "$skladId", $data);
    }

    public function deleteCounterparty(string $skladId)
    {
        return $this->authSklad()->delete(env('MOYSKLAD_URL') . '/entity/counterparty/' . $skladId);
    }

    public function createStore(array $data)
    {
        return $this->authSklad()->post(env('MOYSKLAD_URL'). '/entity/store', $data);
    }

    public function updateStore(string $skladId, array $data)
    {
        return $this->authSklad()->put(env('MOYSKLAD_URL') . '/entity/store/' . "$skladId", $data);
    }

    public function deleteStore(string $skladId)
    {
        return $this->authSklad()->delete(env('MOYSKLAD_URL') . '/entity/store/' . $skladId);
    }

    public function createProductfolder(array $data)
    {
        return $this->authSklad()->post(env('MOYSKLAD_URL'). '/entity/productfolder', $data);
    }

    public function updateProductfolder(string $skladId, array $data)
    {
        return $this->authSklad()->put(env('MOYSKLAD_URL') . '/entity/productfolder/' . "$skladId", $data);
    }

    public function deleteProductfolder(string $skladId)
    {
        return $this->authSklad()->delete(env('MOYSKLAD_URL') . '/entity/productfolder/' . $skladId);
    }
}
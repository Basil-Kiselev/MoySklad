<?php

namespace App\Services;

use App\Exceptions\WrongPassException;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception\InvalidOrderException;
use PhpParser\Node\Stmt\TryCatch;


class AuthService
{
    public function register(string $email, string $pass, string $name): string
    {
        /** @var User $user */
        $user = User::query()->create([
            'email' => $email,
            'password' => Hash::make($pass),
            'name' => $name,
       ]); 

       return $user->createToken('api')->plainTextToken;
       
    }  
    
    public function login(string $email, string $pass): string
    {
        $user = User::where('email', $email)->first();           

        if (!password_verify($pass, $user->password)) {  
            throw new WrongPassException();              
        } 
         
        return $user->createToken('api')->plainTextToken;
    }
}
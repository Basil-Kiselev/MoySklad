<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request, AuthService $authService)
    {
        $email = $request->getEmail();
        $name = $request->getName();
        $pass = $request->getPass();  
        $token = $authService->register($email, $pass, $name);

        return new JsonResponse(['token' => $token]);        
    }
}

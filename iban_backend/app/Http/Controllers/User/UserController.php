<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $userData = $request->only(['name', 'email', 'password']);
            $user = $this->userService->register($userData);
            $token = auth()->login($user);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'token' => $token,
                'user' => $user,
            ], 201);
        } catch (\Throwable $th) {
            return $this->ise($th);
        }
        
    }

    public function profile()
    {
        try {
            return response()->json([
                'success' => true,
                'user' => auth()->user(),
            ]);
        } catch (\Throwable $th) {
            return $this->ise($th);
        }
        
    }
}

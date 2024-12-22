<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\JsonResponse;

use function PHPSTORM_META\type;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $token = $this->authService->login($credentials);

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => trans('message.invalid_email_or_password'),
                ], 401);
            }
            return response()->json([
                'success' => true,
                'message' => trans('message.login_successful'),
                'token' => $token,
                'user' => auth()->user(),
            ]);
        } catch (\Throwable $th) {
            return $this->ise($th);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();

            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully',
            ]);
        } catch (\Throwable $th) {
            return $this->ise($th);
        }
    }
}

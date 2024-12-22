<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Iban\IbanController;

// system roles
$admin = config('config.role.admin');
$user = config('config.role.user');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api',"role:{$admin}"])->group(function () {
    Route::get('/ibans', [IbanController::class, 'index']);
});

Route::middleware(['auth:api',"role:{$user},{$admin}"])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('validate/iban', [IbanController::class, 'ibanValidate']);
});
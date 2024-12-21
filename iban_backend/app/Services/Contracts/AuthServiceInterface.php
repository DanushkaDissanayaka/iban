<?php

namespace App\Services\Contracts;

use App\Models\User;

interface AuthServiceInterface
{
    public function login(array $credentials);
}

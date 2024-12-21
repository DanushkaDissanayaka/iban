<?php

namespace App\Services\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    public function register(array $data): User;
}

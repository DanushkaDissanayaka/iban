<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface IbanRepositoryInterface
{
    public function create(array $data);
    public function getAll(?array $filters): array;
}

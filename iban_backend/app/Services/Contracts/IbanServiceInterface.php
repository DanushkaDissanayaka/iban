<?php

namespace App\Services\Contracts;


interface IbanServiceInterface
{
    public function create(array $payload);
    public function getAll(?int $perPage);
}

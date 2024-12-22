<?php

namespace App\Services;

use App\Repositories\Contracts\IbanRepositoryInterface;
use App\Services\Contracts\IbanServiceInterface;

class IbanService implements IbanServiceInterface
{
    private IbanRepositoryInterface $ibanRepository;
    public function __construct(IbanRepositoryInterface $ibanRepository)
    {
        $this->ibanRepository = $ibanRepository;
    }
    public function create(array $data)
    {
        // check if iban number is valid
        // if valid save number in to database
        $this->ibanRepository->create($data);
    }

    public function getAll(?array $filters): array
    {
        return $this->ibanRepository->getAll($filters);
    }
}

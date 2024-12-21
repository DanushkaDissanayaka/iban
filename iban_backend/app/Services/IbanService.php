<?php

namespace App\Services;

use App\Repositories\Eloquent\IbanRepository;
use App\Services\Contracts\IbanServiceInterface;

class IbanService implements IbanServiceInterface
{
    private IbanRepository $ibanRepository;
    public function __construct(IbanRepository $ibanRepository)
    {
        $this->ibanRepository = $ibanRepository;
    }
    public function create(array $data) {
        // check if iban number is valid
        // if valid save number in to database
        $this->ibanRepository->create($data);
    }

    public function getAll(?int $perPage) {

        return $this->ibanRepository->getAll($perPage ?? config('config.default_per_page'));
    }
}

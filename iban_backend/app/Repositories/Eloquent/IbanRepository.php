<?php

namespace App\Repositories\Eloquent;

use App\Models\Iban;
use App\Repositories\Contracts\IbanRepositoryInterface;

class IbanRepository implements IbanRepositoryInterface
{
    public function create(array $data)
    {
        Iban::firstOrCreate(
            ['number' => $data['number']],
            $data
        );
    }
    public function getAll(int $perPage)
    {
        $ibans = Iban::with('user')->paginate($perPage);

        return [
            'data' => $ibans->items(),
            'current_page' => $ibans->currentPage(),
            'total_pages' => $ibans->lastPage(),
            'total_items' => $ibans->total(),
            'per_page' => $perPage
        ];
    }
}

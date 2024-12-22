<?php

namespace App\Repositories\Eloquent;

use App\Models\Iban;
use App\Repositories\Contracts\IbanRepositoryInterface;

class IbanRepository extends BaseRepository  implements IbanRepositoryInterface
{
    public function create(array $data)
    {
        Iban::firstOrCreate(
            ['number' => $data['number']],
            $data
        );
    }
    public function getAll(?array $filters): array
    {
        $filters = $this->prepareCollectionFilters($filters);

        $query = Iban::query();

        if ($filters->search_text) {
            $query->WhereHas('user', function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters->search_text}%");
            });
        }

        $ibans = $query->with('user')->orderBy('created_at', 'DESC')->paginate($filters->per_page);

        return $this->prepareCollectionResponse($ibans, $filters);
    }
}

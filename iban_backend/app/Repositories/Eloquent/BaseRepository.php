<?php
namespace App\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BaseRepository {
    protected function prepareCollectionFilters(?array $filters):object {
        $filters['search_text'] = $filters['search_text'] ?? '';
        $filters['per_page'] = $filters['per_page'] ?? config('config.default_per_page');
        return (object) $filters;
    }

    protected function prepareCollectionResponse(LengthAwarePaginator $pagedCollection, object $filters):array {
        return [
            'data' => $pagedCollection->items(),
            'current_page' => $pagedCollection->currentPage(),
            'total_pages' => $pagedCollection->lastPage(),
            'total_items' => $pagedCollection->total(),
            'per_page' => $filters->per_page
        ];
    }
}
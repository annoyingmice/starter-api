<?php

namespace Packages\User\App\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Packages\User\App\Models\User;

final class ListUsersAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function execute(
        User $user,
        array $columns = ["*"]
    ): LengthAwarePaginator {
        return $user
            ->query()
            ->applyFilters(filters: request()->get(key: "filters", default: []))
            ->applySearches(
                searches: request()->get(key: "searches", default: [])
            )
            ->applyBetween(between: request()->get(key: "between", default: []))
            ->applySort(sort: request()->get(key: "sort", default: null))
            ->applyRelations(
                relations: request()->get(key: "relations", default: null)
            )
            ->paginate(
                perPage: request()->get(key: "per_page", default: 10),
                columns: $columns
            );
    }
}

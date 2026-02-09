<?php

declare(strict_types=1);

namespace Core\Web\Users\Queries;

use Core\Domain\Users\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final class UserIndexQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = User::query();

        parent::__construct($query, $request);

        $this->allowedFilters([])
            ->allowedSorts([])
            ->allowedIncludes(["phone", "email", "address"])
            ->defaultSorts(["created_at"]);
    }
}

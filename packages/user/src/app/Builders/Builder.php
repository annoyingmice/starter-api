<?php

namespace Packages\User\App\Builders;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class Builder extends EloquentBuilder
{
    /**
     * Apply filters to the query.
     *
     * @param array $filters
     * @return $this
     *
     * Example:
     *
     * If the url query is: ?filters[column]=value
     *
     */
    public function applyFilters(array $filters)
    {
        foreach ($filters as $column => $value) {
            $this->where($column, $value);
        }

        return $this;
    }

    /**
     * Apply searches to the query.
     *
     * @param array $searches
     * @return $this
     *
     * Example:
     *
     * If the url query is: ?searches[column]=value
     *
     */
    public function applySearches(array $searches)
    {
        foreach ($searches as $column => $value) {
            $this->where($column, 'LIKE', "%{$value}%");
        }

        return $this;
    }

    /**
     * Apply sorting to the query.
     *
     * @param array $sorts
     * @return $this
     *
     * Example:
     *
     * If the url query is: ?sorts=-column
     *
     */
    public function applySort(?string $sort)
    {
        if($sort) {
            $this->orderBy(ltrim($sort, '-'), str_starts_with($sort, '-') ? 'desc' : 'asc');
        }

        return $this;
    }

    /**
    * Apply eager loading of relationships to the query.
    *
    * @param array|string $relations
    * @return $this
    *
    * Example:
     *
     * If the url query is: ?relations=relation1,relation2
    */
    public function applyRelations(?string $relations)
    {
        if($relations) {
            $this->with(relations: explode(',', $relations));
        }

        return $this;
    }

    /**
    * Apply eager loading of relationships to the query.
    *
    * @param array $between
    * @return $this
    *
    * Example:
     *
     * If the url query is: ?between[column]=from,to
    */
    public function applyBetween(array $between)
    {
        foreach($between as $column => $value) {
            [$from, $to] = explode(",", $value);

            $this->whereBetween(
                column: $column,
                value: [$from, $to],
            );
        }

        return $this;
    }
}

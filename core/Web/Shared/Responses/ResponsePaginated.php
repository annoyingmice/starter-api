<?php

declare(strict_types=1);

namespace Core\Web\Shared\Responses;

use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class ResponsePaginated extends PaginatedResourceResponse
{
    /** @var LengthAwarePaginator */
    protected LengthAwarePaginator $pagination;

    /**
     * Create a new resource response.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct(public $resource)
    {
        parent::__construct($resource);

        // Check if resource is paginated
        if ($resource instanceof LengthAwarePaginator) {
            $this->pagination = $resource;
        }
    }

    /**
     * Gather the meta data for the response.
     *
     * @param  array  $paginated
     * @return array
     */
    protected function meta($paginated): array
    {
        return Arr::except($paginated, [
            "data",
            "links",
            "path",
            "first_page_url",
            "last_page_url",
            "prev_page_url",
            "next_page_url",
        ]);
    }
}

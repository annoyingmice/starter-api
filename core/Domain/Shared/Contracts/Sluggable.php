<?php

namespace Core\Domain\Shared\Contracts;

interface Sluggable
{
    /**
     * Define the source field for the slug (e.g., 'name' or 'title').
     */
    public function slugSource(): string;
}

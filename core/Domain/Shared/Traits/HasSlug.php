<?php

namespace Core\Domain\Shared\Traits;

use Spatie\Sluggable\{HasSlug as HasSluggable, SlugOptions};

trait HasSlug
{
    use HasSluggable;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fieldName: fn() => "{$this->slugSource()}-" . now())
            ->saveSlugsTo(fieldName: "slug")
            ->preventOverwrite()
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return "slug";
    }
}

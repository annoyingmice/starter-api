<?php

namespace Core\Domain\Phones\Models;

use Core\Domain\Shared\Contracts\Sluggable;
use Core\Domain\Shared\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model implements Sluggable
{
    use HasSlug, HasFactory, SoftDeletes;

    protected $fillable = [
        "slug",
        "phoneable_type",
        "phoneable_id",
        "country_code",
        "number",
        "primary"
    ];

    protected function casts(): array
    {
        return [
            "primary" => "boolean",
        ];
    }

    public function slugSource(): string
    {
        return 'phone';
    }
}

<?php

namespace Core\Domain\Addresses\Models;

use Core\Domain\Shared\Contracts\Sluggable;
use Core\Domain\Shared\Traits\HasSlug;
use Core\Infrastructure\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model implements Sluggable
{
    use HasActivity, HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        "slug",
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'primary'
    ];

    protected function casts(): array
    {
        return [
            "primary" => "boolean"
        ];
    }

    public function slugSource(): string
    {
        return 'address';
    }
}

<?php

namespace Core\Domain\Emails\Models;

use Core\Domain\Shared\Contracts\Sluggable;
use Core\Domain\Shared\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model implements Sluggable
{
    use HasSlug, HasFactory, SoftDeletes;

    protected $fillable = [
        "slug",
        "emailable_type",
        "emailable_id",
        "email",
        "email_verified_at",
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
        return 'email';
    }
}

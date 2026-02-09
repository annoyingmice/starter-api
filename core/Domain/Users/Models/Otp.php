<?php

namespace Core\Domain\Users\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Core\Domain\Shared\Contracts\Sluggable;
use Core\Domain\Shared\Traits\HasSlug;
use Core\Infrastructure\Users\Observers\OtpObserver;

#[ObservedBy([OtpObserver::class])]
class Otp extends Model implements Sluggable
{
    use HasSlug, HasFactory, SoftDeletes;

    /** @var array<string> */
    protected $fillable = [
        "slug",
        "user_id",
        "code"
    ];

    /** @return string */
    public function slugSource(): string
    {
        return "otp";
    }

    /** @return BelongsTo<User> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }
}

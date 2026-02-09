<?php

namespace Core\Domain\Users\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Core\App\Users\Auth\Notifications\VerifyEmail;
use Core\Domain\Shared\Contracts\{Sluggable, TwoFactorable};
use Core\Domain\Shared\Traits\{HasAddress, HasEmail, HasPhone, HasSlug, InteractsWithEmailVerification, MustHaveActiveAccount};
use Core\Domain\Users\Builders\UserBuilder;
use Core\Domain\Users\Enums\UserStatus;
use Core\Infrastructure\Traits\HasOtp;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail, Sluggable, TwoFactorable
{
    use HasAddress,
        HasApiTokens,
        HasEmail,
        HasOtp,
        HasPhone,
        HasSlug,
        InteractsWithEmailVerification,
        MustHaveActiveAccount,
        Notifiable,
        SoftDeletes;

    /** @var array<string> */
    protected $fillable = [
        "slug",
        "first_name",
        "middle_name",
        "last_name",
        "password",
        "status",
    ];

    /** @var array<int, string> */
    protected $hidden = ["password", "remember_token"];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            "password" => "hashed",
            "status" => UserStatus::class,
        ];
    }

    /** @return string */
    public function slugSource(): string
    {
        return "user";
    }

    /** @param \Illuminate\Database\Query\Builder $query */
    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }

    /** @return void */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail());
    }

    /** @return HasMany<Otp> */
    public function otps(): HasMany
    {
        return $this->hasMany(related: Otp::class);
    }
}

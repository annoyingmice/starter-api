<?php

namespace Packages\User\App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Packages\User\App\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Packages\Otp\App\Models\Otp;
use Packages\User\App\Auth\Notifications\VerifyEmail;
use Packages\User\App\Enums\UserStatus;
use Packages\User\App\Traits\{HasOtp, ScopeUser};
use Packages\User\Database\Factories\UserFactory;
use Spatie\Sluggable\{HasSlug, SlugOptions};

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,
        HasFactory,
        HasOtp,
        HasSlug,
        Notifiable,
        ScopeUser,
        SoftDeletes;

    /** @var array<string> */
    protected $fillable = [
        "slug",
        "first_name",
        "middle_name",
        "last_name",
        "phone_number",
        "email",
        "password",
        "status",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
            "status" => UserStatus::class,
        ];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Packages\User\App\Builders\UserBuilder A new Eloquent query builder for the model.
     */
    public function newEloquentBuilder($query): Builder
    {
        return new UserBuilder($query);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    /**
     * The "booted" method of the model.
     *
     * @return \App\Builders\UserBuilder
     */
    public static function query(): UserBuilder
    {
        return parent::query();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fieldName: fn($model) => "user_" . now())
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

    /**
     * Send the email verification notification.
     *
     * @return void
     */
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

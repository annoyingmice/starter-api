<?php

namespace Core\Domain\Users\Events;

use Core\Domain\Users\Models\User;
use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct(public User $user)
    { }
}

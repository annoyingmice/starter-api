<?php

namespace Packages\User\App\Events;

use Illuminate\Queue\SerializesModels;
use Packages\User\App\Models\User;

class Registered
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

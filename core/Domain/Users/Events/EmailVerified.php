<?php

namespace Core\Domain\Users\Events;

use Core\Domain\Users\Models\User;
use Core\Web\Users\Resources\UserResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailVerified implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('user.' . $this->user->slug),
        ];
    }

    /**
     * (Optional) Clean up the data sent to Vue.
     * You don't want to send the password_hash or other secrets!
     */
    public function broadcastWith(): array
    {
        $this->user->loadMissing([
            "email",
            "phone",
            "address",
        ]);

        return (new UserResource($this->user))
            ->resolve(request());
    }

    /**
     * The name the frontend will listen for.
     */
    public function broadcastAs(): string
    {
        return 'EmailVerified';
    }
}

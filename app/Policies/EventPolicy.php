<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Event $event)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }


    public function update(User $user, Event $event)
    {
        return false;
    }

    public function delete(User $user, Event $event)
    {
        return false;
    }

    public function bookBooth(User $user, Event $event)
    {
        // Only allow requesters to book booths if the event is not canceled
        return $user->role === 'requester' && $event->status !== 'canceled';
    }
}

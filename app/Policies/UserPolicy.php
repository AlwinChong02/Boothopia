<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // View all users (only Admin)
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    //currentUser - logged in user
    // profile - the profile that you try to take action on

    // View a specific user's profile
    public function view(User $currentUser, User $profile)
    {
        return $currentUser->id === $profile->id;
    }

    // Update user profile
    public function update(User $currentUser, User $profile)
    {
        return $currentUser->id === $profile->id || $currentUser->role === 'admin';
    }

    // Delete user profile (only Admin)
    public function delete(User $currentUser, User $profile)
    {
        return $currentUser->role === 'admin';
    }

    // (Optional) Create user profile — usually handled via registration
    public function create(User $user)
    {
        return true;
    }
}

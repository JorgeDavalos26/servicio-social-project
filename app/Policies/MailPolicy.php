<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailPolicy
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

    public function before(User $user, $ability)
    {
        if ($user->is_admin) { // if he is admin do not even try to check policies, let him in
            return true;
        } else { // if he is support or normal user, lets continue checking policies...
            return null;
        }
    }

    public function sendFormCompletedMail(User $user)
    {
        return false;
    }

}

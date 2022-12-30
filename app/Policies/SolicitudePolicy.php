<?php

namespace App\Policies;

use App\Models\Solicitude;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class SolicitudePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) { // if he is admin do not even try to check policies, let him in
            return true;
        }
        else { // if he is support or normal user, lets continue checking policies...
            return null;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Solicitude  $solicitude
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function show(User $user, Solicitude $solicitude)
    {
        if (!$user->is_support && $solicitude->user_id != $user->id) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function store(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Solicitude  $solicitude
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Solicitude $solicitude)
    {
        if ($user->is_support) {
            return false;
        }
        else {
            if ($solicitude->user_id != $user->id) {
                return false;
            }
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Solicitude  $solicitude
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, Solicitude $solicitude)
    {
        if ($user->is_support) {
            return false;
        }
        else {
            if ($solicitude->user_id != $user->id) {
                return false;
            }
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Solicitude  $solicitude
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Solicitude $solicitude)
    {
        if ($user->is_support) {
            return false;
        }
        else {
            if ($solicitude->user_id != $user->id) {
                return false;
            }
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Solicitude  $solicitude
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Solicitude $solicitude)
    {
        if ($user->is_support) {
            return false;
        }
        else {
            if ($solicitude->user_id != $user->id) {
                return false;
            }
            return true;
        }
    }

    public function getComplete(User $user, Solicitude $solicitude)
    {
        if (!$user->is_support && $solicitude->user_id != $user->id) {
            return false;
        }
        return true;
    }
}

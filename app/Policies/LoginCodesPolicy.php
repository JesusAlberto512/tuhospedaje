<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\LoginCodes;
use App\Models\User;

class LoginCodesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, LoginCodes $loginCodes)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, LoginCodes $loginCodes)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, LoginCodes $loginCodes)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, LoginCodes $loginCodes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LoginCodes  $loginCodes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, LoginCodes $loginCodes)
    {
        //
    }
}

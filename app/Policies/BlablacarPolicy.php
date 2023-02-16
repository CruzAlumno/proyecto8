<?php

namespace App\Policies;

use App\Models\Blablacar;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlablacarPolicy {
    use HandlesAuthorization;
    // Autorizar al Admin Hacer Cualquier Accion:
    public function before(User $user, $ability) {
        // Se usa Para autorizar a los administradores a realizar cualquier acción:
        if($user->id === 1) return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Blablacar $blablacar) {
        //return $user->id === $blablacar->customer_id;
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) {
        //return $user->id === 1;
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Blablacar $blablacar) {
        return $user->id === $blablacar->customer_id;
        //return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Blablacar $blablacar) {
        return $user->id === $blablacar->customer_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Blablacar $blablacar)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Blablacar $blablacar)
    {
        //
    }
}

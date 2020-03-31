<?php

namespace App\Observers;

use App\User;
use App\ActivityLog;
use Auth;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if($user->isDirty('name') || $user->isDirty('password'))
        {
            $description = '';
            if($user->isDirty('name'))
                $description .= 'Alterou o nome do usuário de "' . $user->getOriginal('name') . '" para "' . $user->name . '". ';
            if($user->isDirty('password'))
                $description .= 'Alterou a senha do usuário. ';
            ActivityLog::create([
                'type'        => 'Edição de Usuário',
                'model'       => 'App\User',
                'model_id'    => $user->id,
                'description' => $description,
                'users_id'    => Auth::user()->id,
            ]);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Client;
use App\ActivityLog;
use Auth;

class ClientObserver
{
    /**
     * Handle the client "created" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function created(Client $client)
    {
        //
    }

    /**
     * Handle the client "updated" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function updated(Client $client)
    {
        if($client->isDirty('name') || $client->isDirty('email'))
        {
            $description = '';
            if($client->isDirty('name'))
                $description .= 'Alterou o nome do cliente de "' . $client->getOriginal('name') . '" para "' . $client->name . '". ';
            if($client->isDirty('email'))
                $description .= 'Alterou o email do cliente de "' . $client->getOriginal('email') . '" para "' . $client->email . '". ';
            ActivityLog::create([
                'type'        => 'Edição de Usuário',
                'model'       => 'App\Client',
                'model_id'    => $client->id,
                'description' => $description,
                'users_id'    => Auth::user()->id,
            ]);
        }
    }

    /**
     * Handle the client "deleted" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {
        //
    }

    /**
     * Handle the client "restored" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the client "force deleted" event.
     *
     * @param  \App\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}

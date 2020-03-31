<?php

namespace App\Observers;

use App\Phone;
use App\ActivityLog;
use Auth;

class PhoneObserver
{
    /**
     * Handle the phone "created" event.
     *
     * @param  \App\Phone  $phone
     * @return void
     */
    public function created(Phone $phone)
    {
        //
    }

    /**
     * Handle the phone "updated" event.
     *
     * @param  \App\Phone  $phone
     * @return void
     */
    public function updated(Phone $phone)
    {
        if($phone->isDirty('number'))
        {
            $description = 'Alterou o número do telefone de "' . $phone->getOriginal('number') . '" para "' . $phone->number . '". ';
            ActivityLog::create([
                'type'        => 'Edição de Telefone',
                'model'       => 'App\Phone',
                'model_id'    => $phone->id,
                'description' => $description,
                'users_id'    => Auth::user()->id,
            ]);
        }
    }

    /**
     * Handle the phone "deleted" event.
     *
     * @param  \App\Phone  $phone
     * @return void
     */
    public function deleted(Phone $phone)
    {
        //
    }

    /**
     * Handle the phone "restored" event.
     *
     * @param  \App\Phone  $phone
     * @return void
     */
    public function restored(Phone $phone)
    {
        //
    }

    /**
     * Handle the phone "force deleted" event.
     *
     * @param  \App\Phone  $phone
     * @return void
     */
    public function forceDeleted(Phone $phone)
    {
        //
    }
}

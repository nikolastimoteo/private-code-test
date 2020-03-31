<?php

namespace App\Observers;

//use Spatie\Permission\Models\Role;
use App\Group;
use App\ActivityLog;
use Auth;

class GroupObserver
{
    /**
     * Handle the group "created" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        //
    }

    /**
     * Handle the group "updated" event.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \App\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        if($group->isDirty('display_name'))
        {
            $description = 'Alterou o nome do grupo de "' . $group->getOriginal('display_name') . '" para "' . $group->display_name . '". ';
            ActivityLog::create([
                'type'        => 'Edição de Grupo',
                'model'       => 'App\Group',
                'model_id'    => $group->id,
                'description' => $description,
                'users_id'    => Auth::user()->id,
            ]);
        }
    }

    /**
     * Handle the group "deleted" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }

    /**
     * Handle the group "restored" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function restored(Group $group)
    {
        //
    }

    /**
     * Handle the group "force deleted" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}

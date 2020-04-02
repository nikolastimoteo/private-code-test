<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @var array
     */
    protected $fillable = [
        'type', 'description', 'model', 'model_id', 'users_id',
    ];

    /**
     * Get the user that owns the activity log.
     * 
     * @author Níkolas Timóteo <nikolas@dzp.net.br>
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id')->withTrashed();
    }

    /**
     * Get the object related to the activity log.
     * 
     * @author Níkolas Timóteo <nikolas@dzp.net.br>
     * @return Illuminate\Database\Eloquent\Model
     */
    public function modelObject()
    {
        return $this->model::withTrashed()->find($this->model_id);
    }
}

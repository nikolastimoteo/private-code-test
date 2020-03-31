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
        return $this->belongsTo('App\User', 'users_id');
    }

    public function modelObject()
    {
        return $this->model::find($this->model_id);
    }
}

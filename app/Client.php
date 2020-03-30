<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'users_id',
    ];

    /**
     * Get the user (admin) that owns the client.
     * 
     * @author Níkolas Timóteo <nikolas@dzp.net.br>
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * Get all the phones from the client.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return Collection<App\Phone>
     */
    public function phones()
    {
        return $this->hasMany('App\Phone', 'clients_id');
    }
}
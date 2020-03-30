<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'users_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Check is the user is Admin.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->users_id == null;
    }

    /**
     * Get all the clients from the user (admin).
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return Collection<App\Client>
     */
    public function clients()
    {
        return $this->hasMany('App\Client', 'users_id');
    }

    /**
     * Get the admin of the user.
     * 
     * @author Níkolas Timóteo <nikolas@dzp.net.br>
     * @return App\User
     */
    public function admin()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * Get all the users from the admin.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return Collection<App\User>
     */
    public function users()
    {
        return $this->hasMany('App\User', 'users_id');
    }
}

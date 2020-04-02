<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

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
     * Get the admin of the user (RELATIONSHIP).
     * 
     * @author Níkolas Timóteo <nikolas@dzp.net.br>
     * @return App\User
     */
    public function myAdmin()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * Get the admin user (NOT A RELATIONSHIP).
     * 
     * @author Níkolas Timóteo <nikolas@dzp.net.br>
     * @return App\User
     */
    public function admin()
    {
        if($this->isAdmin())
            return $this;
        return $this->myAdmin;
    }

    /**
     * Get all the users of the admin.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return Collection<App\User>
     */
    public function users()
    {
        return $this->hasMany('App\User', 'users_id');
    }

    /**
     * Get all the users of the admin (WITH TRASHED).
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return Collection<App\User>
     */
    public function usersWithTrashed()
    {
        return $this->hasMany('App\User', 'users_id')->withTrashed();
    }

    /**
     * Get all the activity logs from the user.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return Collection<App\ActivityLog>
     */
    public function activityLogs()
    {
        return $this->hasMany('App\ActivityLog', 'users_id')->orderBy('created_at', 'DESC');
    }

    /**
     * Returns a string that represents the object.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return string
     */
    public function __toString()
    {
        return ($this->deleted_at != null) ? '(Excluído) ' . $this->name : '(ID: '. $this->id .') ' . $this->name;
    }
}

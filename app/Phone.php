<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @var array
     */
    protected $fillable = [
        'number', 'clients_id',
    ];

    /**
     * Get the client that owns the phone.
     * 
     * @author Níkolas Timóteo <nikolas@dzp.net.br>
     * @return App\Client
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'clients_id');
    }

    /**
     * Returns a string that represents the object.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return string
     */
    public function __toString()
    {
        return ($this->deleted_at != null) ? '(Excluído) ' . $this->number : '(ID: '. $this->id .') ' . $this->number;
    }
}

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

    /**
     * Generate the call and whatsapp links for the phone.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return string
     */
    public function links()
    {
        $whatsAppFormat = preg_replace("/[^0-9]/", "", $this->number);
        $links = '<a href="tel:+' . $whatsAppFormat . '" title="Ligar" style="margin-left: 5px; margin-right: 5px;"><i class="fa fa-lg fa-phone-square text-black"></i></a> ';
        $links .= '<a href="http://api.whatsapp.com/send?1=pt_BR&phone='. $whatsAppFormat . '" title="Chamar no WhatsApp" style="margin-left: 5px; margin-right: 5px;" target="_blank"><i class="fa fa-lg fa-whatsapp text-green"></i></a>';
        return $links;
    }
}

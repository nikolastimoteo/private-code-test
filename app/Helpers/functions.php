<?php

/**
 * Generate the call and whatsapp links for the phone.
 * Returns HTML.
 * 
 * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
 * @param  string
 * @return string
 */
function create_phone_links(string $phone)
{
    $links = '';

    if($phone != null && $phone != '')
    {
        $whatsAppFormat = preg_replace("/[^0-9]/", "", $phone);
        $links .= '<a href="tel:+' . $whatsAppFormat . '" title="Ligar" style="margin-left: 5px; margin-right: 5px;"><i class="fa fa-lg fa-phone-square text-black"></i></a> ';
        $links .= '<a href="http://api.whatsapp.com/send?1=pt_BR&phone='. $whatsAppFormat . '" title="Chamar no WhatsApp" style="margin-left: 5px; margin-right: 5px;" target="_blank"><i class="fa fa-lg fa-whatsapp text-green"></i></a>';
    }

    return $links;
}
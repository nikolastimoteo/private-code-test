<?php
use App\ActivityLog;

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

/**
 * Creates an activity log for the relationships that changed when the model changed.
 * 
 * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
 * @param  array $oldRelationships
 * @param  array $newRelationships
 * @param  string $type
 * @param  string $model
 * @param  int $modelId
 * @param  int $authUserId
 * @return void
 */
function log_on_changed_relationships(array $oldRelationships, array $newRelationships, string $type, string $model, int $modelId, int $authUserId)
{
    if((!empty($oldRelationships) || !empty($newRelationships)) && $oldRelationships !== $newRelationships)
    {
        $description = '';
        switch ($model) {
            case 'App\Group':
                $description .= 'Alterou as permissões do grupo de [';
                break;
            case 'App\User':
                $description .= 'Alterou os grupos do usuário de [';
                break;
            default:
                break;
        }

        if($description != '')
        {
            $arraySizeOld = count($oldRelationships);
            if($arraySizeOld > 0)
                foreach($oldRelationships as $key => $old)
                    if($key+1 == $arraySizeOld)
                        $description .= '"' . $old . '"] para [';
                    else
                        $description .= '"' . $old . '", ';
            else
                $description .= '] para [';

            $arraySizeNew = count($newRelationships);
            if($arraySizeNew > 0)
                foreach($newRelationships as $key => $new)
                    if($key+1 == $arraySizeNew)
                        $description .= '"' . $new . '"]. ';
                    else
                        $description .= '"' . $new . '", ';
            else
                $description .= ']. ';

            ActivityLog::create([
                'type'        => $type,
                'model'       => $model,
                'model_id'    => $modelId,
                'description' => $description,
                'users_id'    => $authUserId,
            ]);
        }
    }
}
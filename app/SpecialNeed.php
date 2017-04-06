<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialNeed extends Model
{
    protected $fillable=[
    	'child_id','has_specialneeds','diagnosis','risk_of_falling','mobility_support','need_splints_orthotics','orthotics_when','need_hand_over_hand','weight','need_toiletting_assisstance','toiletting_details','need_eating_assisstance','eating_details','need_communication_assisstance','communication_means','communicates_yes','communicates_no','overwhelm_noise','overwhelm_people','leaves_group','harm_others','harm_self','successful_participation','trigger','major_change','activities'
    ];

    public function child()
    {
    	return $this->belongsTo('App\Child');
    }
}

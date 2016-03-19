<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialNeed extends Model
{
    protected $fillable=[
    	'risk_of_falling','mobility_support','requires_orthotics','orthotics_when',
    	'hand_over_hand_assisstance','toiletting_assisstance','toiletting_details',
    	'eating_assisstance','eating_details','communication_assisstance','communication_means',
    	'communicates_yes','communicates_no','weight','overwhelm_noise',
        'overwhelm_people','leaves_group', 'harm_others','harm_self',
        'successful_participation','trigger','major_change','activities'
    ];

    public function child()
    {
    	return $this->belongsTo('App\Child');
    }
}

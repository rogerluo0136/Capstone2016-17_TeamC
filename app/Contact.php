<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = [
        'parent_1_name','parent_1_email','parent_1_address','parent_1_city','parent_1_province','parent_1_postal','parent_1_home_tel','parent_1_work_tel','parent_1_cell_phone','parent_2_name','parent_2_email','parent_2_address','parent_2_city','parent_2_province','parent_2_postal','parent_2_home_tel','parent_2_work_tel','parent_2_cell_phone','lives_with','language','emerg_contact','emerg_contact_phone','child_id'
    ];

    public function child()
    {
    	return $this->belongsTo('App\Child');
    }
}

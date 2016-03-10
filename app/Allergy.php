<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{	
	protected $fillable = [
        'is_allergic', 'allergy', 'symptoms','treatment','medication'
    ];

    public function child(){
    	return $this->belongsTo('App\Child');
    }
}

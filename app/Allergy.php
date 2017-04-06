<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{	
	protected $fillable = [
        'has_allergy','allergy_type_symptom','allergy_explaination','has_medication','medication_explaination'
    ];

    public function child(){
    	return $this->belongsTo('App\Child');
    }
}

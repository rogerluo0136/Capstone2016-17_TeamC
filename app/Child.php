<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
	public $table = "childs";

	protected $fillable = [
        'name', 'dob', 'gender','health_card','fam_physician_name','fam_physician_phone','languages','lives_with'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function emergencyContact()
    {
    	return $this->hasOne('App\EmergencyContact');
    }

    public function allergy()
    {
    	return $this->hasOne('App\Allergy');
    }

    public function specialNeed()
    {
        return $this->hasOne('App\SpecialNeed');
    }

    public function painManagement()
    {
        return $this->hasOne('App\PainManagement');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
	protected $fillable = [
        'name', 'relationship', 'email','street_address','city','province','postal_code','cell_phone','home_phone','work_phone'
    ];

    public function child()
    {
    	return $this->belongsTo('App\Child');
    }
}

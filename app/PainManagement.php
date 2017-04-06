<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PainManagement extends Model
{
    protected $fillable=[
    	'experiences_seizures','last_seizure','seizure_details','seizure_medication','pain_indication','pain_alleviation','pain_requirements','requirement_other_details'
    ];

    public function child()
    {
    	return $this->belongsTo('App\Child');
    }
}

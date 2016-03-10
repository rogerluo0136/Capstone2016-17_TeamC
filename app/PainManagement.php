<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PainManagement extends Model
{
    protected $fillable=[
    	'experiences_seizures','last_seizure','seizure_frequency','seizure_trigger',
    	'seizure_medication','pain_indication','pain_alleviation','pain_requirements'
    ];

    public function child()
    {
    	return $this->belongsTo('App\Child');
    }
}

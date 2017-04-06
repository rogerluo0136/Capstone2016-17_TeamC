<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicAssessment extends Model
{
	protected $fillable = [
        'assessment_status','preferred_therapist_id','preferred_instrument'
    ];

    protected $dates=[
        'created_at','updated_at'
    ];

    public function child()
    {
    	return $this->belongsTo('App\Child');
    }
}

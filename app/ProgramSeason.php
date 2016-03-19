<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramSeason extends Model
{
    public $table = "program_season";

    public function schedules()
    {
    	return $this->hasMany('App\Schedule');
    }

    public function program()
    {
    	return $this->belongsTo('App\Program');
    }

    public function season()
    {
    	return $this->belongsTo('App\Season');
    }
}

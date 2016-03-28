<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramSeason extends Model
{
    public $table = "program_season";
    
    protected $fillable=[
        'program_id', 'season_id', 'cost', 'size', 'status', 'minimum_amount', 'schedule'
    ];
    
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
    
    public function childProgramSeason()
    {
        return $this->hasMany('App\ChildProgramSeason');
    }
}

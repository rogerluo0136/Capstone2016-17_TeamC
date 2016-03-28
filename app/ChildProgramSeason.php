<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildProgramSeason extends Model
{
    public $table = "child_program_season";

    protected $fillable=[
    	'child_id','program_season_id','status'
    ];
    
    public function programSeason(){
        return $this->belongsTo('App\ProgramSeason');
    }
    
    public function child(){
        return $this->belongsTo('App\Child');
    }
    
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
    
    
}

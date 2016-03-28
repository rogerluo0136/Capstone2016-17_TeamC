<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=[
    	'user_id','child_program_season_id','amount','transaction_type','charge_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function child_program_season(){
    	return $this->belongsTo('App\ChildProgramSeason');
    }

    
}

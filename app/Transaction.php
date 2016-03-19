<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=[
    	'user_id','amount','transaction_type','program_season_id','child_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function program_season(){
    	return $this->belongsTo('App\ProgramSeason');
    }

    
}

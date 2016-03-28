<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{   
    protected $dates = ['created_at', 'updated_at', 'deleted_at','start','end'];
    
    protected $fillable=[
        'season','year','start','end','weeks','active'
    ];
    
    public function programs()
    {
    	return $this->belongsToMany('App\Program')->withPivot('status','id','cost');;
    }
}

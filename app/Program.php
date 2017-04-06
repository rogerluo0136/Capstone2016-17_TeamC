<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    
    protected $fillable=[
        'name','category','min_age','max_age','type','months_since_checkup','description'
    ];
    
    public function seasons()
    {
    	return $this->belongsToMany('App\Season');
    }
    
    
}

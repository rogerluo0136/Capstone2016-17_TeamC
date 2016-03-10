<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function programs()
    {
    	return $this->belongsToMany('App\Program');
    }
}

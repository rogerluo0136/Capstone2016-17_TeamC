<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildProgramSeason extends Model
{
    public $table = "child_program_season";

    protected $fillable=[
    	'child_id','program_season_id','status'
    ];
}

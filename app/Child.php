<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{   
    
	public $table = "childs";

	protected $fillable = [
        'first_name', 'last_name','dob','health_card','family_physician','fam_physician_phone','is_client','is_first_time','department','previous_program','user_id'
    ];

    protected $dates=[
        'created_at','updated_at','dob'
    ];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function contact()
    {
    	return $this->hasOne('App\contact');
    }

    public function allergy()
    {
    	return $this->hasOne('App\Allergy');
    }

    public function specialNeed()
    {
        return $this->hasOne('App\SpecialNeed');
    }

    public function painManagement()
    {
        return $this->hasOne('App\PainManagement');
    }

    public function programSeason()
    {
        return $this->belongsToMany('App\ProgramSeason','child_program_season','child_id','program_season_id');
    }

    public function checkups()
    {
        return $this->hasMany('App\Checkup');
    }
    
    public function childProgramSeason(){
        return $this->hasMany('App\ChildProgramSeason');
    }

    public function musicAssessment(){
        return $this->hasMany('App\MusicAssessment');
    }
    

}

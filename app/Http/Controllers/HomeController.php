<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Season as Season;
use App\ChildProgramSeason as ChildProgramSeason;
use App\ProgramSeason as ProgramSeason;
use Excel;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user=Auth::user();
        
        //if user is an admin go to admin page
        if(Auth::user()->type=='admin'){
            //retrieve child program seasons
            
            $cps=ChildProgramSeason::where('status','like','inquired')->whereHas('programSeason',function($query){
                $query->where('status','like','on');
            })->get();
            
            
            //get most upcoming season
            $season=Season::where([
                ['start','>',Carbon::now()],
                ['active','like','Yes']
            ])->orderBy('start','asc')->get();
            //dd($season->isEmpty());

            $program_season=collect([]);
            if(!$season->isEmpty()){
                //obtain program by season that are currently active
                $program_season=ProgramSeason::whereHas('season',function($query) use($season){
                    $season_id=$season->first()->id;
                    $query->where('id','=',$season_id);
                })->get();
                //dd($program_season);
            }
            // $program_season_array=$program_season->toArray();
            
            // $excel_create=Excel::create('Filename', function($excel) use($program_season_array) {
                
            //     // $excel->sheet('Sheet', function($sheet) use($program_season_array) {
    
            //     //      $sheet->fromArray($program_season_array);
            
            //     // });
            //  foreach($program_season_array as $prg){
            //      $excel->sheet('Sheet', function($sheet) use($prg) {

            //          $sheet->fromArray($prg);
        
            //      });
            // }
            // })->download('xlsx');
            
            //sort with music first if capable
            //$program_season_music=$program_season->program()->where('category','like')
            return view('admin.home',compact('cps','program_season'));
        }
            
        
        //get all seasons that are starting after today.
        $seasons=Season::where([
            ['start', '>', Carbon::today()],
            ['active','like','Yes']
        ])->get();
        
        $cps_all=ChildProgramSeason::whereIn('child_id', function($query) {
            $query->select('id')->from('childs')->where('user_id', Auth::user()->id);
        })->get();

        $program_seasons=collect([]);
            if(!$seasons->isEmpty()){
                //obtain program by season that are currently active
                $program_seasons=ProgramSeason::whereHas('season',function($query) use($seasons){
                    $season_id=$seasons->first()->id;
                    $query->where('id','=',$season_id);
                })->get();
                //dd($program_season);
            }
        
        $cps_collection=collect([]);
        foreach($cps_all as $cps){
            if($cps->program_season_id == 0)
                $cps_collection->push($cps);
            elseif($cps->programSeason->season->end->gt(Carbon::now()))
                $cps_collection->push($cps);
            elseif($cps->transactions->sum('amount') < $cps->programSeason->cost)
                $cps_collection->push($cps);
        }
        
        session()->forget('id');
        session()->forget('child');
        session()->forget('contact');
        session()->forget('allergy');
        session()->forget('special_need');
        session()->forget('pain_management');        
    

        //retireve all records where child program season exists
        return view('home',compact('user','seasons','cps_collection'));
    }
}

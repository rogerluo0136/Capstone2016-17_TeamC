<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Child as Child;
use App\Program as Program;
use App\Season as Season;
use Carbon\Carbon;
use App\ProgramSeason as ProgramSeason;
use App\ChildProgramSeason as ChildProgramSeason;
use Excel;
use App\Transaction as Transaction;

class AdminController extends Controller
{
    /**
     * Display admin home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        /*uncomment when testing
        //abort if not admin
        if(Auth::user()->type!='admin'){
            abort(403,'Unauthorized Access');
        }*/
        
        //retrieve child program seasons
        $cps=ChildProgramSeason::where('status','like','inquired')->whereHas('programSeason',function($query){
            $query->where('status','like','on');
        })->get();
 
        //get most upcoming season
        $season=Season::where([
                ['start','>',Carbon::now()],
                ['active','like','Yes']
            ])->orderBy('start','asc')->get();
            
            $program_season=collect([]);
            if(!$season->isEmpty()){
                //obtain program by season that are currently active
                $program_season=ProgramSeason::whereHas('season',function($query) use($season){
                    $season_id=$season->first()->id;
                    $query->where('id','=',$season_id);
                })->get();
            }
        

        
        //sort with music first if capable
        //$program_season_music=$program_season->program()->where('category','like')
        return view('admin.home',compact('cps','program_season'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Show the registered child information
     * 
     * @param child program season id
     * @return \Illuminate\Http\Response
     */
    public function childInfo($cps_id)
    {
        $cps=ChildProgramSeason::where('id','=',$cps_id)->first();
        $child=Child::where('id','=',$cps->child->id)->first();
        return view('admin.childView',compact('cps','child'));
    }
    
    public function programSeasonInfo($program_season_id)
    {
        $program_season=ProgramSeason::where('id','=',$program_season_id);
        
        //retrieve children for program season
        $cps=ChildProgramSeason::whereHas('programSeason',function($query) use($program_season_id){
            $query->where('id','=',$program_season_id);
        })->get();
        
        
        return view('admin.childProgramSeason',compact('program_season','cps'));
    }

    // added
    public function viewAllRegistrants(){
        $cps=ChildProgramSeason::where('status','like','inquired')->whereHas('programSeason',function($query){
            $query->where('status','like','on');
        })->get();
        return view('admin.viewAllRegistrants',compact('cps'));
    }
}

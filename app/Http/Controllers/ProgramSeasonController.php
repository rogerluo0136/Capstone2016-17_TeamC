<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProgramSeason as ProgramSeason;
use App\ChildProgramSeason as ChildProgramSeason;
use App\Season as Season;
use App\Program as Program;
use Auth;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProgramSeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$season_id)
    {
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
            }

        $programSeason = new ProgramSeason(Input::all());
        $programSeason->season_id = $season_id;
        $programSeason->save();
        //dd($program_season);
        return view('admin.home',compact('cps','program_season'));
    }

    /**
     * Display the specified program by season.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($programSeason_id)
    {   
        if(Auth::user()->type!='admin'){
            abort(403,'Unauthorized Access to page');
        }
        
        $programSeason=ProgramSeason::findOrFail($programSeason_id);
        
        return view('admin.programSeasonUpdate',compact('programSeason'));
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
     * register a child into a program
     * 
     * @param int $program_id, int $season_id
     * @return view
     */
    public function register($program_id,$season_id)
    {   
        // ensure that season program combination trying
        // to be accessed has a start date later than today.
        // if not, then only allow admin to proceed to see
        // historical offerings and post.
        $season=Season::findOrFail($season_id);

        $flag=Season::where([
            ['start', '>', Carbon::today()->toDateString()],
            ['id','=', $season_id],
            ['active','like','yes']
        ])->exists();
        
        if(!$flag && Auth::user()->type!='admin'){
            abort(403,'Unauthorized Access');
        }
        
        $program=$season->programs()->findOrFail($program_id);
        
        // retrieve the status of the offered program.
        $status=$program->pivot->status;

        if($status!='on' && Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }

        $program_season=ProgramSeason::findOrFail($program->pivot->id);
        
        
        
        $user_child_ids=Auth::user()->childs->pluck('id');
        $registerd_cps=$program_season->childProgramSeason()->whereIn('child_id',$user_child_ids->all())->get();
        $registered_childs=$registerd_cps->pluck('child_id');
        $children=Auth::user()->childs()->whereNotIn('id',$registered_childs->all())->get();
        
        
        return view('program.season',compact('season','program','program_season','children'));
    }
    
    /**
     * Show a form to add a program to a specific season
     * 
     * @param $season_id
     * @return view()
     */
    public function addProgramSeason($season_id)
    {
        //retrieve list of programs and seasons
        $season=Season::findOrFail($season_id);
        $programs=Program::all();
        
        return view('admin.programSeason',compact('season','programs'));
    }
    
    /**
     * retrieve the list of children that are in a particular
     * program in a season 
     * 
     * @param Request $request
     * @view()
     */
    public function children(Request $request) {
        
        $cps=collect([]);
        
        //retrieve the list of registrants for program season
        $season=Season::where([
            ['season','like',$request->input("season")],
            ['year',$request->input("year")]
        ])->get();
        
        if(!$season->isEmpty())
        {
            $programSeason=ProgramSeason::where([
                ['season_id',$season->first()->id],
                ['program_id',$request->input("program")]
            ])->get();
            
            if(!$programSeason->isEmpty())
            {
                $cps=ChildProgramSeason::where('program_season_id',$programSeason->first()->id)->get();
            }
        }
        
        return view('admin.transactionCPS',compact('cps'));
    }

    public function display(Request $request, $category)
    {
        $seasons=Season::where([
                ['start','>',Carbon::now()],
                ['active','like','Yes']
            ])->orderBy('start','asc')->get();
            //dd($season->isEmpty());

            $program_seasons=collect([]);


            if(!$seasons->isEmpty()){
                //obtain program by season that are currently active
                $program_seasons=ProgramSeason::whereHas('season',function($query) use($seasons){
                    $season_id=$seasons->first()->id;
                    $query->where('id','=',$season_id);
                })->get();
                //dd($program_seasons);
            }

        return view('program.display', compact('seasons','program_seasons','category'));
    }
    
}

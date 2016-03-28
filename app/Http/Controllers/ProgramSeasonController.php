<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ProgramSeason as ProgramSeason;
use App\Season as Season;
use App\Program as Program;
use Auth;
use Carbon\Carbon;

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
        //retrieve list of programs and seasons
        $seasons=Season::where('start','>',Carbon::today())->get();
        $programs=Program::all();
        
        return view('admin.programSeason',compact('seasons','programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$season_id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($program_id,$season_id)
    {   

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
}

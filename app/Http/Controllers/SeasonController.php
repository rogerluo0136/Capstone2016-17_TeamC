<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Season as Season;
use App\Program as Program;
use App\ProgramSeason as ProgramSeason;
use App\ChildProgramSeason as ChildProgramSeason;
use Auth;
use Excel;
use DB;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }
        
        $seasons=Season::orderBy('start','desc')->get();
        return view('admin.seasonIndex',compact('seasons'));
    }

    /**
     * Show the form for creating a new season.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }
        return view('admin.season');
    }

    /**
     * Store a newly created season in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }
        
        $this->validate($request,[
            'season'=>'required',
            'year'=>'required|numeric',
            'start'=>'required|date|after:tomorrow',
            'end'=>'required|date|after:start',
            'weeks'=>'required|numeric',
            'active'=>'required'
        ]);
        
        $season= Season::create($request->all());
        
        return redirect('/admin');
    }

    /**
     * Display the specified season information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }
        $season=Season::findOrFail($id);
        
        //obtain program by season passed through the function
        $program_season=ProgramSeason::whereHas('season',function($query) use($season){
            $season_id=$season->id;
            $query->where('id','=',$season_id);
        })->get();
        
        
        return view('admin.seasonShow',compact('season','program_season'));
        
    }

    

    /**
     * Update the specified season in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function updateSeason(Request $request, $id)
    public function update(Request $request, $id)
    {   
        
        //Only admin is allowed to update a season
        if(Auth::user()->type!='admin'){
            abort(403,"Unauthorized.");
        }
        
        $season=Season::findOrFail($id);
        
        //validate request input
        $this->validate($request,[
            'season'=>'required|in:Winter,Summer,Fall,Spring',
            'year'=>'required|numeric',
            'start'=>'required|date',
            'end'=>'required|date|after:start',
            'weeks'=>'required|numeric',
            'active'=>'required|in:Yes,No',
        ]);
        
        
        //update the season record
        Season::where('id',$id)->update($request->all());
        
        
    }
    
    /**
     * Show form for downloading season data
     * 
     * @return view
     */
    public function exportData()
    {
        return view('admin.seasonExport');
    }
    
    /*
    *Download season data based on input season and year
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    */
    public function exportSeasonData(Request $request)
    {   
        //validate input data
        $this->validate($request,[
            'season'=>'required',
            'year'=>'required|numeric'
        ]);
        
        //retrieve input
        $name=$request->input("season");
        $year=$request->input("year");
        
        $season=Season::where([
            ['season',$name],
            ['year',$year]
        ])->get();
        
        if($season->isEmpty()){
            return \Redirect::back()->withWarning( 'There is no data to export.' );
        }
        else
        {
            $program_seasons=ProgramSeason::where('season_id',$season->first()->id)->get();
            
            if(!is_null($program_seasons)){
            
            //obtain program by season that are currently active
            $program_season_array=$program_seasons->toArray();
            
            $excel_create=Excel::create($season->first()->season." ".$season->first()->year, function($excel) use($program_season_array) {
                
            foreach($program_season_array as $prg){
                $cps_array=[];
                $children=DB::table('childs')
                            ->join('allergies','allergies.child_id','=','childs.id')
                            ->join('pain_managements','pain_managements.child_id','=','childs.id')
                            ->join('special_needs','special_needs.child_id','=','childs.id')
                            ->join('child_program_season','child_program_season.child_id','=','childs.id')
                            ->join('program_season', function ($join) use($prg) {
                                $join->on('program_season.id', '=', 'child_program_season.program_season_id')
                                     ->where('program_season.id', '=', $prg['id']);
                            })
                            ->get();
                foreach($children as $child)
                {
                    $cps_array [] = (array) $child;
                }
                
                $excel->sheet(str_replace(':', ' ', Program::where('id',$prg['program_id'])->get()->first()->name), function($sheet) use($cps_array) {
    
                  $sheet->fromArray($cps_array);
        
              });
            }
            })->download('xlsx');
            return \Redirect::back()->withSuccess( 'Data exported succesfully.' );
        }
        return \Redirect::back()->withWarning( 'There is no data to export.' );
    }
    }

}

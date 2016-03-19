<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProgramSeason as ProgramSeason;
use Auth;
use App\ChildProgramSeason as ChildProgramSeason;
use Carbon\Carbon;
use App\Child as Child;

class ChildProgramSeasonController extends Controller
{
    /**
     * Display a listing of the Programs that chld has registered for.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($child_id)
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
    public function store(Request $request,$program_season_id)
    {

        //ensure that the program_season exists and 
        //that its stat is open for registerations
        $program_season_exists=ProgramSeason::where([
            ['id','=',$program_season_id],
            ['status','like','on']
        ])->exists();
        //abort if the program does not exist in that season.
        if(!$program_season_exists){
            abort(403,"Sorry, the program is currently closed for registration");
        }

        //make sure that the request contains an array of chilren
        //that are trying to regiser for a program
        $this->validate($request,[
            'program_child'=>'required|array|exists:childs,id'
        ]);

        //ensure that the authorized user has all the children
        //under his account, if not ensure that the admin is 
        //inserting the children into the programs.
        $program_child_ids=$request->input('program_child');
        $children=Auth::user()->childs()->whereIn('id',$program_child_ids)->get();
        if($children->count() != count($program_child_ids && Auth::user()->type!='admin'))
            abort(403,"Unauthorized action");
        

        //initiate variables
        $flag=true;
        $program_season=ProgramSeason::findOrFail($program_season_id);
        $program=$program_season->program;
        $invited_count=0;


        //batch insert the children into the program
        $data=array();
        foreach($program_child_ids as $id){
            
            //retrieve the last passed checkup
            $child=Child::findOrFail($id);
            $checkup=$child->checkups()
                            ->where('passed','like','yes')
                            ->orderBy('updated_at', 'desc')
                            ->first();
            
            
            if(is_null($program->months_since_checkup)){

                //if there are no program checkup requirements, then invite to the program
                $input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'invited'];
                array_push($data,$input);
            }
            elseif(is_null($checkup)){
                
                //if no record was found, then register child status as 'inquired'
                $flag=false;
                $input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'inquired'];
                array_push($data,$input);
            
            }else{
                
                //check when the last time a check up was done
                //and compare with program requirements. if the child
                //passes the requirements register him as invited,else
                //register him as inquired.
                $now=Carbon::now();
                $updated_at=$checkup->updated_at;

                if($updated_at->between($now->subMonths($program->months_since_checkup),$now)){
                    $input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'invited'];
                    array_push($data,$input);
                    $invited_count++;
                }else{
                    $flag=false;
                    $input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'inquired'];
                    array_push($data,$input);
                }
            } 
        }
        

        //batch insert all children data.
        ChildProgramSeason::insert($data);

        if($flag){

            $price=$children->count() * $program_season->cost; 
            
            return view('checkout',compact('children','price','program_season'));
        }else{

            return view('checkoutMessage',compact('invited_count'));
        }
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
}

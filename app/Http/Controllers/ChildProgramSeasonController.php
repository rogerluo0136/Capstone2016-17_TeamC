<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProgramSeason as ProgramSeason;
use Auth;
use App\ChildProgramSeason as ChildProgramSeason;
use Carbon\Carbon;
use App\Child as Child;
use Storage;

class ChildProgramSeasonController extends Controller
{
    /**
     * Display a listing of the Programs that child has registered for.
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
     * Store a newly created child registration record in storage.
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
        
        if($children->count() != count($program_child_ids) && Auth::user()->type!='admin')
            abort(403,"Unauthorized action");
        

        //initiate variables
        $flag=true;
        $program_season=ProgramSeason::findOrFail($program_season_id);
        $program=$program_season->program;


        //insert the children records into the database
        foreach($program_child_ids as $id){
            //retrieve the last passed checkup
            $child=Child::findOrFail($id);
            
            if($program_season->season->first()->season == 'Summer' || $program_season->season->first()->season == 'summer')
            {
                $insert_input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'inquired'];
                $update_input=['status'=>'inquired'];
                
                if(ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->exists()){
                    ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->update($update_input);
                }else{
                    ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->insert($insert_input);
                }
            }
            
            else
            {
                $checkup=$child->checkups()
                                 ->where('passed','like','yes')
                                 ->orderBy('updated_at', 'desc')
                                 ->first();
                                 
                $last_attended=$child->programSeason()
                         ->whereHas('program',function($query) use($program){
                            $query->where('category','like',$program->category)->whereNotNull('months_since_checkup');
                         })
                         ->orderBy('season_id', 'desc')
                         ->first();
                
                if(is_null($program->months_since_checkup)){
                    
                    //if there are no program checkup requirements, then invite to the program
                    $insert_input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'invited'];
                    $update_input=['status'=>'invited'];
                    
                    if(ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->exists()){
                        ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->update($update_input);
                    }else{
                        ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->insert($insert_input);
                    }
                }
                elseif(is_null($checkup) && is_null($last_attended)){
                    
                    //if no record was found, then register child status as 'inquired'
                    $flag=false;
                    $insert_input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'inquired'];
                    $update_input=['status'=>'inquired'];
                    
                    if(ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->exists()){
                        ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->update($update_input);
                    }else{
                        ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->insert($insert_input);
                    }
                }else{
                    //check when the last time a check up was done
                    //and compare with program requirements. if the child
                    //passes the requirements register him as invited,else
                    //register him as inquired.
                    $now=Carbon::now();
                    
                    //retrieve most up to date 
                    if($checkup && $last_attended)
                        $updated_at=$checkup->updated_at->max($last_attended->season->start);
                    elseif($checkup)
                        $updated_at=$checkup->updated_at;
                    else
                        $updated_at=$last_attended->season->start;
                    
                    //$updated_at=max($last_attended->season()->start, date($checkup->updated_at));
                    
                    if($updated_at->gt($now->subMonths($program->months_since_checkup))){
                        $insert_input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'invited'];
                        $update_input=['status'=>'invited'];
                        
                        if(ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->exists()){
                            ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->update($update_input);
                        }else{
                            ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->insert($insert_input);
                        }
                        
                    }else{
    
                        $flag=false;
                        $insert_input=['child_id'=>$id,'program_season_id'=>$program_season_id,'status'=>'inquired'];
                        $update_input=['status'=>'inquired'];
                        
                        if(ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->exists()){
                            ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->update($update_input);
                        }else{
                            ChildProgramSeason::where([['child_id',$id],['program_season_id',$program_season_id]])->insert($insert_input);
                        }
                    }
                }
            }
        }
        

        if($flag){

            $price=$children->count() * $program_season->cost; 
            $minprice=$children->count() * $program_season->minimum_amount;
            
            return view('paymentmethod',compact('children','price','program_season','minprice'));
        }else{
    //
            return view('checkoutMessage');
        }
    }

    /**
     * Display the specified child registration record.
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
     * Update the specified child registration record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $child_id, $programSeason_id)
    {
        ChildProgramSeason::where([
                ['child_id', $child_id],
                ['program_season_id', $programSeason_id]
            ])
            ->update(['status' => $request->input("status")]);
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
     * Remove the specified child registration record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fundingFileUpload(Request $request){
        
        //validate the file being uploaded
        $this->validate($request,[
            //'fundingFile' =>'required|mimes:jpeg,bmp,png,pdf,jpg',
            'fundingFile' =>'required',
            //'children' =>'required',
            //'program_season'=>'required'
        ]);
        //dd('success');
        //obtain all the children and program_season from request
        $children=$request->input('children');
        $program_season=$request->input('program_season');
        
        //verify requested Program Season
        $program_season=ProgramSeason::findOrFail($program_season['id']);
        
        //verify requested Chilren
        $id=array();
        foreach($children as $child){
            array_push($id,$child['id']);
        }
       
        //ensure that authenticated user owns his children or is the admin
        $childrenCollection=Auth::user()->childs()->whereIn('id',$id)->get();
        if($childrenCollection->count()!=count($children) && Auth::user()->type!='admin'){
            //dd('childrenCollection->count()='.$childrenCollection->count().', count($children)='.count($children));
            abort(403,'Unauthorized request');
        }
        
        if(!$request->hasFile('fundingFile')){
            //dd('no funding file has been uploaded');
        }
        //change the status of each child to funding.
        foreach($childrenCollection as $child){
            //retrieve the registration record of the child
            $child_program_season=ChildProgramSeason::where([
                ['child_id',$child->id],
                ['program_season_id',$program_season->id]
            ])->get();
            
            //store the application file of the child on the local webserver
            Storage::put(
                'funding/'.$child_program_season.$request->file('fundingFile')->getClientOriginalExtension(),
                file_get_contents($request->file('fundingFile')->getRealPath())
            );
            
            //store the file name 
            ChildProgramSeason::where([
                ['program_season_id',$program_season->id],
                ['child_id',$child->id]
            ])->update(['status'=>'funding','funding_file'=>'funding/'.$child_program_season.$request->file('fundingFile')->getClientOriginalExtension()]);
        }
        
    }
}

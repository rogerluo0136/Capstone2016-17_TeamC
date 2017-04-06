<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Child as Child;
use App\SpecialNeed as SpecialNeed;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App;
class ChildSpecialNeedController extends Controller
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
     * Show the form for creating a new special need.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($childId)
    {
       //old flag
       //$flag=Auth::user()->childs()->where('id',$childId)->exists();
        $flag= session('id')!=null ;

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }
        $child=Child::findOrFail((int)$childId-1);

        return view('child.specialneed',compact('child'));
    }

    /**
     * Store a newly created special need in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$childId)
    {
        //old flag
        //$flag=Auth::user()->childs()->where('id',$childId)->exists();
        $flag= session('id')!=null ;

// dd($request); 

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }
        
        $request['communication_means']= implode(',', $request['communication_means']);
        session(['special_need'=> $request->except('_token')]);
        
 //dd(session('special_need'));

        $v=Validator::make($request->all(),[
            
            'has_specialneeds'=>'required|in:yes,no',
            'risk_of_falling'=>'required|in:yes,no',
            'mobility_support'=>'required',
            'need_splints_orthotics'=>'required|in:yes,no',
            'need_hand_over_hand'=>'required|in:yes,no',
            'weight'=>'required|numeric',
            'need_toiletting_assisstance'=>'required|in:yes,no',
            'need_eating_assisstance'=>'required|in:yes,no',
            'need_communication_assisstance'=>'required|in:yes,no',
            'communication_means'=>'required',
            'overwhelm_noise'=>'required|in:yes,no',
            'overwhelm_people'=>'required|in:yes,no',
            'leaves_group'=>'required|in:yes,no',
            'harm_others'=>'required|in:yes,no',
            'harm_self'=>'required|in:yes,no',
            'successful_participation'=>'required|in:yes,no',
            'communicates_yes'=>'required',
            'communicates_no'=>'required'

        ]);

        $v->sometimes('diagnosis','required',function ($input){
            return $input->has_specialneeds=='yes';
        });

        $v->sometimes('orthotics_when','required',function ($input){
            return $input->need_splints_orthotics=='yes';
        });

        $v->sometimes('toiletting_details','required',function ($input){
            return $input->need_toiletting_assisstance=='yes';
        });

        $v->sometimes('eating_details','required',function ($input){
            return $input->need_eating_assisstance=='yes';
        });

        // $v->sometimes('communicates_yes','required',function ($input){
        //     return $input->communication_means!='verbally';
        // });

        // $v->sometimes('communicates_no','required',function ($input){
        //     return $input->communication_means!='verbally';
        // });

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }
        
        
        //store input into session
        
        session(['special_need'=> $request->except('_token')]);
        //session()->flash('special_need',$request->except('_token'));  

//dd(session('special_need'));

        // $special_need=new SpecialNeed(Input::all());
        // $special_need->child_id=$childId;
        // $special_need->save();
        $childId=session('id');
        return redirect('/child/'.$childId.'/painmanagement/create');
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
     * Update the specified special need in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $child_id, $sn_id)
    {
        //ensure that either the child is registered under the
        //authenticated user's account or the admin is the user
        $flag=Auth::user()->childs()->where('id','=',$child_id)->exists();
        if(!$flag && Auth::user()->typ!='admin'){
            App::abort(403, 'Unauthorized action.');
        }

        //ensure allergy_id matches with what is
        //being updated
        $child=Child::findOrFail($child_id);
        if($child->specialNeed->id !=$sn_id){
            App::abort(403, 'Unauthorized action.');
        }

        $request['communication_means']= implode(',', $request['communication_means']);
       
        $v=Validator::make($request->all(),[
            
            'has_specialneeds'=>'required|in:yes,no',
            'risk_of_falling'=>'required|in:yes,no',
            'mobility_support'=>'required',
            'need_splints_orthotics'=>'required|in:yes,no',
            'need_hand_over_hand'=>'required|in:yes,no',
            'weight'=>'required|numeric',
            'need_toiletting_assisstance'=>'required|in:yes,no',
            'need_eating_assisstance'=>'required|in:yes,no',
            'need_communication_assisstance'=>'required|in:yes,no',
            'communication_means'=>'required',
            'overwhelm_noise'=>'required|in:yes,no',
            'overwhelm_people'=>'required|in:yes,no',
            'leaves_group'=>'required|in:yes,no',
            'harm_others'=>'required|in:yes,no',
            'harm_self'=>'required|in:yes,no',
            'successful_participation'=>'required|in:yes,no',
            'communicates_yes'=>'required',
            'communicates_no'=>'required'

        ]);

        $v->sometimes('diagnosis','required',function ($input){
            return $input->has_specialneeds=='yes';
        });

        $v->sometimes('orthotics_when','required',function ($input){
            return $input->need_splints_orthotics=='yes';
        });

        $v->sometimes('toiletting_details','required',function ($input){
            return $input->need_toiletting_assisstance=='yes';
        });

        $v->sometimes('eating_details','required',function ($input){
            return $input->need_eating_assisstance=='yes';
        });

        // $v->sometimes('communicates_yes','required',function ($input){
        //     return $input->communication_means!='verbally';
        // });

        // $v->sometimes('communicates_no','required',function ($input){
        //     return $input->communication_means!='verbally';
        // });

        if($v->fails()){
            //return Json with validation failure
            return response()->json(
                 $v->getMessageBag(), 422); // 400 being the HTTP code for an invalid request.
        }

        SpecialNeed::where('id',$sn_id)->update($request->all());




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

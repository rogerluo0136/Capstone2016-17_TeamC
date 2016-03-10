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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($childId)
    {
        $flag=Auth::user()->childs()->where('id',$childId)->exists();

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }
        $child=Child::findOrFail($childId);

        return view('child.specialneed',compact('child'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$childId)
    {
        $flag=Auth::user()->childs()->where('id',$childId)->exists();

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }
        
        $data=[
            'requires_orthotics'=>$request->input('requires_orthotics'),
            'mobility_support'=>$request->input('mobility_support'),
            'risk_of_falling'=>$request->input('risk_of_falling'),
            'hand_over_hand_assisstance'=>$request->input('hand_over_hand_assisstance'),
            'toiletting_assisstance'=>$request->input('toiletting_assisstance'),
            'eating_assisstance'=>$request->input('eating_assisstance'),
            'communication_assisstance'=>$request->input('communication_assisstance'),
            'communication_means'=>$request->input('communication_means'),
            'communicates_yes'=>$request->input('communicates_yes'),
            'communicates_no'=>$request->input('communicates_no'),
            'weight'=>$request->input('weight'),

            'overwhelm_noise'=>$request->input('overwhelm_noise'),
            'overwhelm_people'=>$request->input('overwhelm_people'),
            'leaves_group'=>$request->input('leaves_group'),
            'harm_others'=>$request->input('harm_others'),
            'harm_self'=>$request->input('harm_self'),
            'successful_participation'=>$request->input('successful_participation'),
            'trigger'=>$request->input('trigger'),
            'major_change'=>$request->input('major_change'),
            'activities'=>$request->input('activities'),
        ];

        $v=Validator::make($data,[
            'requires_orthotics'=>'required|in:yes,no',
            'mobility_support'=>'required',
            'risk_of_falling'=>'required|in:yes,no',
            'hand_over_hand_assisstance'=>'required|in:yes,no',
            'toiletting_assisstance'=>'required|in:yes,no',
            'eating_assisstance'=>'required|in:yes,no',
            'communication_assisstance'=>'required|in:yes,no',
            'communication_means'=>'required|in:verbally,gestures,device,pictures',
            'communicates_yes'=>'required',
            'communicates_no'=>'required',
            'weight'=>'required|numeric',

            'overwhelm_noise'=>'required|in:yes,no',
            'overwhelm_people'=>'required|in:yes,no',
            'leaves_group'=>'required|in:yes,no',
            'harm_others'=>'required|in:yes,no',
            'harm_self'=>'required|in:yes,no',
            'successful_participation'=>'required|in:yes,no',
            'trigger'=>'required',
            'major_change'=>'required',
            'activities'=>'required',

        ]);

        $v->sometimes('orthotics_when','required',function ($input){
            return $input->requires_orthotics=='yes';
        });

        $v->sometimes('toiletting_details','required',function ($input){
            return $input->toiletting_assisstance=='yes';
        });

        $v->sometimes('eating_details','required',function ($input){
            return $input->eating_assisstance=='yes';
        });

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }
        
        $special_need=new SpecialNeed(Input::all());
        $special_need->child_id=$childId;
        $special_need->save();

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

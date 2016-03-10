<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Child as Child;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App;
use App\PainManagement as PainManagement;
class ChildPainManagementController extends Controller
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

        return view('child.painmanagement',compact('child'));
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
            'experiences_seizures'=>$request->input('experiences_seizures'),
            'pain_indication'=>$request->input('pain_indication'),
            'pain_alleviation'=>$request->input('pain_alleviation')
        ];

        $v=Validator::make($data,[
            'experiences_seizures'=>'required|in:yes,no',
            'pain_indication'=>'required',
            'pain_alleviation'=>'required',
            'pain_requirements'=>'in:suctioning-tip,suctioning-deep,physical-restraints,helmet'
        ]);

        $v->sometimes(['seizure_frequency','seizure_trigger','seizure_medication'],'required',function ($input){
            return $input->experiences_seizures=='yes';
        });

        $v->sometimes(['last_seizure'],'required|date',function ($input){
            return $input->experiences_seizures=='yes';
        });

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        $pain_management=new PainManagement(Input::all());
        $pain_management->child_id=$childId;
        $pain_management->save();

        return redirect('/home');
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

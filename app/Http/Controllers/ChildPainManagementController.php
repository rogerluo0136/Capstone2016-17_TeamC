<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Child as Child;
use App\Contact as Contact;
use App\Allergy as Allergy;
use App\SpecialNeed as SpecialNeed;
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
     * Show the form for creating a new pain management.
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

        return view('child.painmanagement',compact('child'));
    }

    /**
     * Store a newly created pain management in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$childId)
    {
        //old flag
        //$flag=Auth::user()->childs()->where('id',$childId)->exists();
        $flag= session('id')!=null ;
        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }

        $request['pain_requirements']= implode(',', $request['pain_requirements']);
       
        session(['pain_management'=> $request->except('_token')]);

        $v=Validator::make($request->all(),[
            'experiences_seizures'=>'required|in:yes,no',
            'seizure_medication'=>'required|in:yes,no',
            'pain_indication'=>'required',
            'pain_alleviation'=>'required',
            'pain_requirements'=>'required'
        ]);

        $v->sometimes('seizure_details','required',function ($input){
            return $input->experiences_seizures=='yes';
        });

        $v->sometimes('last_seizure','required|date',function ($input){
            return $input->experiences_seizures=='yes';
        });

        $v->sometimes('requirement_other_details','required',function ($input){
            return $input->pain_requirements=='other';
        });

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        $childId=session('id');
        //store input into session

        session(['pain_management'=> $request->except('_token')]);
//dd(session('child'));
        //save all input to database

        //General Info
     
        $child = new Child(session('child'));
        $child->user_id=Auth::user()->id;
        $child->first_name=ucfirst(session('child')['first_name']);
        $child->last_name=ucfirst(session('child')['last_name']);
        $child->health_card=ucfirst(strtoupper(session('child')['health_card']));
        $child->save();

        //Contact Info
        $contact=new Contact(session('contact'));
        $contact->child_id=$childId;
        $contact->save();

        //Allergy
        $allergy=new Allergy(session('allergy'));
        $allergy->child_id=$childId;
        $allergy->save();

        //Special Need
        $special_need=new SpecialNeed(session('special_need'));
        $special_need->child_id=$childId;
        $special_need->save();

        //Pain Management
        $pain_management=new PainManagement(session('pain_management'));
        $pain_management->child_id=$childId;
        $pain_management->save();

        //erase session
        session()->forget('id');
        session()->forget('child');
        session()->forget('contact');
        session()->forget('allergy');
        session()->forget('special_need');
        session()->forget('pain_management');

        return redirect('/home');
    }

    /**
     * Display the specified pain management.
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
     * Update the specified pain management in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $child_id,$pain_id)
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
        if($child->painManagement->id !=$pain_id){
            App::abort(403, 'Unauthorized action.');
        }

        $request['pain_requirements']= implode(',', $request['pain_requirements']);

        $v=Validator::make($request->all(),[
            'experiences_seizures'=>'required|in:yes,no',
            'pain_indication'=>'required',
            'pain_alleviation'=>'required',
            'pain_requirements'=>'required'
            ]);

        $v->sometimes(['seizure_medication'],'required',function ($input){
            return $input->experiences_seizures=='yes';
        });

        $v->sometimes(['last_seizure'],'required|date',function ($input){
            return $input->experiences_seizures=='yes';
        });

        $v->sometimes('seizure_details','required',function ($input){
            return $input->experiences_seizures=='yes';
        });

        if($v->fails()){
            //return Json with validation failure
            return response()->json(
                 $v->getMessageBag(), 422);
        }

        PainManagement::where('id',$pain_id)->update($request->all());
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

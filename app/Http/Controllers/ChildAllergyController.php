<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use Auth;
use App\Allergy as Allergy;
use App\Child as Child;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ChildAllergyController extends Controller
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
     * Show the form for creating a new allergy.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($childId)
    {
        //old flag
        //$flag=Auth::user()->childs()->where('id',$childId)->exists();

        $flag= session('id')!=null ;


        if(!$flag){
            App::abort(403,'Unauthorized action');
        }
        $child=Child::findOrFail((int)$childId-1);

        return view('child.allergy',compact('child'));

    }

    /**
     * Store a newly created allergy in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$childId)
    {   
        //format validator
        session(['allergy' => $request->except('_token')]);
        

        $validator=Validator::make($request->all(),[
            'has_allergy'=>'required|in:yes,no',
            'has_medication'=>'required|in:yes,no',
        ]);

        $validator->sometimes(['allergy_type_symptom','allergy_explaination'],'required|max:30000',function($input){
            return $input->has_allergy=='yes';
        });

        $validator->sometimes('medication_explaination','required|max:30000',function($input){
            return $input->has_medication=='yes';
        });

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //old flag
        //$flag=Auth::user()->childs()->where('id',$childId)->exists();

        $flag= session('id')!=null ;
        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }

        //store input into session
        session(['allergy' => $request->except('_token')]);
        //session()->flash('allergy',$request->except('_token'));  
//dd(session('child'));

        //create new instance in database
        // $allergy=new Allergy(Input::all());
        // $allergy->child_id=$childId;
        // $allergy->save();

        //redirect to specialneed page
        $childId=session('id');
        return redirect('child/'.$childId.'/specialneed/create');
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
     * Update the specified allergy in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $child_id,$allergy_id)
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
        if($child->allergy->id !=$allergy_id){
            App::abort(403, 'Unauthorized action.');
        }

        //validate the update before updating
        //the database
        $validator=Validator::make($request->all(),[
            'has_allergy'=>'required|in:yes,no',
            'has_medication'=>'required|in:yes,no',
        ]);

        $validator->sometimes(['allergy_type_symptom','allergy_explaination'],'required|max:30000',function($input){
            return $input->has_allergy=='yes';
        });

        $validator->sometimes('medication_explaination','required|max:30000',function($input){
            return $input->has_medication=='yes';
        });

        if($validator->fails()){
            //return Json with validation failure
            return response()->json(
                 $validator->getMessageBag(), 422); // 400 being the HTTP code for an invalid request.
        }

        //update the record in the database
        Allergy::where('id',$allergy_id)->update($request->all());
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

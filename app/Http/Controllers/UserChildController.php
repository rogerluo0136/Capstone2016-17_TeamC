<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Child as Child;
use App\User as User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class UserChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {   
        return view('child.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$userId)
    {   

        $this->validate($request, [
            'name' => 'required|max:255',
            'dob' => 'required|date_format:"Y-m-d"',
            'gender'=>'required',
            'health_card'=>'numeric',
            'languages'=>'required',
            'lives_with'=>'required',
            'fam_physician_name'=>'max:255',
            'fam_physician_phone'=>'numeric'
        ]);

        $child = new Child(Input::all());

        $child->user_id=Auth::user()->id;
        $child->save();

        return redirect('/child/'.$child->id.'/emergencycontact/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId,$childId)
    {
        //
        //policy here that allows
        //an admin or the user's guardian or parents to access this 
        //function
    }

    /**
     * Show the form for editing the user child resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,$child_id)
    {
        //ensure that the authenticated user is
        //the childs owner or is an administrator
        $child = Child::findOrFail($child_id);
        $user=$child->user;

        //if the child owner does not match user_id, then abort
        if($user->id != Auth::user()->id && Auth::user()->type!='admin'){
            abort(403,'Unauthorized User');
        }

        return view('child.edit',compact('child'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id,$child_id)
    {
        //policy here that allows
        //an admin or the user's guardian or parents to access this 
        //function
        $child = Child::findOrFail($child_id);
        $user=$child->user;

        //if the child owner does not match user_id, then abort
        if($user->id != Auth::user()->id && Auth::user()->type!='admin'){
            abort(403,'Unauthorized User');
        }

        //validate the update information
        $this->validate($request, [
            'name' => 'required|max:255',
            'dob' => 'required|date_format:"Y-m-d"',
            'gender'=>'required',
            'health_card'=>'numeric',
            'languages'=>'required',
            'lives_with'=>'required',
            'fam_physician_name'=>'max:255',
            'fam_physician_phone'=>'numeric'
        ]);

        Child::where('id',$child_id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId,$childId)
    {
        //
    }
}

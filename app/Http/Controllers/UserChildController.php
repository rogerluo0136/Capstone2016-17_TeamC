<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Child as Child;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userId,$childId)
    {
        //policy here that allows
        //an admin or the user's guardian or parents to access this 
        //function
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId,$childId)
    {
        //policy here that allows
        //an admin or the user's guardian or parents to access this 
        //function
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

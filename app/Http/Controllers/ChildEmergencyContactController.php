<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App;
use App\Child as Child;
use App\EmergencyContact as EmergencyContact;
use Illuminate\Support\Facades\Input;


class ChildEmergencyContactController extends Controller
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
        //
        $flag=Auth::user()->childs()->where('id',$childId)->exists();

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }
        $child=Child::findOrFail($childId);

        return view('child.emergencycontact',compact('child'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $childId)
    {
        $this->validate($request, [
            'name'=>'required|max:255',
            'relationship'=>'required|max:255',
            'email'=>'required|email',
            'street_address'=>'required|max:255',
            'city'=>'required|max:255',
            'province'=>'required|max:255',
            'postal_code'=>'required|max:255',
            'cell_phone'=>'required|digits:10',
            'home_phone'=>'digits:10',
        ]);

        $flag=Auth::user()->childs()->where('id',$childId)->exists();

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }
        
        $emergencyContact=new EmergencyContact($request->all());
        $emergencyContact->child_id=$childId;

        $emergencyContact->save();

        return redirect('/child/'.$childId.'/allergy/create');
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
    public function update(Request $request, $child_id,$contact_id)
    {   
        //ensure that the authenticated user has registered the 
        //child under his account
        $flag=Auth::user()->childs()->where('id','=',$child_id)->exists();

        if(!$flag && Auth::user()->typ!='admin'){
            App::abort(403, 'Unauthorized action.');
        }

        $child=Child::findOrFail($child_id);

        if($child->emergencyContact->id !=$contact_id){
            App::abort(403, 'Unauthorized action.');
        }

        $this->validate($request, [
            'name'=>'required|max:255',
            'relationship'=>'required|max:255',
            'email'=>'required|email',
            'street_address'=>'required|max:255',
            'city'=>'required|max:255',
            'province'=>'required|max:255',
            'postal_code'=>'required|max:255',
            'cell_phone'=>'required|digits:10',
            'home_phone'=>'digits:10',
        ]);

        EmergencyContact::where('id',$contact_id)->update($request->all());


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

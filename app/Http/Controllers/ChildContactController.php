<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App;
use App\Child as Child;
use App\Contact as Contact;
use Illuminate\Support\Facades\Input;


class ChildContactController extends Controller
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
     * Show the form for creating a new emergency contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($childId)
    {
        // old flag
        // $flag=Auth::user()->childs()->where('id',$childId)->exists();

        // session flag
        $flag= session('id')!=null ;
    

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }

        $childId = (int)$childId-1;
        //old
        $child=Child::findOrFail($childId);
        
        $child->id = session('id');


        //old return view('child.contact',compact('child'));
        return view('child.contact',compact('child'));

    }

    /**
     * Store a newly created emergency contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //old public function store(Request $request, $childId)
    public function store(Request $request, $childId)
    {
       session(['contact' => $request->except('_token')]);

        $this->validate($request, [
            'parent_1_name'=>'required|max:255',
            'parent_1_email'=>'required|email',
            'parent_1_address'=>'required|max:255',
            'parent_1_city'=>'required|max:255',
            'parent_1_province'=>'required|max:255',
            'parent_1_postal'=>'required|max:255|regex://',
            'parent_1_home_tel'=>'numeric|digits:10',
            'parent_1_work_tel'=>'numeric|digits:10',
            'parent_1_cell_phone'=>'required|numeric|digits:10',
            'parent_2_name'=>'max:255',
            'parent_2_email'=>'email',
            'parent_2_address'=>'max:255',
            'parent_2_city'=>'max:255',
            'parent_2_province'=>'max:255',
            'parent_2_postal'=>'max:255|regex://',
            'parent_2_home_tel'=>'numeric|digits:10',
            'parent_2_work_tel'=>'numeric|digits:10',
            'parent_2_cell_phone'=>'numeric|digits:10',
            'lives_with'=>'required',
            'language'=>'required|max:255',
            'emerg_contact'=>'required',
            'emerg_contact_phone'=>'required|numeric|digits:10'
        ]);

        //old flag
        //$flag=Auth::user()->childs()->where('id',$childId)->exists();
        $flag= session('id')!=null ;

        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }
//dd($request);
       //added
     
        //session()->flash('contact',$request->except('_token'));   
        session(['contact' => $request->except('_token')]);

        // $contact=new Contact($request->all());
        // $contact->child_id=$childId;

        // $contact->save();
//dd(session('contact'));
//dd($childId);

        //old return redirect('/child/'.$childId.'/allergy/create');
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
     * Update the specified emergency contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $child_id,$contact_id)
    {   

        //dd('11111');
        //ensure that the authenticated user has registered the 
        //child under his account
        $flag=Auth::user()->childs()->where('id','=',$child_id)->exists();

        if(!$flag && Auth::user()->typ!='admin'){
            App::abort(403, 'Unauthorized action.');
        }

        $child=Child::findOrFail($child_id);


        if($child->contact->id != $contact_id){
            App::abort(403, 'Unauthorized action.');
        }

        $this->validate($request, [
            'parent_1_name'=>'required|max:255',
            'parent_1_email'=>'required|email',
            'parent_1_address'=>'required|max:255',
            'parent_1_city'=>'required|max:255',
            'parent_1_province'=>'required|max:255',
            'parent_1_postal'=>'required|max:255|regex://',
            'parent_1_home_tel'=>'numeric|digits:10',
            'parent_1_work_tel'=>'numeric|digits:10',
            'parent_1_cell_phone'=>'required|numeric|digits:10',
            'parent_2_name'=>'max:255',
            'parent_2_email'=>'email',
            'parent_2_address'=>'max:255',
            'parent_2_city'=>'max:255',
            'parent_2_province'=>'max:255',
            'parent_2_postal'=>'max:255|regex://',
            'parent_2_home_tel'=>'numeric|digits:10',
            'parent_2_work_tel'=>'numeric|digits:10',
            'parent_2_cell_phone'=>'numeric|digits:10',
            'lives_with'=>'required',
            'language'=>'required|max:255',
            'emerg_contact'=>'required',
            'emerg_contact_phone'=>'required|numeric|digits:10'
        ]);
       

        Contact::where('id',$contact_id)->update($request->all());


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

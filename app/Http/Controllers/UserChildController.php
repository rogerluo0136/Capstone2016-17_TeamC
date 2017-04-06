<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Child as Child;
use App\User as User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserChildController extends Controller
{
    /**
     * Display a listing of the child.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        //
    }

    public function show()
    {
        //
    }

    /**
     * Show the form for creating a new child.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($username)
    {   
           // added
        session(['id' => null]);
        
        return view('child.create');
    }

    /**
     * Store a newly created resource in child.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$userId)
    {   
       //dd($request->health_card); 'required','max:12|regex:/[0-9]{10}([A-Z]|[a-z]){2}/'
        //session(['child' => $request->except('_token')]);
         session(['child' => $request->except('_token')]);

        $validator=Validator::make($request->all(), [
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'dob'=>'required|date_format:"Y-m-d"',
            'health_card'=>'required|max:12|regex:/[0-9]{10}[A-z]{2}/',
            'family_physician'=>'max:255',
            'fam_physician_phone'=>'numeric|digits:10',
            'is_client' => 'required|in:yes,no',
            'is_first_time' => 'required|in:yes,no',
        ]);
//dd($validator);
        $validator->sometimes('department','required|max:255',function($input){
            //dd($input);
            return $input->is_client == 'yes';
        });

        $validator->sometimes('previous_program','required|max:255',function($input){
            return $input->is_first_time=='no';
        });

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
    

        
        // added

      
        //
        session(['child' => $request->except('_token')]);
        
        //$child->first_name=ucfirst(session('child')['first_name']);
        //dd(Child::latest()->value('id'));
        //dd(session('child')['first_name']);

        // $child = new Child(Input::all());
        // $child->user_id=Auth::user()->id;
        // $child->first_name=ucfirst(Input::all()['first_name']);
        // $child->last_name=ucfirst(Input::all()['last_name']);
        // $child->health_card=ucfirst(strtoupper(Input::all()['health_card']));
        // $child->save();

//dd(session('child'));
        $child_id = Child::latest()->value('id');
        session(['id' => (int)$child_id+1]);
        return redirect('/child/'.session('id').'/contact/create');

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

        return view('child.edit',compact('user','child'));
        
    }

    /**
     * Show the form for editing the user child resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edits($user_id,$child_id,$action)
    {
        //ensure that the authenticated user is
        //the childs owner or is an administrator
        $child = Child::findOrFail($child_id);
        $user=$child->user;

        //if the child owner does not match user_id, then abort
        if($user->id != Auth::user()->id && Auth::user()->type!='admin'){
            abort(403,'Unauthorized User');
        }

        return view('child.'.$action,compact('user','child'));
        
    }

    /**
     * Update the specified child in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $child_id)
    {
        //policy here that allows
        //an admin or the user's guardian or parents to access this 
        //function
        //dd('here');
        $child = Child::findOrFail($child_id);
        $user=$child->user;

        //if the child owner does not match user_id, then abort
        if($user->id != Auth::user()->id && Auth::user()->type!='admin'){
            abort(403,'Unauthorized User');
        }

        //validate the update information
        $validator=Validator::make($request->all(), [
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'dob'=>'required|date_format:"Y-m-d"',
            'health_card'=>'required|max:12|regex:/[0-9]{10}[A-Z]{2}/',
            'family_physician'=>'max:255',
            'fam_physician_phone'=>'numeric|digits:10',
            'is_client' => 'required|in:yes,no',
            'is_first_time' => 'required|in:yes,no',
        ]);

        $validator->sometimes('department','required|max:255',function($input){
            //dd($input);
            return $input->is_client == 'yes';
        });

        $validator->sometimes('previous_program','required|max:255',function($input){
            return $input->is_first_time=='no';
        });

        if($validator->fails()){
            $failedRules = $validator->failed();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Child::where('id',$child_id)->update($request->all());
        //dd('!!!!!');
    }

}

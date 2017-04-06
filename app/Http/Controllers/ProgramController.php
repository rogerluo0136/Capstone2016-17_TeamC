<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Program as Program;
use Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the programs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }
        $programs=Program::all();
        
        return view('admin.programIndex',compact('programs')); 
    }

    /**
     * Show the form for creating a new programs.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }
        return view('admin.program');
    }

    /**
     * Store a newly created programs in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->type!='admin'){
            abort(403, 'Unauthorized Access');
        }
        
        $this->validate($request,[
            'name'=>'required',
            'category'=>'required',
            'min_age'=>'required|numeric',
            'max_age'=>'required|numeric',
            'type'=>'required',
            'months_since_checkup'=>'numeric',
            'description'=>'string|max:255'
        ]);
        
        $program= Program::create($request->all());
        
        return redirect('/admin');
    }

    /**
     * Display the specified programs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified programs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified programs in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->type!='admin'){
            abort(403,"Unauthorized access");
        }
        
        $this->validate($request,[
            'name'=>'required',
            'category'=>'required|in:Music,Art',
            'min_age'=>'required|numeric',
            'max_age'=>'required|numeric',
            'type'=>'required|in:Individual,Group',
            'months_since_checkup'=>'integer'
        ]);
        
        Program::where('id',$id)->update($request->all());
    }

    /**
     * Remove the specified programs from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * display the form to edit the program information
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateView($id)
    {   
        if(Auth::user()->type!='admin'){
            abort(403,"Unauthorized");
        }
        
        $program=Program::findOrFail($id);
        return view('admin.programUpdate',compact('program'));
    }
}

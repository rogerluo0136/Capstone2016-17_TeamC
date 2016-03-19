<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\ProgramSeason as ProgramSeason;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //only admin should have this access
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //this wont be used since we are registering children
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //only allow this generic functionality to be available to admin
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

    /**
     * show all child info before registering to program
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $this->validate($request,[
            'program_child'=>'required|exists:childs,id|'
        ]);

        $input=$request->input('program_child');
        $childs=Auth::user()->childs()
                            ->whereIn('id',$input)->get();
        
        if(!is_array($input))
        {
            abort(403,'Unauthorized Access.');
        }

        if($childs->count()!=count($input)){
            abort(403,'Unauthorized Access.');
        }

        $program_season=ProgramSeason::findOrFail($request->input('program_season_id'));
        
        return view('child.verify',compact('childs','program_season'));
    }
}

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($childId)
    {
        $flag=Auth::user()->childs()->where('id',$childId)->exists();

        if(!$flag){
            App::abort(403,'Unauthorized action');
        }
        $child=Child::findOrFail($childId);

        return view('child.allergy',compact('child'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$childId)
    {   

        $data=['is_allergic'=>$request->input('is_allergic')];
        $v=Validator::make($data,[
            'is_allergic'=>'required|in:yes,no'
        ]);

        $v->sometimes(['allergy','symptoms','treatment'],'required',function($input){
            return $input->is_allergic=='yes';
        });

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }


        $flag=Auth::user()->childs()->where('id',$childId)->exists();
        if(!$flag){
            App::abort(403, 'Unauthorized action.');
        }


        $allergy=new Allergy(Input::all());
        $allergy->child_id=$childId;
        $allergy->save();

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

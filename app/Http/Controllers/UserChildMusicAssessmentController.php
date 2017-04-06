<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Child as Child;
use App\User as User;
use App\MusicAssessment as MusicAssessment;
use Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Therapist;
use App\ChildProgramSeason;

class UserChildMusicAssessmentController extends Controller
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
    public function create($userId)
    {
        $user = Auth::user();
        $user_child_ids = Auth::user()->childs->pluck('id');
        $user_child_assessment = MusicAssessment::whereIn('child_id',$user_child_ids->all())->get();
        $registered_childs=$user_child_assessment->pluck('child_id');
        $children=Auth::user()->childs()->whereNotIn('id',$registered_childs->all())->get();
        return view('musicAssessment.initial',compact('user','children'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        $data = Input::all();
        $musicassessment = new MusicAssessment();
        $musicassessment->child_id = $data['child_id'];
        $musicassessment->preferred_therapist_id = $data['preferred_therapist_id'];
        $musicassessment->preferred_instrument = $data['preferred_instrument'];
        $musicassessment->time_first_choice = $data['time_first_choice_1'].' '.$data['time_first_choice_2'].' '.$data['time_first_choice_3'];
        $musicassessment->time_second_choice = $data['time_second_choice_1'].' '.$data['time_second_choice_2'].' '.$data['time_second_choice_3'];
        $musicassessment->time_third_choice = $data['time_third_choice_1'].' '.$data['time_third_choice_2'].' '.$data['time_third_choice_3'];
        $musicassessment->save();

        //make a dummy entry in program season table
        $child_program_season = new ChildProgramSeason();
        $child_program_season->child_id = $data['child_id'];
        $child_program_season->program_season_id = 0;
        $child_program_season->status = 'inquired';
        $child_program_season->save();

        $children = Child::findOrFail($data['child_id']);
        $price = 80; //the initial prize is 80
        $minprice = 80;
        $program_season = null;

        return view('paymentmethod',compact('children','price','program_season','minprice'));
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


    /**
     * Pass value to further page.
     *
     * @param  int  $child_id
     * @return \Illuminate\Http\Response
     */
    public function further(Request $request, $userId)
    {
        $child_id = Input::all()['child_id'];
        //dd($child_id);
        $therapists = Therapist::all();
        return view('musicAssessment.further', compact('child_id','therapists'));
    }


    /**
     * Show allprogram page.
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function allprograms()
    {
        //get the list of child
        $user = Auth::user();
        $user_child_ids = Auth::user()->childs->pluck('id');

        //get the list of child who already registered for assessment
        $registered_assessments = MusicAssessment::whereIn('child_id',$user_child_ids->all())->get();

        //initialize flag = show only assessment
        $assessment_button_flag = 'show';
        $music_button_flag = 'noshow';
        //dd($assessment_button_flag, $music_button_flag);

        //if there is no registered child ever, return flags as it is
        if($registered_assessments->isEmpty()){
            //dd($assessment_button_flag, $music_button_flag);
            return view('program.allprograms',compact('assessment_button_flag','music_button_flag'));
        }

        //if all children is registerd for assessment, no show assessment button
        $registered_childs=$registered_assessments->pluck('child_id');
        $not_registered_childs=Auth::user()->childs()->whereNotIn('id',$registered_childs->all())->get();
        if($not_registered_childs->isEmpty()){
            $assessment_button_flag = 'noshow';
        }

        //if there exists a child whose assessment is completed, show music button
        $assessed_childs = $registered_assessments->where('assessment_status','completed');
        if(!$assessed_childs->isEmpty()){
            $music_button_flag = 'show';
        }

        return view('program.allprograms',compact('assessment_button_flag','music_button_flag'));
    }
    
}

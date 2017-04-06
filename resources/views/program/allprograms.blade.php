@extends('layouts.app')

@section('title')
HBK - Dashboard - Program Registeration
@endsection

@section('css')
<style type="text/css">
h1, h3{
    text-align: center;
}

.text-container{
    margin: 20px auto;
    font-size: 18px;
}

.panel-body button{
    margin-bottom: 15px;
}

.btn-music{
    width: 90%;
}

p.lead{
    color: white;
    width: 80%;
}
</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="text-container">
            <center>
                <h1>Program Registeration</h1>
                <p class="lead">Please see the program brochure for descriptions of each program. Some programs may not run if a minimum enrollment
                 level is not achieved. If programs are full, your child will be placed on the waitlist for the next available spot.</p>
            </center>
            </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <h3>Music Programs</h3>
                
                <div class="panel-body">
                 
                    <p>For <strong><u>new participants</u></strong> of our music programs, a <strong>Music Therapy Assessment</strong> is required
                    as the first step before your child(children) participates in a full season music program.</p>

                    <p>For any questions, contact John Taylor at: </p>
                    <p>email address/phone number</p>
                    
                    @if($assessment_button_flag=='show')
                        <a href="{{ URL::action('UserChildMusicAssessmentController@create', Auth::user()->id )}}" style="white-space: normal;" class='btn btn-success btn-lg center-block btn-music'><i class="glyphicon glyphicon-duplicate"></i> Register for an Assessment</a>
                        </br>
                    @endif

                    @if($music_button_flag=='show')
                        <a href="{{url('/allprograms/display/music')}}" style="white-space: normal;" class='btn btn-primary btn-lg center-block btn-music'><i class="glyphicon glyphicon-pencil"></i> Building Community Music Program Registration</a>
                    @endif

                    @if($assessment_button_flag=='noshow' && $music_button_flag=='noshow')
                        <h4>All of your child(ren) are waiting for music therapy assessment. Please contact John Taylor for futher information.</h4>
                    @endif
        
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <h3 class="panel-head">Arts Programs</h3> 
                
                <div class="panel-body">                
                    <p>Arts programs are offered in a group format of approximatedly 8-12 participants, and we
                        are open to participants' siblings.</p>
                                
                <a href="{{url('/allprograms/display/art')}}" class='btn btn-primary btn-lg center-block'><i class="glyphicon glyphicon-apple"></i> Register</a>
                
                </div>
            </div>
            <div class="panel panel-default">
                <h3>Long Weekend <br> Family Programs (Music and Art)</h3>        
                
                <div class="panel-body">         
                    <p>Registration is for one child aged 4-12 and one parent or a family of up to 4 people.</p>
                                
                <a href="{{url('/allprograms/display/all')}}"  class='btn btn-primary btn-lg center-block'><i class="glyphicon glyphicon-tent"></i> Register</a>
                
                </div>
            </div>
        </div>

    </div>
</div>




@endsection

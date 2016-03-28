@extends('layouts.app')

@section('content')
<div class="container">
    
    
    <section id="welcome-greeting" class="text-center">
        
        <p id="brand"><b>Music and Art Portal</b> </p>
        <p> 
            An  initiative by Holland Bloorview Hospital to provide parents with online ease and convenience.
            View available program, register your child, and make payments all from one place
        </p>
        
        <button class="marginer btn btn-default btn-lg"><a href="{{ url('/login') }}">Login</a></button><br>
        <button class="marginer btn btn-default btn-lg"><a href="{{ url('/register') }}">Sign Up</a></button>
    </section>
    
    
    
    
    
    <!--
    <div class="row">
        
        <h1>Holland Bloorview Hospital</h1>
        <h3>Music and Art Programs </h3>
        
        
        
        
        
        
        
        <div class="col-md-8 col-md-offset-2">
            
            
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>-->
</div>
@endsection

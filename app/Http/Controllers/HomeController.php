<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Season as Season;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user=Auth::user();
        //get all seasons that are starting after today.
        $seasons=Season::where('start', '>', Carbon::today()->toDateString())->get();

        
        return view('home',compact('user','seasons'));
    }
}

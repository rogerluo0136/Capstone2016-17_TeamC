<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Child as Child;
use App\Transaction as Transaction;
use App\ChildProgramSeason as ChildProgramSeason;

class TransactionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $id=array();
        $children=$request->input('children');
        $price=$request->input('price');
        $program_season=$request->input('program_season');
        $token=$request->input('token');
        
        //retreive all the children ids
        foreach($children as $child){
            array_push($id,$child['id']);
        }

        //check if user owns all registered children or is admin
        $query=Auth::user()->childs()->whereIn('id',$id)->get();
        if($query->count()!=count($children) && Auth::user()->type!='admin'){
            abort(403,'Unauthorized request');
        }

        //set stripe key,change this to non test secret key in production
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); 

        //check to see if the customer has a stripe id
        if(is_null(Auth::user()->stripe_id)){

            //create a new stripe customer
            $customer = \Stripe\Customer::create(array(
              "card" => $token['id'],
              "email" => Auth::user()->email)
            );

            //store new customer id in the database
            $user=Auth::user();
            $user->stripe_id=$customer->id;
            $user->save();

            // Charge the Customer from stripe
            $charge=\Stripe\Charge::create(array(
              "amount" => $price*100, // amount in cents, again
              "currency" => "cad",
              "customer" => $customer->id)
            );  

        }else{
            // Charge the Customer from stripe
            $charge=\Stripe\Charge::create(array(
              "amount" => $price*100, // amount in cents, again
              "currency" => "cad",
              "customer" => Auth::user()->stripe_id)
            ); 
        }

        if($charge->status=='succeeded'){
   
            foreach($children as $child){                
                //create a transaction record
                Transaction::Create([
                    'user_id'=>Auth::user()->id,
                    'amount'=>($charge->amount)/(100*count($children)),
                    'transaction_type'=>'card',
                    'program_season_id'=>$program_season['id'],
                    'child_id'=>$child['id']
                ]);

                //change child program status
                $cps=ChildProgramSeason::where([
                    ['child_id',$child['id']],
                    ['program_season_id',$program_season['id']]
                ])->first();

                //sum historical payments so far for this program
                $payment_sum=Transaction::where([
                    ['child_id',$child['id']],
                    ['program_season_id',$program_season['id']]
                ])->sum('amount');

                if($payment_sum==$program_season['cost'])
                    $cps->status='paid';
                else{
                    $cps->status='partial';
                }

                $cps->save();    
            }
        }else{
            abort(500,'Payment failed');
        }
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

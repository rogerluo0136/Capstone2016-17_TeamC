<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Mail;
use App\Child as Child;
use App\Transaction as Transaction;
use App\ChildProgramSeason as ChildProgramSeason;
use App\ProgramSeason as ProgramSeason;

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
        $payment_method=$request->input('payment_method');
        
        //retreive all the children ids
        foreach($children as $child){
            array_push($id,$child['id']);
        }

        //check if user owns all registered children or is admin
        $query=Auth::user()->childs()->whereIn('id',$id)->get();
        if($query->count()!=count($children) && Auth::user()->type!='admin'){
            abort(403,'Unauthorized request');
        }
        
        
        //ensure that none of the children that are trying to be registered are taking the 
        //current course
        $flag=ChildProgramSeason::whereIn('child_id',$id)
            ->where([
                ['program_season_id',$program_season['id']],
                ['status','like','enrolled']
            ])->exists();
        
        if($flag){
            abort(400,"Error.Some children are already registered for this program.");
        }
        
        if($payment_method=='funding'){
            //update payment method
            ChildProgramSeason::whereIn('child_id',$id)
                ->where('program_season_id',$program_season['id'])->update(['payment_method'=>'Option 4']);
            
            return response()->json(['status' => '200']);
        }
        
        if($payment_method=='cash'){
            //update payment mehtod
            ChildProgramSeason::whereIn('child_id',$id)
                ->where('program_season_id',$program_season['id'])->update(['payment_method'=>'Option 3']);
            
            return response()->json(['status' => '200']);
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
            try{
               $charge=\Stripe\Charge::create(array(
                  "amount" => $price*100, // amount in cents, again
                  "currency" => "cad",
                  "customer" => $customer->id)
                );
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network problem, perhaps try again.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\InvalidRequest $e) {
                // You screwed up in your programming. Shouldn't happen!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
                
            } catch (\Stripe\Error\Api $e) {
                // Stripe's servers are down!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\Card $e) {
                // Card was declined.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            }
        }else{
            // Charge the Customer from stripe
            try{
                $charge=\Stripe\Charge::create(array(
                  "amount" => $price*100, // amount in cents, again
                  "currency" => "cad",
                  "customer" => Auth::user()->stripe_id)
                ); 
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network problem, perhaps try again.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\InvalidRequest $e) {
                // You screwed up in your programming. Shouldn't happen!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
                
            } catch (\Stripe\Error\Api $e) {
                // Stripe's servers are down!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\Card $e) {
                // Card was declined.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            }
        }
        

        
        if($charge->status=='succeeded'){
            
            //register a transaction record for each child.
            foreach($children as $child){                
                //change child program status
                $cps=ChildProgramSeason::where([
                    ['child_id',$child['id']],
                    ['program_season_id',$program_season['id']]
                ])->first();
                
                
                //create a transaction record
                Transaction::Create([
                    'user_id'=>Auth::user()->id,
                    'amount'=>($charge->amount)/(100*count($children)),
                    'transaction_type'=>'card',
                    'child_program_season_id'=>$cps->id,
                    'charge_id'=>$charge->id
                ]);


                //sum historical payments so far for this program
                $payment_sum=Transaction::where('child_program_season_id',$cps->id)->sum('amount');
                
                if($payment_sum>=$program_season['cost']){
                    $cps->payment_method='Option 1';
                }
                else{
                    $cps->payment_method='Option 2';
                }
                
                $cps->status='enrolled';
                $cps->save();
            }
            
            
            //Send the User an e-receipt
            $ProgramSeason=ProgramSeason::find($program_season['id']);
            $program=$ProgramSeason->program->name;
            $user=Auth::user();
            Mail::send('emails.receipt', ['user' => $user,'program'=>$program,'charge'=>$charge,'children'=>$query], function ($m) use ($user) {
                //$m->from('fake@hollandbloorview.ca', 'Holland Bloorview Hospital');

                $m->to($user->email, $user->name)->subject('Email Receipt');
            });
            
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
    
    
    
    /**
     * pay amount to user's balance
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function settle(Request $request,$cps_id){
        //validate inputted data
        $this->validate($request,[
            'amount'=>'required|numeric',
            'token'=>'required|array'
        ]);
        
        //retrieve input
        $token=$request->input('token');
        $amount=$request->input('amount');
        
        //retrieve the childProgramSeason (cps), fail if non-existant
        $cps=ChildProgramSeason::findOrFail($cps_id);
        
        //sum up all the amount the user has paid for the particular cps
        $amount_paid=$cps->transactions()->sum('amount');
        
        //if there is no balance due, redirect the user back home
        $balance=$cps->programSeason->cost-$amount_paid;
        
        if($balance<=0 || $balance<($amount/100)){
            abort(403,'You are attempting to pay off a settled balance');
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
            try{
               $charge=\Stripe\Charge::create(array(
                  "amount" => $amount, // amount in cents, again
                  "currency" => "cad",
                  "customer" => $customer->id)
                );
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network problem, perhaps try again.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\InvalidRequest $e) {
                // You screwed up in your programming. Shouldn't happen!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
                
            } catch (\Stripe\Error\Api $e) {
                // Stripe's servers are down!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\Card $e) {
                // Card was declined.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            }
        }else{
            // Charge the Customer from stripe
            try{
                $charge=\Stripe\Charge::create(array(
                  "amount" => $amount, // amount in cents, again
                  "currency" => "cad",
                  "customer" => Auth::user()->stripe_id)
                ); 
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network problem, perhaps try again.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\InvalidRequest $e) {
                // You screwed up in your programming. Shouldn't happen!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
                
            } catch (\Stripe\Error\Api $e) {
                // Stripe's servers are down!
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            } catch (\Stripe\Error\Card $e) {
                // Card was declined.
                $e_json = $e->getJsonBody();
                $error = $e_json['error'];
                // Use $error['message'].
                return response()->json(['status' => '500', 'message' => $error['message']]);
            }
        }
        
        if($charge->status=='succeeded'){
            //create a transaction record
            Transaction::Create([
                'user_id'=>Auth::user()->id,
                'amount'=>($charge->amount/100),
                'transaction_type'=>'card',
                'child_program_season_id'=>$cps->id,
                'charge_id'=>$charge->id
            ]);
            
            //send an email receipt
            $amount_paid=$cps->transactions()->sum('amount');
            $balance=$cps->programSeason->cost-$amount_paid;
            $user=Auth::user();
            $data=['user' => $user,'cps'=>$cps,'charge'=>$charge,'balance'=>$balance];
            Mail::send('emails.settlement', $data, function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Email Receipt');
            });
        }
    }
    
    
    
    
    
    /**
     * show user open balance 
     *
     * @param int  $cps_id
     * @return \Illuminate\Http\Response
     */
    public function balance($cps_id){
        //retrieve the childProgramSeason (cps), fail if non-existant
        $cps=ChildProgramSeason::with('transactions','programSeason','programSeason.program','programSeason.season')->findOrFail($cps_id);
        
        //sum up all the amount the user has paid for the particular cps
        $amount_paid=$cps->transactions()->sum('amount');
        
        //if there is no balance due, redirect the user back home
        $balance=$cps->programSeason->cost-$amount_paid;
        if($balance<=0){
            return redirect('/home');
        }
        
        return view('settle',compact('cps','balance'));
    }
    
    
}

<?php

namespace App\Http\Controllers;

use App\Children;
use App\Plan;
use App\Sponsorship;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        return view('subscriptions.index');
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
        //get plan after form submission
        $plans=Plan::all()->sortBy('cost');
        $plan=Plan::findOrFail($request->plan);

        $user=Auth::user()->id;

        //check if user is already subscribed to a plan
        if($request->user()->subscribedToPlan($plan->braintree_plan,'main')){
            flash('Already Subscribed to:&nbsp;<strong>'.$plan->braintree_plan.'&nbsp;</strong>Plan')->error()->important();
            return redirect()->route('plans.index')->with(compact('plans'));

        }
        // if user is not subscribed to any plan
        if(!$request->user()->subscribed('main')){
            $request->user()->newSubscription('main',$plan->braintree_plan)
                ->create($request->payment_method_nonce);
            Sponsorship::where('user_id',$user)->update([
                'payment_method'=>'card',
                'sponsorship_status'=>'active'
            ]);

        }else{
            $request->user()->subscription('main')->swap($plan->braintree_plan);
        }
        flash('Successfully Subscribed to:&nbsp;<strong>'.$plan->braintree_plan.'</strong>&nbsp;Plan.Thank You')->success()->important();


        //redirect after successful subscription

        return redirect()->route('plans.index')->with(compact('plans'));



        //subscribe the user



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
    public function cancel(Request $request){
        $user=Auth::user()->id;
        $request->user()->subscription('main')->cancel();
        flash('You have successfully cancelled your subscription')->success()->important();
        Sponsorship::where('user_id',$user)->update(['sponsorship_status'=>'cancelled']);
        return redirect()->back();

    }
    public function resume(Request $request){
        $user=Auth::user()->id;
        $request->user()->subscription('main')->resume();
        Sponsorship::where('user_id',$user)->update(['sponsorship_status'=>'active']);
        flash('You have successfully resumed your subscription')->success()->important();
        return redirect()->back();
    }
    public function bank_payment($slug){
        $user=Auth::user()->id;
        $plan=Plan::where('slug',$slug)->get();

        $child=Sponsorship::select('child_id')
            ->where('user_id',$user)
            ->distinct('user_id')
            ->first();
        $child_id=$child->child_id;
        $child_details=DB::table('childrens')
            ->select('id','full_name','gender','photo','age','education_level','vulnerability')
            ->where('id','=',$child_id)
            ->get();
        $sponsorship_status=DB::table('sponsorships')
        ->select('sponsorship_status')
            ->where('user_id','=',$user)
            ->get();
        //dd($child_details);
        Sponsorship::where('user_id',$user)->update([
            'payment_method'=>'bank',
        ]);
            $plan_subscribed=Plan::where('slug',$slug)->first();
        Subscription::create([
            'user_id'=>Auth::id(),
           'name'=>'main',
            'braintree_id'=>'bank_payment',
            'braintree_plan'=>$plan_subscribed->braintree_plan,
            'quantity'=>1,
        ]);
        return view('bank.index')->with(compact('plan','child_details','sponsorship_status'));

}
    public function checkApplications(){
        $number=1;
        $user_id=Auth::id();
        $applications=DB::table('sponsorships')
            ->select('sponsorship_status','payment_method','created_at')
            ->where('user_id','=',$user_id)
            ->get();

      return view('applications.index',compact('number','applications'));
}
}

<?php

namespace App\Http\Controllers;

use App\Children;
use App\Contacts;
use App\Plan;
use App\Profile;
use App\Sponsorship;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $countries=DB::table('countries')->pluck('name');
        //$child=DB::table('childrens')->pluck('id');
        $children=DB::table('childrens')
            ->select('childrens.id','childrens.full_name','childrens.photo','childrens.year_of_birth',
                'childrens.gender','childrens.education_level','childrens.vulnerability')
            ->whereNotIn('childrens.id',DB::table('sponsorships')->pluck('child_id'))
            ->get();
            /*DB::table('childrens')
        ->select('childrens.id')
        ->join('sponsorships',function ($join){
            $join->on('childrens.id','=','sponsorships.child_id');
        })
        //->where('sponsorships.sponsorship_status','=','inactive')
            ->where('sponsorships.child_id','=',null)
        ->distinct()->get(['sponsorships.child_id']);
            */
        //dd($children);

       $child_count=1;
       $child_no=1;



       // dd($countries);
        //dd($child);
        return view('Sponsor.index',compact('countries','children','child_count','child_no'));
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
        //

        if (Auth::check()){
            $input=request()->validate([
                'period'=>'integer|min:1|max:20|required',
                'phone_number'=>'string|min:10|required|unique:sponsorships',
                'child_id'
            ]);
               $input=request()->all();
               $user=Auth::user()->id;
               $person=User::select('first_name')
                   ->where('id',$user)
                   ->first();
              // dd($person->first_name);
               $sponsor=Sponsorship::where('user_id',$user)->exists();
               if($sponsor){
                   flash('Sorry! '.$person->first_name.' you already have a sponsorship application..You can only sponsor <b>one child</b>. Please check &#147;my applications&#148; under your profile.')->error();
                   return redirect()->back();
               }
            $sponsorship=Sponsorship::create([
               'user_id'=>$request->user()->id,
                'first_name'=>$request->user()->first_name,
                'last_name'=>$request->user()->last_name,
                'nationality'=>$request->user()->nationality,
                'child_id'=>$request->input('child_name'),
                'period'=>$request->input('period'),
                'phone_number'=>$request->input('phone_number'),

            ]);
               $profile=new Profile();
               $profile->user_id=Auth::user()->id;
               $profile->city=$request['city'];
               $profile->post_code=$request['post_code'];
               $profile->address=$request['address'];
               $profile->save();
            $child_id=$request->input('child_name');
            $getChild=Children::where('id',$child_id)->first();

            if($sponsorship){
                $plans=Plan::all()->sortBy('cost');
                flash('Thank you for being interested in sponsoring &nbsp;'.$getChild->full_name.'.&nbsp;Complete
                your application by subscribing to one of the below plans')->success();
                return view('plans.index')->with(compact('plans'));
            }

        }
        //return back()->withInput()->with('errors','Application NOT SENT..Retry....');
        flash("Application Not Sent. Ensure you're logged in to make an application")->error();
       return redirect()->route('Sponsor.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $application=Sponsorship::find($id);//
        //where('id',$id)
          //  ->get();
       // dd($application);
        if($application->delete()){
            flash('Application successfully removed')->success();
            return redirect()->route('bank-sponsorships');
        }
        flash('Could not remove the application');
        return back();

    }
    public function active(Sponsorship $sponsorship){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();


        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        //$sponsorship=Sponsorship::where('sponsorship_status','active')->get();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','sponsorships.period','subscriptions.created_at','subscriptions.braintree_plan',
                'subscriptions.ends_at','plans.cost','users.nationality')
            ->join('sponsorships',function ($join){
              $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('subscriptions',function ($join){
                $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->join('users',function($join){
                $join->on('users.id','=','subscriptions.user_id');
            })
            ->join('plans',function ($join){
                $join->on('subscriptions.braintree_plan','=','plans.braintree_plan');
            })
            ->where('sponsorships.sponsorship_status','=','active')
            ->where('subscriptions.ends_at','=',null)
        ->get();
        //dd($sponsorship);
       return view('Admin/sponsorships.active')->with(compact('sponsorship','count','users',
           'activeSponsorship','children','messages','projects','events','all_messages'));

    }
    public function inactive(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','sponsorships.period',
                'sponsorships.id','users.nationality')
            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','user_id');
            })
            ->where('sponsorships.sponsorship_status','=','inactive')
            ->get();

       // dd($sponsorship);

        return view('Admin/sponsorships.inactive')->with(compact('sponsorship','count',
            'activeSponsorship','users','children','messages','projects','events','all_messages'));


    }
    public function sponsored(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','users.nationality')
            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('subscriptions',function ($join){
                $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->join('users',function($join){
                $join->on('users.id','=','subscriptions.user_id');
            })
            ->join('plans',function ($join){
                $join->on('subscriptions.braintree_plan','=','plans.braintree_plan');
            })
            ->where('sponsorships.sponsorship_status','=','active')

           // ->where('subscriptions.ends_at','=',null)
            ->distinct()->get(['childrens.full_name']);
        return view('Admin/sponsorships.sponsored')->with(compact('sponsorship','count',
            'activeSponsorship','users','children','messages','projects','events','all_messages'));

    }
    public function terminate(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        //$sponsorship=Sponsorship::where('sponsorship_status','active')->get();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','subscriptions.created_at','subscriptions.braintree_plan',
                'subscriptions.ends_at','subscriptions.braintree_id','plans.cost','users.nationality')
            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('subscriptions',function ($join){
                $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->join('users',function($join){
                $join->on('users.id','=','subscriptions.user_id');
            })
            ->join('plans',function ($join){
                $join->on('subscriptions.braintree_plan','=','plans.braintree_plan');
            })
            ->where('sponsorships.sponsorship_status','=','active')
            ->where('subscriptions.ends_at','=',null)
            ->distinct()->get(['childrens.full_name']);

        return view('Admin/sponsorships.terminate')->with(compact('sponsorship','count',
            'activeSponsorship','users','children','messages','projects','events','all_messages'));


    }
    public function terminateSponsorship(Subscription $subscription,$sponsor_id){
        $subscription=Subscription::where('braintree_id',$sponsor_id)->first();
        $request=new Request();

       //$request->user()->subscription('main')->cancel();

        dd($subscription->user_id);

    }
    public function cancelled(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','subscriptions.created_at','subscriptions.braintree_plan',
                'subscriptions.ends_at','subscriptions.braintree_id','plans.cost','users.nationality')
            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('subscriptions',function ($join){
                $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->join('users',function($join){
                $join->on('users.id','=','subscriptions.user_id');
            })
            ->join('plans',function ($join){
                $join->on('subscriptions.braintree_plan','=','plans.braintree_plan');
            })
            ->where('sponsorships.sponsorship_status','=','cancelled')
            ->where('subscriptions.ends_at','=',null)
            ->get();
        return view('Admin/sponsorships.cancelled')->with(compact('sponsorship','activeSponsorship','users','children','messages',
            'projects','events','count','all_messages'));
    }
    public function basic_plan(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','subscriptions.created_at','subscriptions.braintree_plan',
                'subscriptions.ends_at','subscriptions.braintree_id','users.nationality','plans.cost','sponsorships.period')

            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','sponsorships.user_id');
            })

            ->join('subscriptions',function ($join){
              $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->join('plans',function ($join){
                $join->on('plans.braintree_plan','=','subscriptions.braintree_plan');
            })
            ->where('subscriptions.braintree_plan','=','Basic_Plan_I')
            ->get();
        //dd($sponsorship);
        return view('Admin/sponsorships.basic-plan')->with(compact('sponsorship','activeSponsorship','users','children','messages',
            'projects','events','count','all_messages'));
    }
    public function basic_plan_II(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','subscriptions.created_at','subscriptions.braintree_plan',
                'subscriptions.ends_at','subscriptions.braintree_id','users.nationality','plans.cost','sponsorships.period')

            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','sponsorships.user_id');
            })

            ->join('subscriptions',function ($join){
                $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->join('plans',function ($join){
                $join->on('plans.braintree_plan','=','subscriptions.braintree_plan');
            })
            ->where('subscriptions.braintree_plan','=','Basic_Plan_II')
            ->get();
        //dd($sponsorship);
        return view('Admin/sponsorships.basic-plan-II')->with(compact('sponsorship','activeSponsorship','users','children','messages',
            'projects','events','count','all_messages'));

    }
    public function annual_plan(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();
        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name','subscriptions.created_at','subscriptions.braintree_plan',
                'subscriptions.ends_at','subscriptions.braintree_id','users.nationality','plans.cost','sponsorships.period')

            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','sponsorships.user_id');
            })

            ->join('subscriptions',function ($join){
                $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->join('plans',function ($join){
                $join->on('plans.braintree_plan','=','subscriptions.braintree_plan');
            })
            ->where('subscriptions.braintree_plan','=','Premium')
            ->get();
        //dd($sponsorship);
        return view('Admin/sponsorships.annual-plan')->with(compact('sponsorship','activeSponsorship','users','children','messages',
            'projects','events','count','all_messages'));


    }
    public function bank_sponsorships(){
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();
        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $count=1;
        $all_messages=Contacts::all();

        $sponsorship=DB::table('childrens')
            ->select('childrens.full_name as child_name','childrens.gender','childrens.photo','childrens.age',
                'sponsorships.first_name','sponsorships.last_name'
                ,'users.nationality','sponsorships.period','receipts.receipt','receipts.created_at','sponsorships.period')

            ->join('sponsorships',function ($join){
                $join->on('sponsorships.child_id','=','childrens.id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','sponsorships.user_id');
            })
            ->join('receipts',function ($join){
                $join->on('users.id','=','receipts.user_id');
            })
            ->where('sponsorships.payment_method','=','bank')


            ->get();
       // dd($sponsorship);

        return view('Admin/sponsorships.bank_sponsorships')->with(compact('sponsorship','activeSponsorship','users','children','messages',
            'projects','events','count','all_messages'));
    }
}

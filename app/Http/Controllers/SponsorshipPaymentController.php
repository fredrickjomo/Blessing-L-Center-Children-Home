<?php

namespace App\Http\Controllers;

use App\Children;
use App\Contacts;
use App\Sponsorship;
use App\SponsorshipPayment;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\App;
use PDF;
use FontLib\EOT\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class SponsorshipPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();

        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $all_messages=Contacts::all();
        $sponsor=Sponsorship::all();
        $sponsored_children=DB::table('childrens')
            ->select('childrens.full_name','sponsorships.child_id')
            ->join('sponsorships',function ($join){
                $join->on('childrens.id','=','sponsorships.child_id');
            })
            ->get();

        return view('Admin/payments.update-sponsorship-payment')->with(compact('users','children','messages',
            'activeSponsorship','all_messages','projects','events','sponsor','sponsored_children'));
    }
    public function getChild($id){
        $child=DB::table('sponsorships')
            ->select('sponsorships.child_id','childrens.full_name')
            ->join('childrens',function ($join){
                $join->on('childrens.id','=','sponsorships.child_id');
            })
            ->where('user_id',$id)
            ->pluck("childrens.full_name","sponsorships.child_id");
        return json_encode($child);

    }
    public function getPlan($id){
        $plan=DB::table('sponsorships')
            ->select('sponsorships.child_id','subscriptions.braintree_plan')
            ->join('subscriptions',function ($join){
                $join->on('subscriptions.user_id','=','sponsorships.user_id');
            })
            ->where('sponsorships.user_id',$id)
            ->pluck("subscriptions.braintree_plan","subscriptions.braintree_plan");
        return json_encode($plan);
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
        $validatedData = $request->validate([
            'year'=>'required|integer|min:2018',
            'month' => 'required|string',
            'sponsor'=>'required|integer|',
            'child'=>'required|integer',
            'plan'=>'required|string',
            'pay'=>'integer|required',
            'amount_lack'=>'integer',
            'transaction_id'=>'string|required|min:10|unique:sponsorship_payments',
            'receipt'=>'file|mimes:pdf|max:5000',
        ]);
        if($validatedData){
            $check_entry=SponsorshipPayment::where('year',$request->input('year'))
                ->where('month',$request->input('month'))
                ->where('sponsor_id',$request->input('sponsor'))
                ->exists();
            if($check_entry==true){
                flash('Payment for this period has already been made.Please update in case of any changes!')->error()->important();
                return redirect()->back();
            }
            $fileName='';
            if($request->hasFile('receipt')){
                $extension = $request->file('receipt')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('receipt')->move(storage_path().'/app/public/receipts/',$fileName);
            }


            $payment=SponsorshipPayment::create([
                'year'=>$request->input('year'),
                'month'=>$request->input('month'),
                'sponsor_id'=>$request->input('sponsor'),
                'child_id'=>$request->input('child'),
                'plan_subscribed'=>$request->input('plan'),
                'pay'=>$request->input('pay'),
                'amount_lack'=>$request->input('deficient'),
                'transaction_id'=>$request->input('transaction_id'),
                'receipt'=>$fileName,

            ]);
            if($payment){
                $activate_bank_payments=Sponsorship::where('user_id',$request->input('sponsor'))->first();
                if ($activate_bank_payments->sponsorship_status=='inactive'){

                    Sponsorship::where('user_id',$request->input('sponsor'))
                        ->update([
                           'sponsorship_status'=>'active',
                        ]);
                }
                $t_count=1;
                $activeSponsorship=DB::table('sponsorships')
                    ->select('sponsorship_status')
                    ->where('sponsorship_status','=','active')
                    ->count();

                $users=DB::table('users')->count();
                $children=DB::table('childrens')->count();
                $messages=DB::table('contacts')->count();
                $projects=DB::table('projects')->count();
                $events=DB::table('charity_events')->count();
                $all_messages=Contacts::all();
                $children_details=Children::all();
                $payments=DB::table('sponsorship_payments')
                    ->select('sponsorship_payments.year','sponsorship_payments.month','sponsorship_payments.created_at','childrens.full_name','users.first_name','users.last_name','sponsorship_payments.year','sponsorship_payments.month','sponsorship_payments.pay','sponsorship_payments.amount_lack','sponsorship_payments.receipt','sponsorship_payments.transaction_id','sponsorship_payments.id')
                    ->join('childrens',function ($join){
                        $join->on('childrens.id','=','sponsorship_payments.child_id');
                    })
                    ->join('users',function ($join){
                        $join->on('users.id','=','sponsorship_payments.sponsor_id');
                    })
                    ->orderBy('sponsorship_payments.created_at','desc')
                    ->paginate(10);

                flash('Payment Updated Successfully')->success()->important();
                return view('Admin/payments.show',compact('t_count','payments','users','children','projects','events','activeSponsorship'));
            }
            flash('Error in Updating Payment')->error();
            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $t_count=1;
        $activeSponsorship=DB::table('sponsorships')
            ->select('sponsorship_status')
            ->where('sponsorship_status','=','active')
            ->count();

        $users=DB::table('users')->count();
        $children=DB::table('childrens')->count();
        $messages=DB::table('contacts')->count();
        $projects=DB::table('projects')->count();
        $events=DB::table('charity_events')->count();
        $all_messages=Contacts::all();
        $children_details=Children::all();
        $payments=DB::table('sponsorship_payments')
            ->select('sponsorship_payments.year','sponsorship_payments.month','sponsorship_payments.created_at','childrens.full_name','users.first_name','users.last_name','sponsorship_payments.year','sponsorship_payments.month','sponsorship_payments.pay','sponsorship_payments.amount_lack','sponsorship_payments.transaction_id','sponsorship_payments.receipt','sponsorship_payments.id')
            ->join('childrens',function ($join){
                $join->on('childrens.id','=','sponsorship_payments.child_id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','sponsorship_payments.sponsor_id');
            })
            ->orderBy('sponsorship_payments.created_at','desc')
            ->paginate(10);

        return view('Admin/payments.show',compact('t_count','users','children','projects','events','activeSponsorship','payments'));

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
    public function payment($pay){
        $pay=10;
        return json_encode($pay);
    }
    public function receipt($id){
        $receipt=SponsorshipPayment::where('id',$id)->first();
        $receipt_file=$receipt->receipt;
        $path=storage_path('app/public/receipts/'.$receipt_file);
        return response()->file($path);
        //dd($path);

    }
    public function generate_reports($id){
        $report=DB::table('sponsorship_payments')
            ->where('sponsorship_payments.id',$id)
            ->select('sponsorship_payments.plan_subscribed','sponsorship_payments.pay','sponsorship_payments.amount_lack',
                'sponsorship_payments.transaction_id','childrens.full_name','sponsorships.first_name','sponsorships.last_name',
                'sponsorships.phone_number','sponsorships.nationality','users.email','sponsorship_payments.id',
                'sponsorship_payments.month','sponsorship_payments.year')
            ->join('childrens',function ($join){
                $join->on('sponsorship_payments.child_id','=','childrens.id');
            })
            ->join('sponsorships',function ($join){
                $join->on('sponsorships.user_id','=','sponsorship_payments.sponsor_id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','sponsorship_payments.sponsor_id');
            })
            ->first();
        //dd($report);


         return view('Admin/payments.receipt',compact('report'));

       /* $pdf=PDF::loadView('Admin/payments.receipt');
        return $pdf->download('invoice.pdf')*/

    }
    public function download_receipt($id){
        $report=DB::table('sponsorship_payments')
            ->where('sponsorship_payments.id',$id)
            ->select('sponsorship_payments.plan_subscribed','sponsorship_payments.pay','sponsorship_payments.amount_lack',
                'sponsorship_payments.transaction_id','childrens.full_name','sponsorships.first_name','sponsorships.last_name',
                'sponsorships.phone_number','sponsorships.nationality','users.email','sponsorship_payments.id',
                'sponsorship_payments.month','sponsorship_payments.year')
            ->join('childrens',function ($join){
                $join->on('sponsorship_payments.child_id','=','childrens.id');
            })
            ->join('sponsorships',function ($join){
                $join->on('sponsorships.user_id','=','sponsorship_payments.sponsor_id');
            })
            ->join('users',function ($join){
                $join->on('users.id','=','sponsorship_payments.sponsor_id');
            })
            ->first();
        $pdf=PDF::loadView('Admin/payments.receipt',compact('report'));
        return $pdf->download('payment_invoice.pdf');
    }


}

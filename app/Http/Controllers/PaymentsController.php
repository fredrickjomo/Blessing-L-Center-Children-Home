<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_Transaction;
use PHPUnit\Framework\Constraint\IsTrue;

class PaymentsController extends Controller
{
    //
    public function paypal(Request $request){
        return view('donations.paypal');
    }
    public function visaCard(Request $request){
        $validatedData = $request->validate([
            'amount' => 'required|integer|min:1|max:10000',
        ]);
        if ($validatedData){
            $amount=$request->input('amount');
            return view('donations.visa-card',compact('amount'));
        }


    }
    public function visacardProcess(Request $request,$amount){
        $payload=$request->input('payload',false);
        $nonce=$payload['nonce'];
        $status=Braintree_Transaction::sale([
            'amount'=>$amount,
            'paymentMethodNonce'=>$nonce,
            'options'=>[
                'submitForSettlement'=>true
            ]
        ]);
        return response()->json($status);

    }
    public function enter_amount(){
        return view('donations.amount');
    }

}

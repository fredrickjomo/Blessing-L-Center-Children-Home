<?php

namespace App\Http\Controllers;

use App\Verifyuser;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    public function verify(Verifyuser $token){
        $token->user()->update([
            'verified'=>true

        ]);
        $token->delete();
        flash('Email verification successful.Please login again');
        return redirect('/login');

    }
    public function resend(Request $request){

    }
}

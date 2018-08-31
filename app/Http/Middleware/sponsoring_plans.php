<?php

namespace App\Http\Middleware;

use App\Sponsorship;
use Closure;
use Illuminate\Support\Facades\Auth;

class sponsoring_plans
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth::user()->id;
        $sponsor=Sponsorship::where('user_id',$user)->exists();
        //dd($sponsor);
        if($sponsor==false){
            flash('Select Child to Sponsor in the below form before selecting plan')->warning()->important();
            return redirect()->route('Sponsor.index');
        }
        return $next($request);
    }
}

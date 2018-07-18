<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckLoggedInUser
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


        // dd(session()->has('user_info'));

        
        if(session()->has('user_info'))
        {
            return $next($request);

        }
        else
        {
            return response()->json(
                [
                    'result' => 0,
                    'status' => 401,
                    'message'=> 'Unauthorized'
                ]);
        }    
    }
}

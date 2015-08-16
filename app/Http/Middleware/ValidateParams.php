<?php

namespace App\Http\Middleware;

use Closure;

class ValidateParams
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
        $req_cal = $request->calendars;
        $req_eve = $request->events;

        if($req_cal){
            //check if calendar belongs to user
            if($request->user()->calendars->find($req_cal)){
                //check if event belongs to user
                if($req_eve){
                    if($request->user()->calendars->find($req_cal)->events->find($req_eve)){
                        return $next($request); 
                    } else {
                        return response('Invalid Request!', 404);
                    }
                }
                return $next($request);       
            } else {
                return response('Invalid Request!', 404);
            }
        } else {
            return $next($request); 
        }
    }
}

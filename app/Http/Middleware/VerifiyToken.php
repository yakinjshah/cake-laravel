<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifiyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $token ='Bearer '.env('API_TOKEN');
        if($request->header('authorization') !=  $token){
            return response()->json([
                'status'=>'error',
                'message'=>'Unauthorized',
            ],401);

            die;
        }
        return $next($request);
    }
}

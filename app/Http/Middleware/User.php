<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class User
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guest() || Auth::user()->level !== 'user' ){
            return redirect('login');
        }
        return $next($request);
    }
}

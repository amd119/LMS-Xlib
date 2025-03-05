<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Petugas
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()?->Role=='Petugas') {
            return $next($request);
        }

        abort(401);
    }
}

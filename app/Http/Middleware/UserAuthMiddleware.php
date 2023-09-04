<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::user()->role;
        if($role == 'admin') {
            return abort(403);
        }

        return $next($request);
    }
}

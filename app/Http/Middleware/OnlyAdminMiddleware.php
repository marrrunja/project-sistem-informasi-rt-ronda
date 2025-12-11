<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if($request->session()->get('is_admin') === false){
            return abort(403);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class XTokenAuth
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
        if(!$request->hasHeader('X-Token') || env('WALLET_API_CLIENT_TOKEN') === null || $request->header('X-Token') !== env('WALLET_API_CLIENT_TOKEN'))
        {
            return response(['message' => 'Unauthorized action'], 401);
        }

        return $next($request);
    }
}

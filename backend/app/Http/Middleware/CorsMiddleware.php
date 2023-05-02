<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $response = $next($request);

    $response->header('Access-Control-Allow-Origin', 'http://localhost:5173');
    $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
    $response->header('Access-Control-Allow-Headers', 'Authorization, Content-Type');

    return $response;
}

}

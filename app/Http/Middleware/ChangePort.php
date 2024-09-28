<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('X-Forwarded-Port', 443);
        $request->server->set('SERVER_PORT', 443);
        $request->server->set('HTTP_HOST', request()->getHost()); // Make sure no port is added to the host

            // Log the request method and URL
        Log::debug('Incoming request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'payload' => $request->all(),
        ]);

        return $next($request);}
}

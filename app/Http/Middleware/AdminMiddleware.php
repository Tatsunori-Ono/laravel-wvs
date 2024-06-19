<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('AdminMiddleware: Checking user role');

        if (Auth::check() && Auth::user()->role === 'admin') {
            Log::info('AdminMiddleware: User is admin');
            return $next($request);
        }

        Log::warning('AdminMiddleware: User is not admin, redirecting');
        return redirect('/')->with('error', 'You do not have admin access.'); // ユーザーがAdminでない場合、別のページにリダイレクトする。
    }
}

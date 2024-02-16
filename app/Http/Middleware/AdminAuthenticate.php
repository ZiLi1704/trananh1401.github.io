<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    if (!session('admin') || session('admin') !== true) {
        return redirect()->route('user.login')->with('success', 'Bạn không có quyền hạn này');
    } else {
        return $next($request);
    }
}
}

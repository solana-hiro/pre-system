<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SidemenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('selected_def1')) $request->session()->put('selected_def1', $request->input('selected_def1'));
        if ($request->has('selected_def2')) $request->session()->put('selected_def2', $request->input('selected_def2'));
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isPeserta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guest()) {
            return redirect(route('dashboard'));
        }
        if (auth()->user()->role !== "peserta") {
            return redirect(route('admin.index'));
        }
        return $next($request);
    }
}

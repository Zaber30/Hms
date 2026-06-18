<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class Rolesmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
        abort(403, 'Unauthorized access');
        }

          return $next($request);
    }
}

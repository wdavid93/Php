<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasCookie('locale')) {
            if (is_array($request->cookie('locale')) || is_null($request->cookie('locale'))) {
                $request->cookie('locale', 'en');
            } else {
                app()->setLocale($request->cookie('locale'));
            }
        }

        return $next($request);
    }
}

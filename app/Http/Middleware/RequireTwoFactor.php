<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireTwoFactor
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        // 2FA aktif ama doğrulanmamışsa challenge'a yönlendir
        if ($user->two_factor_enabled && !$request->session()->get('2fa_verified')) {
            // Challenge rotası değilse yönlendir
            if (!$request->routeIs('admin.2fa.challenge') && !$request->routeIs('admin.2fa.verify')) {
                return redirect()->route('admin.2fa.challenge');
            }
        }

        // 2FA aktif değilse setup'a yönlendir
        if (!$user->two_factor_enabled) {
            if (!$request->routeIs('admin.2fa.setup') && !$request->routeIs('admin.2fa.enable')) {
                return redirect()->route('admin.2fa.setup');
            }
        }

        return $next($request);
    }
}
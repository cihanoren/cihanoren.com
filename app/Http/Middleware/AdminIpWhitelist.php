<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminIpWhitelist
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIps = array_filter(
            explode(',', env('ADMIN_ALLOWED_IPS', ''))
        );

        // Whitelist boşsa engelleme (production'da mutlaka doldur)
        if (empty($allowedIps)) {
            return $next($request);
        }

        $clientIp = $request->ip();

        if (!in_array($clientIp, $allowedIps)) {
            Log::warning('Admin panel unauthorized IP attempt', [
                'ip'    => $clientIp,
                'url'   => $request->fullUrl(),
                'agent' => $request->userAgent(),
                'time'  => now(),
            ]);

            abort(404); // 403 değil 404 — panelin varlığını gizle
        }

        return $next($request);
    }
}
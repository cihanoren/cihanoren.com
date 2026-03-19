<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogLoginAttempts
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Sadece login POST isteğini yakala
        if ($request->isMethod('POST') && $request->routeIs('login')) {
            $status = $response->getStatusCode();

            DB::table('login_logs')->insert([
                'email'          => $request->input('email', ''),
                'ip_address'     => $request->ip(),
                'user_agent'     => $request->userAgent(),
                'status'         => ($status < 400) ? 'success' : 'failed',
                'failure_reason' => ($status >= 400) ? 'Invalid credentials' : null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        return $response;
    }
}
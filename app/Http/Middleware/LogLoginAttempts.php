<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Activity;

class LogLoginAttempts
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Sadece login POST isteğini yakala
        if ($request->isMethod('POST') && $request->routeIs('login')) {
            $status = $response->getStatusCode();
            $success = $status < 400;

            DB::table('login_logs')->insert([
                'email'          => $request->input('email', ''),
                'ip_address'     => $request->ip(),
                'user_agent'     => $request->userAgent(),
                'status'         => $success ? 'success' : 'failed',
                'failure_reason' => $success ? null : 'Invalid credentials',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            if ($success) {
                Activity::log('login', 'User', 'Admin panele başarılı giriş yapıldı. IP: ' . $request->ip());
            } else {
                Activity::log('failed_login', 'User', 'Başarısız giriş denemesi. IP: ' . $request->ip());
            }
        }

        return $response;
    }
}
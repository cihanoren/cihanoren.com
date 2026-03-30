<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Manuel seçim session'da varsa onu kullan
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
            return $next($request);
        }

        // Tarayıcı dilini algıla
        $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE', 'en'), 0, 2);
        $locale = in_array($browserLang, ['tr', 'en']) ? $browserLang : 'en';

        App::setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}
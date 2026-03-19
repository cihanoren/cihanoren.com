<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    // 2FA setup sayfası — QR kodu göster
    public function setup(Request $request)
    {
        $user = $request->user();

        // Zaten aktifse direkt dashboard'a yönlendir
        if ($user->two_factor_enabled) {
            return redirect()->route('admin.dashboard');
        }

        // Secret yoksa yeni oluştur, session'a kaydet
        if (!$request->session()->has('2fa_secret')) {
            $google2fa = new Google2FA();
            $secret = $google2fa->generateSecretKey();
            $request->session()->put('2fa_secret', $secret);
        }

        $secret = $request->session()->get('2fa_secret');

        // QR kod oluştur
        $google2fa = new Google2FA();
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($qrCodeUrl);

        return view('admin.two-factor.setup', compact('secret', 'qrCodeSvg'));
    }

    // 2FA aktifleştir — kodu doğrula ve kaydet
    public function enable(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $secret = $request->session()->get('2fa_secret');

        if (!$secret) {
            return back()->withErrors(['code' => 'Session expired. Please try again.']);
        }

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Invalid code. Please try again.']);
        }

        $request->user()->update([
            'two_factor_secret'  => encrypt($secret),
            'two_factor_enabled' => true,
        ]);

        $request->session()->forget('2fa_secret');
        $request->session()->put('2fa_verified', true);

        return redirect()->route('admin.dashboard')->with('success', '2FA enabled successfully.');
    }

    // 2FA doğrulama sayfası — login sonrası
    public function challenge(Request $request)
    {
        if ($request->session()->get('2fa_verified')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.two-factor.challenge');
    }

    // 2FA kodu doğrula
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = $request->user();
        $secret = decrypt($user->two_factor_secret);

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Invalid code. Please try again.']);
        }

        $request->session()->put('2fa_verified', true);

        return redirect()->intended(route('admin.dashboard'));
    }

    // 2FA deaktif et
    public function disable(Request $request)
    {
        $request->user()->update([
            'two_factor_secret'  => null,
            'two_factor_enabled' => false,
        ]);

        $request->session()->forget('2fa_verified');

        return back()->with('success', '2FA disabled.');
    }
}
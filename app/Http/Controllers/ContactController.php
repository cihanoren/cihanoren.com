<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // DB'ye kaydet
        $message = Message::create($validated);

        // Admin'e bildirim gönder
        try {
            Notification::route('mail', env('ADMIN_EMAIL'))
                ->notify(new NewMessageNotification($message));
        } catch (\Exception $e) {
            \Log::error('Admin mail gönderilemedi: ' . $e->getMessage());
        }

        // Gönderene onay maili at
        try {
            \Mail::html('
                <div style="font-family: sans-serif; max-width: 560px; margin: 0 auto; color: #e5e7eb; background: #030712; padding: 40px 32px; border-radius: 16px;">
                    <h2 style="color: #fff; font-size: 20px; margin-bottom: 8px;">Mesajınız alındı! 👋</h2>
                    <p style="color: #9ca3af; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                        Merhaba <strong style="color: #e5e7eb;">' . e($message->name) . '</strong>,<br>
                        Mesajınız başarıyla iletildi. En kısa sürede geri dönüş yapacağım.
                    </p>
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 16px 20px; margin-bottom: 24px;">
                        <p style="color: #6b7280; font-size: 12px; margin: 0 0 8px;">Gönderdiğiniz mesaj:</p>
                        <p style="color: #d1d5db; font-size: 14px; line-height: 1.6; margin: 0;">' . nl2br(e($message->message)) . '</p>
                    </div>
                    <p style="color: #6b7280; font-size: 13px; margin: 0;">
                        — <strong style="color: #818cf8;">Cihan Ören</strong><br>
                        <a href="https://cihanoren.com" style="color: #6366f1; text-decoration: none;">cihanoren.com</a>
                    </p>
                </div>
            ', function ($mail) use ($message) {
                $mail->to($message->email, $message->name)
                     ->subject('Mesajınız alındı — Cihan Ören');
            });
        } catch (\Exception $e) {
            \Log::error('Onay maili gönderilemedi: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent! I\'ll get back to you soon.');
    }
}
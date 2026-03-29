<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Activity;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'inbox');

        $messages = match($filter) {
            'archived' => Message::archived()->orderByDesc('created_at')->get(),
            'unread'   => Message::unread()->orderByDesc('created_at')->get(),
            default    => Message::inbox()->orderByDesc('created_at')->get(),
        };

        $counts = [
            'inbox'    => Message::inbox()->count(),
            'unread'   => Message::unread()->count(),
            'archived' => Message::archived()->count(),
        ];

        return view('admin.messages.index', compact('messages', 'filter', 'counts'));
    }

    public function show(Message $message)
    {
        // Otomatik okundu işaretle
        if (!$message->is_read) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function markRead(Message $message)
    {
        $message->markAsRead();
        return back()->with('success', 'Marked as read.');
    }

    public function markUnread(Message $message)
    {
        $message->update(['is_read' => false, 'read_at' => null]);
        return back()->with('success', 'Marked as unread.');
    }

    public function archive(Message $message)
    {
        $message->update(['is_archived' => true]);
        Activity::log('updated', 'Message', "\"{$message->name}\" mesajı arşivlendi.");
        return back()->with('success', 'Message archived.');
    }

    public function unarchive(Message $message)
    {
        $message->update(['is_archived' => false]);
        return back()->with('success', 'Message moved to inbox.');
    }

    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'reply' => ['required', 'string', 'max:5000'],
        ]);

        try {
            \Mail::html('
                <div style="font-family: sans-serif; max-width: 560px; margin: 0 auto; color: #333; padding: 32px;">
                    <p style="font-size: 15px; line-height: 1.7;">' . nl2br(e($request->reply)) . '</p>
                    <hr style="border: none; border-top: 1px solid #eee; margin: 24px 0;">
                    <p style="color: #999; font-size: 13px;">
                        <strong>Original message from ' . e($message->name) . ':</strong><br>
                        ' . nl2br(e($message->message)) . '
                    </p>
                </div>
            ', function ($mail) use ($message) {
                $mail->to($message->email, $message->name)
                     ->subject('Re: Your message — CihanÖren');
            });

            Activity::log('updated', 'Message', "\"{$message->name}\" mesajına cevap verildi.");
            return back()->with('success', 'Reply sent to ' . $message->email);

        } catch (\Exception $e) {
            return back()->withErrors(['reply' => 'Mail gönderilemedi: ' . $e->getMessage()]);
        }
    }

    public function destroy(Message $message)
    {
        $name = $message->name;
        $message->delete();
        Activity::log('deleted', 'Message', "\"{$name}\" mesajı silindi.");
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }
}
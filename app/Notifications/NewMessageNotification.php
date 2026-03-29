<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(public Message $message) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('📬 Yeni mesaj: ' . $this->message->name)
            ->greeting('Merhaba Cihan!')
            ->line('Portfolyo sitenden yeni bir mesaj aldın.')
            ->line('**Gönderen:** ' . $this->message->name)
            ->line('**E-posta:** ' . $this->message->email)
            ->line('**Mesaj:**')
            ->line($this->message->message)
            ->action('Mesajı Görüntüle', route('admin.messages.show', $this->message))
            ->line('— cihanoren.com');
    }
}
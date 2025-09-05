<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $order)
    {
        // You can store the order or any other data you need here
        $this->order = $order;
    }
    

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via( $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail( $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello! Admin')
            ->line('Bạn đã nhận được một đơn hàng mới từ '.$this -> order -> name.' nè')
            ->action('Nhấn vào đây để xác nhận đi', url('/'))
            ->line('Cảm ơn bạn gất nhiều HeHe!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

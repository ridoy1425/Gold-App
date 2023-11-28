<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\NotificationChannel;

class UserNotification extends Notification
{
    use Queueable;
    public $subject;
    public $message;
    public $sender_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $sender_id)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->sender_id = $sender_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            NotificationChannel::class
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'sender_id' => $this->sender_id,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
    }
}

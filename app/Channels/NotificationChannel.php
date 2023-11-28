<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;
use Illuminate\Support\Facades\Auth;

class NotificationChannel extends IlluminateDatabaseChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $this->getData($notifiable, $notification);
        return $notifiable->routeNotificationFor('database')->create([
            'id'      => $notification->id,
            'type'    => get_class($notification),
            'sender_id' => $data['sender_id'],
            'data'    => $data,
            'read_at' => null,
        ]);
    }
}

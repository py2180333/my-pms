<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveNotification extends Notification
{
    use Queueable;
    protected $resource;

    /**
     * Create a new notification instance.
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data' => 'Leave request form submitted by '.$this->resource['first_name'].' '.$this->resource['last_name'].' ('.$this->resource['email'].') resource.'
        ];
    }
}

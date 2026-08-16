<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MilestoneReminder extends Notification
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->details['subject'])
            ->line($this->details['message'])
            ->action($this->details['actionText'], $this->details['actionURL'])
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'milestone_id' => $this->details['milestone_id'],
            'milestone_name' => $this->details['milestone_name'],
            'forecasting_date' => $this->details['forecasting_date'],
        ];
    }
}

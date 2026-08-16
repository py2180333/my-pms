<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignTeamNotification extends Notification
{
    use Queueable;
    protected $project, $action;

    // new pr 12-8-25
    /**
     * Create a new notification instance.
     */
    public function __construct($project, $action)
    {
        $this->project = $project;
        $this->action = $action;
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
        $message = [
            'assign' => 'You have been assigned to the '.$this->project['project_name'].' project.',
            'remove' => 'You have been removed from the '.$this->project['project_name'].' project.'
        ];

        return [
            'data' => $message[$this->action]
        ];
    }
}

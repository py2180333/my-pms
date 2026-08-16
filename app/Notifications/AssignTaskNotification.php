<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignTaskNotification extends Notification
{
    use Queueable;
    protected $project, $milestone, $task, $action;

    // new pr 18-8-25
    /**
     * Create a new notification instance.
     */
    public function __construct($project, $milestone, $task, $action)
    {
        $this->project = $project;
        $this->milestone = $milestone;
        $this->task = $task;
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
            'assign' => 'You have been assigned the task "'.$this->task['task_name'].'" in the project "'.$this->project['project_name'].'" (Milestone: "'.$this->milestone['milestone_name'].'"). Please review and start working on it.',
            'remove' => 'You have been removed from the task "'.$this->task['task_name'].'" in the project "'.$this->project['project_name'].'" (Milestone: "'.$this->milestone['milestone_name'].'").'
        ];
        
        return [
            'data' => $message[$this->action]
        ];
    }
}

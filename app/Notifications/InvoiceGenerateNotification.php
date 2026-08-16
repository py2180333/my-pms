<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceGenerateNotification extends Notification
{
    use Queueable;
    protected $invoiceNumber, $company;

    /**
     * Create a new notification instance.
     */
    public function __construct($invoiceNumber, $company)
    {
        $this->invoiceNumber = $invoiceNumber;
        $this->company = $company;
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
            'data' => 'You have received invoice #'.$this->invoiceNumber.' from '.$this->company['company_name'].'.'
        ];
    }
}

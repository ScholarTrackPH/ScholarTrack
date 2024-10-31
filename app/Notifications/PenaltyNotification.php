<?php

namespace App\Notifications;

use App\Models\penalty;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PenaltyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $penalty;

    /**
     * Create a new notification instance.
     */


    public function __construct(penalty $penalty)
    {
        //
        $this->penalty = $penalty;
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
            ->subject('Warning: ' . $this->penalty->caseCode)
            ->line('You have violated: ' . $this->penalty->condition)
            ->line('Remark: ' . $this->penalty->remark)
            ->line('If the remark reaches more than the 5th offense, you will need to submit an LTE to resolve this.')
            ->line('Date Issued: ' . $this->penalty->dateofpenalty->format('Y-m-d'))
            ->action('View Penalty', url('/login'))
            ->line('Thank you for being a part of our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'caseCode' => $this->penalty->caseCode,
            'condition' => $this->penalty->condition,
            'remark' => $this->penalty->remark,
            'dateofpenalty' => $this->penalty->dateofpenalty,
        ];
    }
}
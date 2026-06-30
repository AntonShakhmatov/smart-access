<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Visit;

class VisitCreatedNotification extends Notification
{
    use Queueable;

    protected $visit;

    /**
     * Create a new notification instance.
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $visitorName = $this->visit->visitor->full_name;
        $cardCode = $this->visit->accessCard->code; // Номер карты (RFID)

        return (new MailMessage)
            ->subject('You have a viitor')
            ->line("Guest visiting you: **{$visitorName}**.")
            ->line("Access card issued №: **{$cardCode}**.")
            ->line("Time of registration: " . $this->visit->entered_at->format('H:i:s'));
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

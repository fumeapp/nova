<?php

namespace App\Notifications;

use Fumeapp\Humble\Models\Attempt;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginAttempt extends Notification
{
    use Queueable;

    private Attempt $attempt;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Attempt $attempt)
    {
        $this->attempt = $attempt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Login Request')
            ->markdown('emails.user.attempt', $this->toArray($notifiable));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'token' => $this->attempt->token,
            'created_at' => $this->attempt->created_at,
        ];
    }
}

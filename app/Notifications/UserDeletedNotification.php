<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDeletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $deletedBy
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Cuenta Eliminada')
            ->greeting('Hola ' . $notifiable->name)
            ->line('Su cuenta ha sido eliminada del sistema.')
            ->line('Eliminado por: ' . $this->deletedBy)
            ->line('Si cree que esto es un error, por favor contacte al administrador.')
            ->salutation('Saludos cordiales');
    }
}

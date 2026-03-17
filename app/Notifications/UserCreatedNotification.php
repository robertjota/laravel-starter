<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $password
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Credenciales de Acceso')
            ->greeting('¡Bienvenido!')
            ->line('Se ha creado su cuenta en el sistema.')
            ->line('Sus credenciales de acceso son:')
            ->line('**Correo:** ' . $notifiable->email)
            ->line('**Contraseña:** ' . $this->password)
            ->action('Iniciar Sesión', url('/login'))
            ->line('Por favor, cambie su contraseña después del primer inicio de sesión.')
            ->salutation('Saludos cordiales');
    }
}

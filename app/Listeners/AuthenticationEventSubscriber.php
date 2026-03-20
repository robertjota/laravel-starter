<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\AccessLog;
use App\Models\Activity;

class AuthenticationEventSubscriber
{
    public function handleLogin(Login $event): void
    {
        // Verificar si ya se registró login recientemente (evitar duplicados)
        $existingActivity = Activity::where('user_id', $event->user->id)
            ->where('event', 'login')
            ->where('created_at', '>=', now()->subSeconds(10))
            ->first();
            
        if (!$existingActivity) {
            Activity::log('Inicio de sesion exitoso', $event->user, 'login', [
                'email' => $event->user->email,
            ]);
        }
        
        AccessLog::logLogin($event->user);
    }

    public function handleLogout(Logout $event): void
    {
        if ($event->user) {
            AccessLog::logLogout(session()->getId());
            
            Activity::log('Cierre de sesion', $event->user, 'logout', [
                'email' => $event->user->email,
            ]);
        }
    }

    public function subscribe($events): array
    {
        return [
            Login::class => 'handleLogin',
            Logout::class => 'handleLogout',
        ];
    }
}

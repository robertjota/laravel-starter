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
        AccessLog::logLogin($event->user);
        
        Activity::log('Inicio de sesion exitoso', $event->user, 'login', [
            'email' => $event->user->email,
        ]);
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

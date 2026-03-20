<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\AuthenticationEventSubscriber;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        $this->app['events']->listen(Login::class, [AuthenticationEventSubscriber::class, 'handleLogin']);
        $this->app['events']->listen(Logout::class, [AuthenticationEventSubscriber::class, 'handleLogout']);
    }
}

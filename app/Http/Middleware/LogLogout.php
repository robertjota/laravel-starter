<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AccessLog;
use App\Models\Activity;

class LogLogout
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if (!auth()->check() && $request->session()->has('access_logged')) {
            $userId = $request->session()->get('user_id_before_logout');
            $sessionId = $request->session()->getId();

            if ($userId) {
                AccessLog::where('user_id', $userId)
                    ->where('session_id', $sessionId)
                    ->where('event', 'login')
                    ->update([
                        'event' => 'logout',
                        'logout_at' => now(),
                    ]);

                Activity::log('Cierre de sesion', null, 'logout', [
                    'user_id' => $userId,
                ]);
            }

            $request->session()->forget(['access_logged', 'user_id_before_logout']);
        }
    }
}

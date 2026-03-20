<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AccessLog;
use App\Models\Activity;

class LogAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if (auth()->check()) {
            $user = auth()->user();
            $sessionId = $request->session()->getId();
            
            $alreadyLogged = AccessLog::where('user_id', $user->id)
                ->where('session_id', $sessionId)
                ->where('event', 'login')
                ->exists();
            
            if (!$alreadyLogged) {
                AccessLog::create([
                    'user_id' => $user->id,
                    'event' => 'login',
                    'session_id' => $sessionId,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'device' => $this->getDevice($request->userAgent()),
                    'platform' => $this->getPlatform($request->userAgent()),
                    'browser' => $this->getBrowser($request->userAgent()),
                    'login_at' => now(),
                ]);

                Activity::log('Inicio de sesion', $user, 'login', [
                    'email' => $user->email,
                ]);
            }
        }
    }

    private function getDevice(?string $userAgent): string
    {
        if (!$userAgent) return 'Desktop';
        if (preg_match('/mobile/i', $userAgent)) return 'Mobile';
        if (preg_match('/tablet/i', $userAgent)) return 'Tablet';
        return 'Desktop';
    }

    private function getPlatform(?string $userAgent): string
    {
        if (!$userAgent) return 'Unknown';
        if (preg_match('/Windows/i', $userAgent)) return 'Windows';
        if (preg_match('/Mac/i', $userAgent)) return 'macOS';
        if (preg_match('/Linux/i', $userAgent)) return 'Linux';
        if (preg_match('/Android/i', $userAgent)) return 'Android';
        if (preg_match('/iOS|iPhone|iPad/i', $userAgent)) return 'iOS';
        return 'Unknown';
    }

    private function getBrowser(?string $userAgent): string
    {
        if (!$userAgent) return 'Unknown';
        if (preg_match('/Chrome/i', $userAgent)) return 'Chrome';
        if (preg_match('/Firefox/i', $userAgent)) return 'Firefox';
        if (preg_match('/Safari/i', $userAgent)) return 'Safari';
        if (preg_match('/Edge/i', $userAgent)) return 'Edge';
        return 'Unknown';
    }
}

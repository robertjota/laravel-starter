<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessLog extends Model
{
    protected $fillable = [
        'user_id',
        'event',
        'session_id',
        'ip_address',
        'user_agent',
        'device',
        'platform',
        'browser',
        'login_at',
        'logout_at',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function logLogin(User $user): self
    {
        return static::create([
            'user_id' => $user->id,
            'event' => 'login',
            'session_id' => session()->getId(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'device' => self::getDeviceInfo()['device'],
            'platform' => self::getDeviceInfo()['platform'],
            'browser' => self::getDeviceInfo()['browser'],
            'login_at' => now(),
        ]);
    }

    public static function logLogout(string $sessionId): void
    {
        $login = static::where('session_id', $sessionId)
            ->where('event', 'login')
            ->first();

        if ($login) {
            $login->update([
                'event' => 'logout',
                'logout_at' => now(),
            ]);
        }
    }

    private static function getDeviceInfo(): array
    {
        $userAgent = request()->userAgent() ?? '';
        
        $device = 'Desktop';
        $platform = 'Unknown';
        $browser = 'Unknown';

        if (preg_match('/mobile/i', $userAgent)) {
            $device = 'Mobile';
        } elseif (preg_match('/tablet/i', $userAgent)) {
            $device = 'Tablet';
        }

        if (preg_match('/Windows/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/Mac/i', $userAgent)) {
            $platform = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $platform = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iOS|iPhone|iPad/i', $userAgent)) {
            $platform = 'iOS';
        }

        if (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Edge/i', $userAgent)) {
            $browser = 'Edge';
        }

        return [
            'device' => $device,
            'platform' => $platform,
            'browser' => $browser,
        ];
    }
}

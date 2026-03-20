<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\AccessLog;
use App\Models\Activity;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = auth()->user();
        
        if ($user) {
            $sessionId = $request->session()->getId();
            
            AccessLog::where('user_id', $user->id)
                ->where('session_id', $sessionId)
                ->where('event', 'login')
                ->update([
                    'event' => 'logout',
                    'logout_at' => now(),
                ]);

            Activity::log('Cierre de sesion', $user, 'logout', [
                'email' => $user->email,
            ]);
        }

        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
}

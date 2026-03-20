<?php

if (!function_exists('settings')) {
    function settings(?string $key = null, mixed $default = null)
    {
        if ($key === null) {
            return config('system');
        }
        
        $keys = explode('.', $key);
        $value = config('system');
        
        foreach ($keys as $segment) {
            if (isset($value[$segment])) {
                $value = $value[$segment];
            } else {
                return $default;
            }
        }
        
        return $value;
    }
}

if (!function_exists('get_roles')) {
    function get_roles(): array
    {
        return config('system.roles');
    }
}

if (!function_exists('has_any_role')) {
    function has_any_role($roles): bool
    {
        $user = auth()->user();
        
        if (!$user) {
            return false;
        }
        
        $roles = is_array($roles) ? $roles : [$roles];
        
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }
        
        return false;
    }
}

if (!function_exists('is_super_admin')) {
    function is_super_admin(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }
}

if (!function_exists('format_date')) {
    function format_date($date, string $format = 'd/m/Y'): string
    {
        if (!$date) {
            return '';
        }
        
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

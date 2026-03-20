<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AuditController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class)->names('admin.users');

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profiles.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profiles.update');

    Route::resource('roles', RoleController::class)->names('admin.roles');
    Route::resource('permissions', PermissionController::class)->names('admin.permissions');

    Route::get('/audits/activities', [AuditController::class, 'activities'])->name('admin.audits.activities');
    Route::get('/audits/access-logs', [AuditController::class, 'accessLogs'])->name('admin.audits.access-logs');
});

<?php

use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('events.index'));

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{slug}/register', [EventController::class, 'showRegisterForm'])->name('events.register.form');
Route::post('/events/{slug}/register', [EventController::class, 'register'])->name('events.register');

Route::get('/attend/{token}', [EventController::class, 'scan'])->name('attendance.scan');
Route::post('/attend/confirm', [EventController::class, 'confirmScan'])->name('attendance.confirm');
Route::get('/events/{slug}/check-in', [EventController::class, 'checkInForm'])->name('events.check-in');
Route::get('/certificates/attend/{token}', [CertificateController::class, 'downloadByToken'])->name('certificates.by-token');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/events/{slug}/my-attendance', [EventController::class, 'showMyAttendance'])->name('events.my-attendance');
    Route::get('/events/{slug}/qr-refresh', [EventController::class, 'attendanceQrRefresh'])->name('events.qr-refresh');
    Route::post('/events/{slug}/check-in', [EventController::class, 'checkInSubmit'])->name('events.check-in.submit');
    Route::get('/events/{slug}/certificate', [CertificateController::class, 'download'])->name('events.certificate');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');
    Route::post('/events/{event}/toggle', [AdminEventController::class, 'toggleActive'])->name('events.toggle');
    Route::get('/events/{event}/qr', [AdminEventController::class, 'qr'])->name('events.qr');
    Route::get('/events/{event}/qr-refresh', [AdminEventController::class, 'qrRefresh'])->name('events.qr-refresh');

    Route::get('/events/{event}/registrations', [AdminRegistrationController::class, 'index'])->name('events.registrations.index');
    Route::post('/events/{event}/registrations', [AdminRegistrationController::class, 'store'])->name('events.registrations.store');
    Route::post('/registrations/{registration}/verify', [AdminRegistrationController::class, 'verify'])->name('registrations.verify');
    Route::delete('/registrations/{registration}', [AdminRegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::get('/registrations/{registration}/certificate', [CertificateController::class, 'adminDownload'])->name('registrations.certificate');
});

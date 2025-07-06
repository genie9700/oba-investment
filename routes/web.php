<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/investment-plans', function () {
    return view('invest');
})->name('invest');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about');

Route::get('/security', function () {
    return view('security');
})->name('security');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', \App\Http\Middleware\CheckSuspended::class])->group(function () {
    Route::redirect('settings', 'user/settings');
    Route::redirect('dashboard', 'user/dashboard');

    Volt::route('user/dashboard', 'user.dashboard')->name(name: 'user.dashboard');
    Volt::route('user/deposit', 'user.deposit')->name(name: 'user.deposit');
    Volt::route('user/investment', 'user.investment')->name(name: 'user.invest');
    Volt::route('user/transactions', 'user.transactions')->name(name: 'user.transactions');
    Volt::route('user/withdrawals', 'user.withdrawals')->name(name: 'user.withdrawals');
    Volt::route('user/settings', 'user.settings')->name(name: 'user.settings');

    
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// --- ADMIN ROUTES --- 
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    
    Volt::route('dashboard', 'admin.dashboard')->name('dashboard');
    Volt::route('users', 'admin.users.index')->name('users.index');
    Volt::route('users/{user}', 'admin.users.show')->name('users.show');
    Volt::route('plans', 'admin.plans.index')->name('plans.index');
    Volt::route('deposits', 'admin.deposits.index')->name('deposits.index');
    Volt::route('withdrawals', 'admin.withdrawals.index')->name('withdrawals.index');
   Volt::route('payment-methods', 'admin.payment-methods.index')->name('payment-methods.index');
    
});

require __DIR__.'/auth.php';
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

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'user/settings');
    Route::redirect('dashboard', 'user/dashboard');

    Volt::route('user/dashboard', 'user.dashboard')->name(name: 'user.dashboard');
    Volt::route('user/deposit', 'user.deposit')->name(name: 'user.deposit');
    Volt::route('user/invest', 'user.invest')->name(name: 'user.invest');
    Volt::route('user/transactions', 'user.transactions')->name(name: 'user.transactions');
    Volt::route('user/withdrawals', 'user.withdrawals')->name(name: 'user.withdrawals');
    Volt::route('user/settings', 'user.settings')->name(name: 'user.settings');

    
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
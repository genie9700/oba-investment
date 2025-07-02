<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('user.dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Welcome Back</h1>
        <p class="text-gray-400">Sign in to access your dashboard.</p>
    </div>


    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />


    <form wire:submit="login" class="flex flex-col gap-6">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
            <input type="email" wire:model="email" autofocus autocomplete="email" placeholder="email@example.com" name="email" id="email" required
                class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <div class="mt-2 text-red-500">@error('email') {{ $message }} @enderror</div>
            </div>

        <div>
            <label for="password" viewable class="block text-sm font-medium text-gray-300">Password</label>
            <input type="password" wire:model="password" autocomplete="current-password" name="password" id="password" required
                class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
        </div>

        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center">
                <input id="remember-me" wire:model="remember" name="remember-me" type="checkbox" class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500">
                <label for="remember-me" class="ml-2 block text-gray-400">Remember me</label>
            </div>
            <a href="{{ route('password.request') }}" wire:navigate class="font-medium text-orange-400 hover:text-orange-300">Forgot password?</a>
        </div>

        <x-loading-button>
            Sign In
        </x-loading-button>

    </form>

    <p class="mt-8 text-center text-sm text-gray-400">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate class="font-medium text-orange-400 hover:text-orange-300">Sign up here</a>
    </p>
</div>

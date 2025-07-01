<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('user.dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Create Your Account</h1>
        <p class="text-gray-400">Start your investment journey in minutes.</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <div>
            <label for="full-name" class="block text-sm font-medium text-gray-300">Full Name</label>
            <input type="text" wire:model="name" autofocus autocomplete="name" name="full-name" id="full-name" required
                class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <div class="mt-2 text-red-500">@error('name') {{ $message }} @enderror</div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
            <input type="email"  wire:model="email" autocomplete="email" name="email" id="email" required
                class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <div class="mt-2 text-red-500">@error('email') {{ $message }} @enderror</div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input type="password" wire:model="password" name="password" id="password" required
                class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
            <div class="mt-2 text-red-500">@error('password') {{ $message }} @enderror</div>
        </div>

        <div>
            <label for="confirm-password" class="block text-sm font-medium text-gray-300">Confirm Password</label>
            <input type="password" wire:model="password_confirmation" autocomplete="new-password" name="confirm-password" id="confirm-password" required
                class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
        </div>

        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" name="terms" type="checkbox" required
                    class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500">
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="text-gray-400">I agree to the
                    <a href="#" class="font-medium text-orange-400 hover:text-orange-300">Terms of Service</a>
                    and
                    <a href="#" class="font-medium text-orange-400 hover:text-orange-300">Privacy Policy</a>.
                </label>
            </div>
        </div>

        <div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform">
                Create Account
            </button>
        </div>
    </form>

    <p class="mt-8 text-center text-sm text-gray-400">
        Already have an account?
        <a href="{{ route('login') }}" wire:navigate class="font-medium text-orange-400 hover:text-orange-300">Sign in
            here</a>
    </p>
</div>

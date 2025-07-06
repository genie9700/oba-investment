<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\{Layout, Title};

new 
#[Layout('components.layouts.admin')] 
#[Title('Manage Settings')]
class extends Component {
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            // 'new_password' => ['required', 'confirmed'],
            'new_password' => ['required', Password::min(8)->mixedCase(), 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset('current_password', 'new_password', 'new_password_confirmation');
        session()->flash('message', 'Admin password updated successfully.');
    }


}; ?>

<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-white">Settings</h1>
        <div class="w-6"></div>
    </header>
    <div class="p-6 md:p-8">
    
        <h1 class="text-3xl font-bold text-white mb-8">Admin Settings</h1>
    
        @if (session('message'))
            <div class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
                {{ session('message') }}
            </div>
        @endif
    
        <div class="bg-white/5 border border-white/10 rounded-2xl">
            <form wire:submit.prevent="updatePassword">
                <div class="p-6 sm:p-8">
                    <h2 class="text-xl font-bold text-white">Change Your Password</h2>
                    <p class="text-sm text-gray-400 mt-1">Ensure your admin account is using a long, random password.</p>
                    <div class="mt-6 grid grid-cols-1 gap-y-6">
                        <div>
                            <label for="current-password" class="block text-sm font-medium text-gray-300">Current Password</label>
                            <input type="password" id="current-password" wire:model="current_password" class="mt-2 block w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('current_password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="new-password" class="block text-sm font-medium text-gray-300">New Password</label>
                            <input type="password" id="new-password" wire:model="new_password" class="mt-2 block w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                             @error('new_password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-300">Confirm New Password</label>
                            <input type="password" id="new_password_confirmation" wire:model="new_password_confirmation" class="mt-2 block w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                    </div>
                </div>
                <div class="p-6 border-t border-white/10 flex justify-end">
                    <x-loading-button type="submit" target="updatePassword">
                        Update Password
                    </x-loading-button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="flex items-center space-x-3">
    <a href="{{ route('user.dashboard') }}" wire:navigate>
        <img src="{{ asset('images/cryptane-logo.png') }}" alt="logo" class="w-40">
    </a>
</div>

<nav class="flex-1 space-y-1 md:pt-4">
    <a href="{{ route('user.dashboard') }}" wire:navigate class="flex items-center text-gray-400 px-4 py-2.5" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
        </svg>
        Dashboard
    </a>
    <a href="{{ route('user.deposit') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
        </svg>
        Deposit
    </a>
    <a href="{{ route('user.invest') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
        </svg>
        Invest
    </a>
    <a href="{{ route('user.transactions') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
        </svg>

        Transactions
    </a>
    <a href="{{ route('user.withdrawals') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

        Withdrawals
    </a>
    <a href="{{ route('user.settings') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
        </svg>
        Settings
    </a>
</nav>

<div class="mt-auto relative">
    <div x-show="profileDropdownOpen" @click.away="profileDropdownOpen = false"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute bottom-full w-full mb-2 bg-gray-800 border border-white/10 rounded-lg shadow-lg" x-cloak>
        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">Settings</a>
        <a href="#"
            class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 hover:text-red-300">Logout</a>
    </div>

    <div x-show="profileDropdownOpen" x-transition
        class="absolute bottom-full w-full mb-2 bg-gray-800 border border-white/10 rounded-lg shadow-lg" x-cloak>
        <a href="{{ route('user.settings') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">Settings</a>
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" href="#"
                class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 hover:text-red-300">Logout</button>
        </form>
    </div>

    <button @click="profileDropdownOpen = !profileDropdownOpen"
        class="w-full flex items-center p-2 space-x-3 bg-white/5 rounded-lg cursor-pointer hover:bg-white/10 transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <div class="w-10 h-10 flex-shrink-0">
            <template x-if="user.avatarUrl">
                <img class="h-10 w-10 rounded-full object-cover" :src="user.avatarUrl" alt="User Avatar">
            </template>
            <template x-if="!user.avatarUrl">
                <div
                    class="h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-yellow-600 flex items-center justify-center">
                    <span class="text-white font-bold" x-text="initials"></span>
                </div>
            </template>
        </div>
        <div class="flex-1 min-w-0 text-left">
            <p class="text-sm font-semibold text-white truncate" x-text="user.name"></p>
            <p class="text-xs text-gray-400 truncate" x-text="user.email"></p>
        </div>
        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
</div>

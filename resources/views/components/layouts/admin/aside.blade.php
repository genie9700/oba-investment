<div class="flex items-center space-x-3">
    <a href="{{ route('admin.dashboard') }}" wire:navigate>
        <img src="{{ asset('images/cryptane-logo.png') }}" alt="logo" class="w-40">
    </a>
</div>

<nav class="flex-1 space-y-1 md:pt-4">
    <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center text-gray-400 px-4 py-2.5" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
        </svg>
        Dashboard
    </a>
    

    <a href="{{ route('admin.users.index') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
        </svg>
        Users
    </a>

    <a href="{{ route('admin.plans.index') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
        </svg>

        Plans
    </a>

    <a href="{{ route('admin.deposits.index') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
        </svg>
        Deposit
    </a>

    <a href="{{ route('admin.withdrawals.index') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

        Withdrawals
    </a>
    <a href="{{ route('admin.payment-methods.index') }}" wire:navigate
        class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors" wire:current='bg-white/10 rounded-lg text-white font-semibold'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
        </svg>
        Payment Methods
    </a>
    
    <a href="{{ route('admin.settings.index') }}" wire:navigate
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
        <a href="{{ route('admin.settings.index') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white">Settings</a>
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

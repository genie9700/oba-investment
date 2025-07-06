<?php

use App\Models\User;
use App\Models\WhitelistedAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

new #[Layout('components.layouts.user')] class extends Component {
    public string $activeTab = 'profile';
    public string $name = '';
    public string $email = '';

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $twoFactorEnabled = false;
    public $whitelistedAddresses;

    public string $newAddressLabel = '';
    public string $newAddressMethod = 'btc';

    // For BTC
    public string $newBtcAddress = '';

    // For Bank
    public string $newBankName = '';
    public string $newAccountNumber = '';
    public string $newAccountName = '';
    public string $newSwiftCode = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->loadWhitelistedAddresses();
    }

    public function updateProfile(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        session()->flash('profile_message', 'Name updated successfully.');

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        session()->flash('password_message', 'password updated successfully.');

        $this->dispatch('password-updated');
    }

    // Helper function to load/refresh the addresses
    public function loadWhitelistedAddresses()
    {
        $this->whitelistedAddresses = Auth::user()->whitelistedAddresses()->get();
    }

    public function addNewAddress()
    {
        // Dynamically set validation rules based on the selected method
        $rules = [
            'newAddressLabel' => 'required|string|max:255',
            'newAddressMethod' => 'required|in:btc,bank',
        ];

        if ($this->newAddressMethod === 'btc') {
            $rules['newBtcAddress'] = ['required', 'string', 'max:255']; // Add your BTC address validation rule here
        } else {
            $rules['newBankName'] = ['required', 'string', 'max:255'];
            $rules['newAccountNumber'] = ['required', 'string', 'max:255'];
            $rules['newAccountName'] = ['required', 'string', 'max:255'];
            $rules['newSwiftCode'] = ['required', 'string', 'max:255'];
        }

        $this->validate($rules);

        WhitelistedAddress::create([
            'user_id' => Auth::id(),
            'label' => $this->newAddressLabel,
            'method' => $this->newAddressMethod,
            'address' => $this->newAddressMethod === 'btc' ? $this->newBtcAddress : null,
            'bank_details' =>
                $this->newAddressMethod === 'bank'
                    ? [
                        'bank_name' => $this->newBankName,
                        'account_number' => $this->newAccountNumber,
                        'account_name' => $this->newAccountName,
                        'swift_code' => $this->newSwiftCode,
                    ]
                    : null,
        ]);

        $this->loadWhitelistedAddresses(); // Refresh the address list
        $this->dispatch('close-add-address-modal'); // Dispatch event to close the modal
        $this->reset('newAddressLabel', 'newAddressMethod', 'newBtcAddress', 'newBankName', 'newAccountNumber', 'newAccountName', 'newSwiftCode');
        session()->flash('withdrawal_message', 'New address added successfully.');
    }

    /**
     * Deletes a whitelisted address after confirmation.
     */
    public function removeAddress($addressId)
    {
        $address = WhitelistedAddress::where('user_id', Auth::id())->where('id', $addressId)->first();

        if ($address) {
            $address->delete();
            $this->loadWhitelistedAddresses(); // Refresh the list
            session()->flash('withdrawal_message', 'Address removed successfully.');
        }
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

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-white mb-8 hidden lg:block">Settings</h1>

            <div>
                <div class="border-b border-white/10 mb-8">
                    <nav class="-mb-px flex space-x-6">
                        <button wire:click="$set('activeTab', 'profile')"
                            class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'profile' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">
                            Profile
                        </button>
                        <button wire:click="$set('activeTab', 'security')"
                            class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'security' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">
                            Security
                        </button>
                        <button wire:click="$set('activeTab', 'withdrawal')"
                            class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'withdrawal' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">
                            Withdrawal Settings
                        </button>
                    </nav>
                </div>

                <div>
                    @if ($activeTab === 'profile')
                        <div wire:key="profile" class="bg-white/5 border border-white/10 rounded-2xl">
                            <form wire:submit.prevent="updateProfile">
                                <div class="p-6 sm:p-8">
                                    @if (session('profile_message'))
                                        <div
                                            class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
                                            {{ session('profile_message') }}
                                        </div>
                                    @endif
                                    <h2 class="text-xl font-bold text-white">Personal Information</h2>
                                    <p class="text-sm text-gray-400 mt-1">Update your profile details.</p>
                                    <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
                                        <div class="sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium text-gray-300">Full
                                                Name</label>
                                            <input type="text" id="name" wire:model="name"
                                                class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                            @error('name')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="email" class="block text-sm font-medium text-gray-300">Email
                                                Address</label>
                                            <input type="email" id="email" wire:model="email" readonly
                                                class="mt-2 block w-full px-4 py-3 bg-black/20 border border-white/10 rounded-lg text-gray-400 cursor-not-allowed">
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 border-t border-white/10 flex justify-end">
                                    <x-loading-button type="submit" target="updateProfile">
                                        Save Changes
                                    </x-loading-button>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if ($activeTab === 'security')
                        <div wire:key="security">
                            <div class="bg-white/5 border border-white/10 rounded-2xl mb-8">
                                <form wire:submit="updatePassword">
                                    <div class="p-6 sm:p-8">
                                        @if (session('password_message'))
                                            <div
                                                class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
                                                {{ session('password_message') }}
                                            </div>
                                        @endif
                                        <h2 class="text-xl font-bold text-white">Change Password</h2>
                                        <p class="text-sm text-gray-400 mt-1">Ensure your account is using a long,
                                            random password to stay secure.</p>
                                        <div class="mt-6 grid grid-cols-1 gap-y-6">
                                            <div>
                                                <label for="current-password"
                                                    class="block text-sm font-medium text-gray-300">Current
                                                    Password</label>
                                                <input type="password" id="current-password"
                                                    wire:model="current_password"
                                                    class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                                @error('current_password')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="password"
                                                    class="block text-sm font-medium text-gray-300">New Password</label>
                                                <input type="password" id="password" wire:model="password"
                                                    class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                                @error('password')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="password_confirmation"
                                                    class="block text-sm font-medium text-gray-300">Confirm New
                                                    Password</label>
                                                <input type="password" id="password_confirmation"
                                                    wire:model="password_confirmation"
                                                    class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
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

                            {{-- <div class="bg-white/5 border border-white/10 rounded-2xl">
                                <div class="p-6 sm:p-8">
                                    <h2 class="text-xl font-bold text-white">Two-Factor Authentication (2FA)</h2>
                                    <p class="text-sm text-gray-400 mt-1">Add an extra layer of security to your account
                                        during login.</p>
                                    <div class="mt-6">
                                        @if ($twoFactorEnabled)
                                            <div class="p-4 bg-green-500/10 rounded-lg">
                                                <p class="text-green-300 font-semibold">Two-factor authentication is
                                                    currently enabled.</p>
                                                <button
                                                    class="mt-4 px-6 py-2 rounded-full font-semibold bg-red-500/10 text-red-300 border border-red-500/30 hover:bg-red-500/20">
                                                    Disable
                                                </button>
                                            </div>
                                        @else
                                            <div class="p-4 bg-gray-700/50 rounded-lg">
                                                <p class="text-gray-300 font-semibold">Two-factor authentication is not
                                                    enabled.</p>
                                                <button
                                                    class="mt-4 px-6 py-2 rounded-full font-semibold bg-orange-500/20 text-orange-300 border border-orange-500/40 hover:bg-orange-500/30">
                                                    Enable
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    @endif

                    @if ($activeTab === 'withdrawal')
                        <div wire:key="withdrawal" class="bg-white/5 border border-white/10 rounded-2xl">
                            <div class="p-6 sm:p-8">
                                @if (session('withdrawal_message'))
                                    <div
                                        class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
                                        {{ session('withdrawal_message') }}
                                    </div>
                                @endif
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                    <div>
                                        <h2 class="text-xl font-bold text-white">Whitelisted Withdrawal Addresses</h2>
                                        <p class="text-sm text-gray-400 mt-1">For your security, you can only withdraw
                                            to these pre-approved addresses.</p>
                                    </div>
                                    <button @click="$dispatch('open-add-address-modal')"
                                        class="mt-4 sm:mt-0 bg-white/10 text-white px-4 py-2 rounded-lg font-semibold hover:bg-white/20 transition-colors text-sm flex-shrink-0">
                                        Add New Address
                                    </button>
                                </div>
                                <ul class="mt-6 space-y-3">
                                    @forelse($whitelistedAddresses as $address)
                                        <li
                                            class="p-4 bg-gray-900/50 border border-white/10 rounded-lg flex justify-between items-center">
                                            <div>
                                                <p class="font-bold text-white">{{ $address->label }}</p>
                                                @if ($address->method === 'btc')
                                                    <p class="font-mono text-sm text-gray-400">
                                                        {{ Str::limit($address->address, 30) }}</p>
                                                @else
                                                    <p class="text-sm text-gray-400">
                                                        {{ $address->bank_details['bank_name'] }} -
                                                        ****{{ substr($address->bank_details['account_number'], -4) }}
                                                    </p>
                                                @endif
                                            </div>
                                            <button wire:click="removeAddress({{ $address->id }})"
                                                wire:confirm="Are you sure you want to remove this address?"
                                                class="text-red-400 hover:text-red-300 text-sm font-semibold">
                                                Remove
                                            </button>
                                        </li>
                                    @empty
                                        <li class="text-center text-gray-400 py-6">You have no whitelisted addresses.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Add New Address Modal -->
            <div x-data="{ isOpen: false }" @open-add-address-modal.window="isOpen = true"
                @close-add-address-modal.window="isOpen = false" x-show="isOpen" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center">
                <div x-show="isOpen" @click="isOpen = false" x-transition.opacity
                    class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

                <div x-show="isOpen" @click.stop x-transition
                    class="relative bg-gray-900 border border-white/10 rounded-2xl w-full max-w-lg p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Add New Withdrawal Address</h2>
                    <form wire:submit.prevent="addNewAddress">
                        <div class="space-y-6">
                            <div>
                                <label for="newAddressLabel"
                                    class="block text-sm font-medium text-gray-300">Label</label>
                                <input type="text" id="newAddressLabel" wire:model="newAddressLabel"
                                    placeholder="e.g. My Ledger Wallet"
                                    class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                @error('newAddressLabel')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="newAddressMethod"
                                    class="block text-sm font-medium text-gray-300">Method</label>
                                <select id="newAddressMethod" wire:model="newAddressMethod"
                                    class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option class="bg-gray-800" value="btc">Bitcoin (BTC)</option>
                                    <option class="bg-gray-800" value="bank">Bank Account</option>
                                </select>
                            </div>
                            <div x-show="$wire.newAddressMethod === 'btc'" x-transition>
                                <label for="newBtcAddress" class="block text-sm ...">Wallet Address</label>
                                <textarea id="newBtcAddress" rows="3" wire:model="newBtcAddress" placeholder="Enter the full wallet address"
                                    class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                                @error('newBtcAddress')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div x-show="$wire.newAddressMethod === 'bank'" x-transition>
                                <h3 class="text-md font-semibold text-gray-300 border-t border-white/10 pt-4 mb-4">
                                    Bank Account Details
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                    <div>
                                        <label for="newBankName" class="block text-sm ...">Bank Name</label>
                                        <input type="text" id="newBankName" wire:model="newBankName"
                                            class="mt-1 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        @error('newBankName')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="newAccountNumber" class="block text-sm ...">Account Number</label>
                                        <input type="text" id="newAccountNumber" wire:model="newAccountNumber"
                                            class="mt-1 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        @error('newAccountNumber')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="newAccountName" class="block text-sm ...">Account Holder
                                            Name</label>
                                        <input type="text" id="newAccountName" wire:model="newAccountName"
                                            class="mt-1 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        @error('newAccountName')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="newSwiftCode" class="block text-sm ...">SWIFT / BIC Code</label>
                                        <input type="text" id="newSwiftCode" wire:model="newSwiftCode"
                                            class="mt-1 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        @error('newSwiftCode')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 flex justify-end space-x-4">
                                <button type="button" @click="isOpen = false"
                                    class="px-6 py-2 rounded-full font-semibold text-gray-300 bg-white/10 hover:bg-white/20 transition-colors">Cancel</button>
                                <x-loading-button type="submit" target="addNewAddress">Save
                                    Address</x-loading-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
</div>

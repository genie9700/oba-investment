<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\PaymentMethod;
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Layout, Title};


new 
#[Layout('components.layouts.admin')] 
#[Title('Manage Payment Options')]
class extends Component {
    use WithPagination;

    public array $editing = [];
    public bool $showModal = false;

    public function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.ticker' => 'required|string|max:255',
            'editing.wallet_address' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('payment_methods', 'wallet_address')->ignore($this->editing['id'] ?? null)
            ],
            'editing.network_warning' => 'required|string',
            'editing.is_active' => 'required|boolean',
        ];
    }

    public function create()
    {
        $this->resetErrorBag();
        // For a new method, we initialize the array with default values.
        $this->editing = ['is_active' => true];
        $this->showModal = true;
    }

    public function edit(PaymentMethod $method)
    {
        $this->resetErrorBag();
        // For an existing method, we convert the model to an array.
        $this->editing = $method->toArray();
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // Use updateOrCreate to handle both creating and editing from the array.
        PaymentMethod::updateOrCreate(
            ['id' => $this->editing['id'] ?? null],
            $this->editing
        );

        $this->showModal = false;
        session()->flash('message', 'Payment Method saved successfully.');
    }
    
    
    public function delete(PaymentMethod $method)
    {
        $method->delete();
        session()->flash('message', 'Payment Method deleted successfully.');
    }

    public function with(): array
    {
        return [
            'methods' => PaymentMethod::latest()->paginate(10),
        ];
    }

}; ?>


<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-white">Payment Methods</h1>
        <div class="w-6"></div>
    </header>
    <div class="p-6 md:p-8">
    
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Manage Payment</h1>
            <button wire:click="create" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600">New</button>
        </div>
    
        @if (session('message'))
            <div class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
                {{ session('message') }}
            </div>
        @endif
    
        <div class="bg-white/5 border border-white/10 rounded-2xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="text-left text-xs text-gray-400 uppercase">
                        <tr>
                            <th class="p-4 font-medium">Name</th>
                            <th class="p-4 font-medium">Ticker</th>
                            <th class="p-4 font-medium">Address</th>
                            <th class="p-4 font-medium">Status</th>
                            <th class="p-4 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($methods as $method)
                            <tr class="border-t border-white/5">
                                <td class="p-4 font-semibold text-white">{{ $method->name }}</td>
                                <td class="p-4 text-gray-300">{{ $method->ticker }}</td>
                                <td class="p-4 text-gray-300 font-mono text-xs">{{ Str::limit($method->wallet_address, 30) }}</td>
                                <td class="p-4">
                                    <span class="{{ $method->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }} px-2 py-1 text-xs font-semibold rounded-full">
                                        {{ $method->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <button wire:click="edit({{ $method->id }})" class="font-semibold text-orange-400 hover:text-orange-300">Edit</button>
                                    <button wire:click="delete({{ $method->id }})" wire:confirm="Are you sure you want to delete this method?" class="ml-4 font-semibold text-red-400 hover:text-red-300">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-6 text-center text-gray-400">No payment methods found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-white/10">
                {{ $methods->links() }}
            </div>
        </div>
    
        <div x-data="{ isOpen: @entangle('showModal') }" x-show="isOpen" @keydown.escape.window="isOpen = false" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div x-show="isOpen" @click="isOpen = false" x-transition.opacity class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
            <div x-show="isOpen" @click.stop x-transition class="relative bg-gray-900 border border-white/10 rounded-2xl w-full max-w-lg">
                <form wire:submit.prevent="save">
                    <div class="p-6 border-b border-white/10">
                        <h2 class="text-2xl font-bold text-white" x-text="$wire.editing.id ? 'Edit Method' : 'Add New Payment Method'"></h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="method-name" class="block text-sm font-medium text-gray-300">Name</label>
                            <input type="text" id="method-name" wire:model="editing.name" class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.name')<span class="text-red-500 text-xs">{{$message}}</span>@enderror
                        </div>
                         <div>
                            <label for="method-ticker" class="block text-sm font-medium text-gray-300">Ticker</label>
                            <input type="text" id="method-ticker" wire:model="editing.ticker" class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.ticker')<span class="text-red-500 text-xs">{{$message}}</span>@enderror
                        </div>
                         <div>
                            <label for="method-address" class="block text-sm font-medium text-gray-300">Wallet Address</label>
                            <input type="text" id="method-address" wire:model="editing.wallet_address" class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.wallet_address')<span class="text-red-500 text-xs">{{$message}}</span>@enderror
                        </div>
                        <div>
                            <label for="method-warning" class="block text-sm font-medium text-gray-300">Network Warning</label>
                            <textarea id="method-warning" wire:model="editing.network_warning" rows="3" class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                            @error('editing.network_warning')<span class="text-red-500 text-xs">{{$message}}</span>@enderror
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="method-is_active" wire:model="editing.is_active" class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500">
                            <label for="method-is_active" class="ml-2 text-sm text-gray-300">Active?</label>
                        </div>
                    </div>
                    <div class="p-6 border-t border-white/10 flex justify-end space-x-4">
                        <button type="button" @click="isOpen = false" class="px-6 py-2 rounded-full font-semibold text-gray-300 bg-white/10 hover:bg-white/20 transition-colors">Cancel</button>
                        <x-loading-button type="submit" target="save">Save Method</x-loading-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

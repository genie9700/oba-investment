<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Plan;
use Livewire\Attributes\{Layout, Title};

new 
#[Layout('components.layouts.admin')] 
#[Title('Manage Plans')]
class extends Component {
    use WithPagination;

    // We now use a simple array to hold the form data. This is more reliable.
    public array $editing = [];
    public bool $showModal = false;

    public function rules()
    {
        // The validation rules remain the same.
        return [
            'editing.name' => 'required|string|max:255',
            'editing.price' => 'required|numeric|min:0',
            'editing.hash_power' => 'required|string|max:255',
            'editing.daily_earning_rate' => 'required|numeric|min:0',
            'editing.duration_in_months' => 'required|integer|min:1',
            'editing.withdrawal_limit' => 'required|string|max:255',
            'editing.tier' => 'required|string|max:255',
            'editing.is_featured' => 'required|boolean',
            'editing.is_active' => 'required|boolean',
        ];
    }

    public function create()
    {
        // For a new plan, we initialize the array with default values.
        $this->reset('editing'); // Clear any previous editing data
        $this->editing['is_active'] = true;
        $this->editing['is_featured'] = false;
        $this->showModal = true;
    }

    public function edit(Plan $plan)
    {
        // For an existing plan, we convert the model to an array.
        $this->editing = $plan->toArray();
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // Use updateOrCreate to handle both creating and editing in one step.
        Plan::updateOrCreate(
            ['id' => $this->editing['id'] ?? null],
            $this->editing
        );

        $this->showModal = false;
        session()->flash('message', 'Plan saved successfully.');
    }
    
    public function delete(Plan $plan)
    {
        $plan->delete();
        session()->flash('message', 'Plan deleted successfully.');
    }

    public function with(): array
    {
        return [
            'plans' => Plan::latest()->paginate(10),
            'layout' => 'layouts.admin',
            'title' => 'Manage Plans'
        ];
    }
}; ?>

<div class="p-6 md:p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">Manage Investment Plans</h1>
        <button wire:click="create"
            class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600">Add New Plan</button>
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
                        <th class="p-4 font-medium">Price</th>
                        <th class="p-4 font-medium">Tier</th>
                        <th class="p-4 font-medium">Status</th>
                        <th class="p-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($plans as $plan)
                        <tr class="border-t border-white/5">
                            <td class="p-4 font-semibold text-white">{{ $plan->name }}</td>
                            <td class="p-4 text-gray-300">${{ number_format($plan->price) }}</td>
                            <td class="p-4 text-gray-300">{{ $plan->tier }}</td>
                            <td class="p-4">
                                <span
                                    class="{{ $plan->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }} px-2 py-1 text-xs font-semibold rounded-full">
                                    {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <button wire:click="edit({{ $plan->id }})"
                                    class="font-semibold text-orange-400 hover:text-orange-300">Edit</button>
                                <button wire:click="delete({{ $plan->id }})"
                                    wire:confirm="Are you sure you want to delete this plan?"
                                    class="ml-4 font-semibold text-red-400 hover:text-red-300">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-400">No plans found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-white/10">
            {{ $plans->links() }}
        </div>
    </div>

    <div x-data="{ isOpen: @entangle('showModal') }" x-show="isOpen" @keydown.escape.window="isOpen = false" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div x-show="isOpen" @click="isOpen = false" x-transition.opacity
            class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

        <div x-show="isOpen" @click.stop x-transition
            class="relative bg-gray-900 border border-white/10 rounded-2xl w-full max-w-2xl">
            <form wire:submit="save">
                <div class="p-6 border-b border-white/10">
                    <h2 class="text-2xl font-bold text-white"
                        x-text="$wire.editing.id ? 'Edit Plan' : 'Create New Plan'"></h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label for="plan-name" class="block text-sm font-medium text-gray-300">Name</label>
                            <input type="text" id="plan-name" wire:model="editing.name"
                                class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="plan-price" class="block text-sm font-medium text-gray-300">Price (USD)</label>
                            <input type="number" step="0.01" id="plan-price" wire:model="editing.price"
                                class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.price')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="plan-hash_power" class="block text-sm font-medium text-gray-300">Hash
                                Power</label>
                            <input type="text" id="plan-hash_power" wire:model="editing.hash_power"
                                class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.hash_power')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="plan-daily_earning_rate" class="block text-sm font-medium text-gray-300">Daily
                                Earning Rate</label>
                            <input type="number" step="0.01" id="plan-daily_earning_rate"
                                wire:model="editing.daily_earning_rate"
                                class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.daily_earning_rate')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="plan-duration_in_months"
                                class="block text-sm font-medium text-gray-300">Duration (Months)</label>
                            <input type="number" id="plan-duration_in_months" wire:model="editing.duration_in_months"
                                class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.duration_in_months')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="plan-withdrawal_limit"
                                class="block text-sm font-medium text-gray-300">Withdrawal Limit</label>
                            <input type="text" id="plan-withdrawal_limit" wire:model="editing.withdrawal_limit"
                                class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.withdrawal_limit')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="plan-tier" class="block text-sm font-medium text-gray-300">Tier</label>
                            <input type="text" id="plan-tier" wire:model="editing.tier"
                                placeholder="e.g., pro, elite"
                                class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('editing.tier')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="plan-is_featured" wire:model="editing.is_featured"
                                class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500">
                            <label for="plan-is_featured" class="ml-2 text-sm text-gray-300">Featured?</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="plan-is_active" wire:model="editing.is_active"
                                class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500">
                            <label for="plan-is_active" class="ml-2 text-sm text-gray-300">Active?</label>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-white/10 flex justify-end space-x-4">
                    <button type="button" @click="isOpen = false"
                        class="px-6 py-2 rounded-full font-semibold text-gray-300 bg-white/10 hover:bg-white/20 transition-colors">Cancel</button>
                    <x-loading-button type="submit" target="save">Save Plan</x-loading-button>
                </div>
            </form>
        </div>
    </div>
</div>

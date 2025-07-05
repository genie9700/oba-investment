<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User;

new #[Layout('components.layouts.admin')] class extends Component {
    use WithPagination;

    public string $search = '';

    public function updated($property)
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

    public function with(): array
    {
        $users = User::where('is_admin', 0)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return [
            'users' => $users,
        ];
    }
}; ?>

<div>
    <div class="p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between md:items-center mb-8">
            <h1 class="text-3xl font-bold text-white">User Management</h1>
            <div class="mt-4 md:mt-0">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or email..."
                    class="w-full md:w-64 px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="text-left text-xs text-gray-400 uppercase">
                        <tr>
                            <th class="p-4 font-medium">Name</th>
                            <th class="p-4 font-medium">Email</th>
                            <th class="p-4 font-medium">Balance</th>
                            <th class="p-4 font-medium">Registered</th>
                            <th class="p-4 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($users as $user)
                            <tr class="border-t border-white/5">
                                <td class="p-4">
                                    <p class="font-semibold text-white">{{ $user->name }}</p>
                                </td>
                                <td class="p-4 text-gray-400">{{ $user->email }}</td>
                                <td class="p-4 font-mono text-white">${{ number_format($user->balance, 2) }}</td>
                                <td class="p-4 text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="p-4">
                                    <a href="{{ route('admin.users.show', $user->id) }}" wire:navigate
                                        class="px-3 py-1 text-xs font-semibold bg-white/10 text-white rounded-full hover:bg-white/20">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-white/10">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

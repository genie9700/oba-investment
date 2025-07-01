<div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-xl">
    <div class="p-6 border-b border-white/10">
        <h2 class="text-xl font-bold text-white">Active Investment Plans</h2>
        <p class="text-sm text-gray-400">An overview of your most recent packages.</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px]">
            <thead class="text-left text-sm text-gray-400">
                <tr>
                    <th class="p-4 font-medium">Plan</th>
                    <th class="p-4 font-medium">Amount</th>
                    <th class="p-4 font-medium">Daily Earnings</th>
                    <th class="p-4 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($investments as $investment)
                    <tr class="border-t border-white/5">
                        <td class="p-4 font-semibold text-white">{{ $investment->plan_name }}</td>
                        <td class="p-4 text-gray-300">${{ number_format($investment->initial_amount, 2) }}</td>
                        <td class="p-4 text-gray-300">${{ number_format($investment->daily_earning_rate, 2) }}</td>
                        <td class="p-4">
                            @if($investment->status === 'active')
                                <span class="px-2 py-1 text-xs font-semibold bg-green-500/10 text-green-400 rounded-full">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold bg-gray-500/10 text-gray-400 rounded-full">Completed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-400">You have no active investments.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
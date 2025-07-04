<div>
    {{-- This component displays the high-level KPI cards. The data is calculated in the component class. --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <p class="text-sm font-medium text-gray-400">Available Balance</p>
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white mt-2">
                ${{ number_format($availableBalance, 2) }}
            </p>
        </div>

        @if ($pendingDeposits > 0)
            <div class="bg-white/5 border border-yellow-500/30 rounded-xl p-6">
                <div class="flex justify-between items-start">
                    <p class="text-sm font-medium text-yellow-400">Pending Deposits</p>
                    <svg class="w-6 h-6 text-yellow-400 animate-spin" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-yellow-400 mt-2">
                    ${{ number_format($pendingDeposits, 2) }}
                </p>
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <p class="text-sm font-medium text-gray-400">Active Investment</p>
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9V3m0 18a9 9 0 009-9m-9 9a9 9 0 00-9-9"></path></svg>
            </div>
            <div class="mt-2">
                <p class="text-3xl font-bold text-white">
                    ${{ number_format($activeInvestment, 2) }}
                </p>
                
                {{-- 
                    FIX: Both sub-metrics are now on a single, clean line 
                    to maintain a consistent card height with the others.
                --}}
                <p class="text-xs text-gray-400 mt-2" title="Projected return and ROI for all active plans.">
                    Est. Return: 
                    <span class="font-semibold text-white">${{ number_format($estimatedTotalReturn, 2) }}</span>
                    (<span class="font-bold text-green-400">{{ number_format($aggregateRoi, 1) }}%</span>)
                </p>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <p class="text-sm font-medium text-gray-400">Total Earnings</p>
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-green-400 mt-2">
                ${{ number_format($totalEarnings, 2) }}
            </p>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <p class="text-sm font-medium text-gray-400">Today's Earnings</p>
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white mt-2">
                ${{ number_format($dailyEarnings, 2) }}
            </p>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <p class="text-sm font-medium text-gray-400">Pending Withdrawals</p>
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01">
                    </path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-yellow-400 mt-2">
                ${{ number_format($pendingWithdrawals, 2) }}
            </p>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <p class="text-sm font-medium text-gray-400">Total Withdrawn</p>
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5M7 7l-3 3"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white mt-2">
                ${{ number_format($totalWithdrawn, 2) }}
            </p>
        </div>
    </div>
</div>

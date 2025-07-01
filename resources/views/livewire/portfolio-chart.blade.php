<div class="mt-8 bg-white/5 border border-white/10 rounded-xl p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
        <div>
            <h2 class="text-xl font-bold text-white">Portfolio Growth</h2>
            <p class="text-sm text-gray-400">
                Value change from ${{ number_format($startValue, 2) }} to ${{ number_format($endValue, 2) }}
            </p>
        </div>
        <div class="flex items-center space-x-2 mt-4 sm:mt-0 bg-white/5 p-1 rounded-lg">
            <button wire:click="setTimespan('1M')" class="px-3 py-1 text-sm font-semibold rounded-md transition-colors {{ $timespan === '1M' ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white' }}">1M</button>
            <button wire:click="setTimespan('6M')" class="px-3 py-1 text-sm font-semibold rounded-md transition-colors {{ $timespan === '6M' ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white' }}">6M</button>
            <button wire:click="setTimespan('1Y')" class="px-3 py-1 text-sm font-semibold rounded-md transition-colors {{ $timespan === '1Y' ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white' }}">1Y</button>
            <button wire:click="setTimespan('ALL')" class="px-3 py-1 text-sm font-semibold rounded-md transition-colors {{ $timespan === 'ALL' ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white' }}">ALL</button>
        </div>
    </div>

    <div class="h-80 w-full">
        <div wire:loading class="w-full h-full flex items-center justify-center">
            <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        
        <svg class="w-full h-full" viewBox="0 0 400 150" preserveAspectRatio="none" wire:loading.remove>
            <defs>
                <linearGradient id="chartAreaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#f79318; stop-opacity:0.3" />
                    <stop offset="100%" style="stop-color:#f79318; stop-opacity:0" />
                </linearGradient>
            </defs>
            
            <path d="{{ $chartPath }} L400,150 L0,150 Z" fill="url(#chartAreaGradient)"></path>
            
            <path d="{{ $chartPath }}" fill="none" stroke="#f79318" stroke-width="2.5" />
        </svg>
    </div>
</div>
@props(['target' => null, 'disabled' => false])

<button 
    {{ $attributes->merge([
        'type' => 'submit',
        'disabled' => $disabled,
        ])->class([
            // Base classes that are always applied
            'text-white px-8 py-3 rounded-full font-semibold transition-all transform flex items-center justify-center',
            // Conditional classes for the ENABLED state
            'bg-gradient-to-r from-orange-500 to-yellow-500 hover:scale-105' => !$disabled,
            // Conditional classes for the DISABLED state
            'bg-gray-700 text-gray-400 cursor-not-allowed' => $disabled,
    ]) }}
    wire:loading.attr="disabled" 
    @if($target) wire:target="{{ $target }}" @endif
>
    {{-- Spinner --}}
    <svg wire:loading @if($target) wire:target="{{ $target }}" @endif class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    
    {{-- Text --}}
    <span wire:loading.remove @if($target) wire:target="{{ $target }}" @endif>
        {{ $slot }}
    </span>
    <span wire:loading @if($target) wire:target="{{ $target }}" @endif>
        Processing...
    </span>
</button>
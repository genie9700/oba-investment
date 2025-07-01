<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
        body { font-family: 'Space Grotesk', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%); }
        .text-gradient { background: linear-gradient(135deg, #f79318 0%, #fbbf24 50%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .crypto-grid { background-image: linear-gradient(rgba(247, 147, 26, 0.07) 1px, transparent 1px), linear-gradient(90deg, rgba(247, 147, 26, 0.07) 1px, transparent 1px); background-size: 30px 30px; }
    </style>
    </head>
    <body class="gradient-bg text-white">

    <div class="flex items-center justify-center min-h-screen px-4 py-12 relative overflow-hidden">
        <div class="absolute inset-0 crypto-grid opacity-50"></div>

        <div class="relative w-full max-w-md">
            <div class="flex justify-center items-center space-x-3 mb-8">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/cryptane-logo.png') }}" alt="logo" class="w-40">
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>
    @fluxScripts
</body>
</html>
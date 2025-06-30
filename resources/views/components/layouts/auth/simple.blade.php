<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cryptane Investment</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-yellow-500 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-2xl">C</span>
                </div>
                <span class="text-white font-bold text-3xl tracking-tight">Cryptane</span>
            </div>

            {{ $slot }}
        </div>
    </div>
    @fluxScripts
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }} Investment</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/cryptane-logo.png') }}" type="image/x-icon">
    

    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
        }

        .gradient-bg-darker {
            background: linear-gradient(135deg, #0a0a1a 0%, #101024 50%, #0d172f 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #f79318 0%, #fbbf24 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="bg-gray-900 text-white">

    <div x-data="{
        sidebarOpen: false,
        profileDropdownOpen: false,
        user: {
            name: 'John Doe',
            email: 'john.doe@email.com',
            avatarUrl: null // Set to a URL string to show image, or null/empty to show initials
        },
        get initials() {
            if (!this.user.name) return '??';
            const names = this.user.name.split(' ');
            if (names.length > 1) {
                return `${names[0][0]}${names[names.length - 1][0]}`.toUpperCase();
            }
            return this.user.name.substring(0, 2).toUpperCase();
        }
    }" class="flex h-screen bg-gray-900">

        <div x-show="sidebarOpen" class="lg:hidden" x-cloak>
            <div @click="sidebarOpen = false" class="fixed inset-0 bg-black/60 z-30"></div>
            <aside class="fixed inset-y-0 left-0 w-64 gradient-bg-darker border-r border-white/10 z-40 p-6 space-y-8 flex flex-col"
                x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full">

                @include('components.layouts.user.aside')
            </aside>
        </div>

        <aside class="hidden lg:flex lg:flex-col lg:w-64 lg:flex-shrink-0 gradient-bg-darker border-r border-white/10">
            <div class="h-full flex flex-col p-4 space-y-4">
                

                @include('components.layouts.user.aside')
            </div>
        </aside>

        <!-- main content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
                <button @click="sidebarOpen = !sidebarOpen" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl font-bold text-white">Dashboard</h1>
                <div class="w-6"></div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900">

                {{ $slot }}


            </main>
        </div>
    </div>
    @fluxScripts
</body>

</html>

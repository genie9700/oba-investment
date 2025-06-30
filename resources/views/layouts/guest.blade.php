<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Bitcoin Investment Platform</title>
    <link rel="shortcut icon" href="{{ asset('images/cryptane-logo.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        }

        .bitcoin-glow {
            box-shadow: 0 0 50px rgba(247, 147, 26, 0.3);
        }

        .text-gradient {
            background: linear-gradient(135deg, #f79318 0%, #fbbf24 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .crypto-grid {
            background-image:
                linear-gradient(rgba(247, 147, 26, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(247, 147, 26, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .slide-up {
            animation: slideUp 1s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #f79318;
            border-radius: 50%;
            animation: particle 8s linear infinite;
        }

        @keyframes particle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* --- FIX 1: ADDED MISSING ORBIT ANIMATION --- */
        @keyframes orbit {
            from {
                transform: rotate(0deg) translateX(200px) rotate(0deg);
            }

            to {
                transform: rotate(360deg) translateX(200px) rotate(-360deg);
            }
        }

        .orbit-1 {
            top: 50%;
            left: 50%;
            margin: -8px 0 0 -8px;
        }

        .orbit-2 {
            top: 50%;
            left: 50%;
            margin: -6px 0 0 -6px;
        }

        .orbit-3 {
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
        }
    </style>
</head>

<body class="gradient-bg min-h-screen overflow-x-hidden">
    <div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>

    <!-- navigation -->
    @include('layouts.nav')

    @yield('content')




    <!-- footer -->
    @include('layouts.footer')



    <!-- scripts -->
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const monthlyBtn = document.getElementById('monthly-btn');
            const yearlyBtn = document.getElementById('yearly-btn');
            const starterPrice = document.getElementById('starter-price');
            const proPrice = document.getElementById('pro-price');

            // Failsafe in case elements are not found
            if (!monthlyBtn || !yearlyBtn || !starterPrice || !proPrice) {
                return;
            }

            const monthlyPrices = { starter: '$0', pro: '$29' };
            const yearlyPrices = { starter: '$0', pro: '$23' };

            function updatePricing(isYearly) {
                const prices = isYearly ? yearlyPrices : monthlyPrices;
                starterPrice.textContent = prices.starter;
                proPrice.textContent = prices.pro;
            }

            monthlyBtn.addEventListener('click', () => {
                monthlyBtn.classList.add('bg-gradient-to-r', 'from-orange-500', 'to-yellow-500');
                monthlyBtn.classList.remove('text-gray-400');
                yearlyBtn.classList.remove('bg-gradient-to-r', 'from-orange-500', 'to-yellow-500');
                yearlyBtn.classList.add('text-gray-400');
                updatePricing(false);
            });

            yearlyBtn.addEventListener('click', () => {
                yearlyBtn.classList.add('bg-gradient-to-r', 'from-orange-500', 'to-yellow-500');
                yearlyBtn.classList.remove('text-gray-400');
                monthlyBtn.classList.remove('bg-gradient-to-r', 'from-orange-500', 'to-yellow-500');
                monthlyBtn.classList.add('text-gray-400');
                updatePricing(true);
            });
        });
    </script>

    <script>
        // Create floating particles
        function createParticles() {
            const container = document.getElementById('particles');
            if (!container) return; // Failsafe
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 5) + 's';
                container.appendChild(particle);
            }
        }

        // Animate Bitcoin price
        function animatePrice() {
            const priceEl = document.getElementById('btc-price');
            const changeEl = document.getElementById('btc-change');
            if (!priceEl || !changeEl) return; // Failsafe

            setInterval(() => {
                const basePrice = 67432.50;
                const variation = (Math.random() - 0.5) * 1000;
                const newPrice = basePrice + variation;
                const change = ((variation / basePrice) * 100).toFixed(2);

                priceEl.textContent = '$' + newPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                changeEl.textContent = (change >= 0 ? '+' : '') + change + '%';
                changeEl.className = change >= 0 ? 'text-green-400 text-sm' : 'text-red-400 text-sm';
            }, 3000);
        }

        // Animate user count
        function animateUserCount() {
            const countEl = document.getElementById('users-count');
            if (!countEl) return; // Failsafe
            let count = 2500000;

            setInterval(() => {
                count += Math.floor(Math.random() * 10) + 1;
                if (count >= 3000000) count = 2500000;
                countEl.textContent = (count / 1000000).toFixed(1) + 'M+';
            }, 5000);
        }

        // Mouse movement parallax effect
        document.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const { innerWidth, innerHeight } = window;

            const moveX = (clientX / innerWidth - 0.5) * 20;
            const moveY = (clientY / innerHeight - 0.5) * 20;

            const floatingElements = document.querySelectorAll('.floating');
            floatingElements.forEach((el, index) => {
                const factor = (index + 1) * 0.1;
                // Note: The transform property is complex, so we will just apply the parallax
                // This part of the script might conflict with the CSS animation, 
                // but for this effect, it's often subtle.
                el.style.transform = `translate(${moveX * factor}px, ${moveY * factor - 20}px)`;
            });
        });

        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            animatePrice();
            animateUserCount();
        });

        // NOTE: The pricing toggle logic and button click smooth scroll from the
        // original file would need to be in here as well if you want to keep them.
        // For now, I have focused on fixing the missing animations.

    </script>
</body>

</html>
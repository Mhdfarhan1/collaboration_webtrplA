<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @hasSection('title')
            @yield('title') | {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 900: '#1e3a8a' },
                        accent: '#06b6d4',
                    },
                    animation: {
                        'blob': 'blob 10s infinite',
                        'marquee': 'marquee 40s linear infinite',
                        'fade-up': 'fadeUp 0.8s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-100%)' },
                        },
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .gradient-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -10;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.8), rgba(248, 250, 252, 1));
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
            animation: blob 10s infinite;
        }

        /* GLASS CARD UTILS */
        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.1);
            border-color: rgba(59, 130, 246, 0.4);
        }

        .text-glow {
            text-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
        }

        .marquee-container {
            position: absolute;
            top: 5%;
            left: 0;
            width: 100%;
            overflow: hidden;
            pointer-events: none;
            opacity: 0.04;
            z-index: -1;
            transform: rotate(-2deg);
        }

        .marquee-content {
            display: flex;
            white-space: nowrap;
            animation: marquee 60s linear infinite;
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* HAMBURGER */
        .hamburger span {
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -6px);
        }

        /* PAGE TRANSITION LOADER */
        #page-loader.active {
            transform: scaleY(1);
            height: 100vh;
            transition: transform 0.4s ease, height 0.4s ease;
        }

        #page-loader.finish {
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.5s ease;
        }
    </style>
</head>

<body class="text-slate-800 antialiased selection:bg-brand-500 selection:text-white">

    <div class="gradient-bg">
        <div class="orb w-96 h-96 bg-blue-200 top-0 left-0 animate-blob"></div>
        <div class="orb w-96 h-96 bg-cyan-100 bottom-0 right-0 animate-blob" style="animation-delay: 2s"></div>
    </div>

    <div class="marquee-container">
        <div class="marquee-content text-[150px] font-black uppercase text-slate-900 leading-none">
            TRPL A PAGI • OFFICIAL CLASS SITE • POLYTECHNIC • TRPL A PAGI • ENGINEERING • CODE • TRPL A PAGI •
        </div>
    </div>

    <!-- PAGE LOADER -->
    <div id="page-loader"
        class="fixed top-0 left-0 w-full h-1 bg-brand-600 origin-top scale-y-0 z-[9999] transition-transform duration-500">
    </div>



    {{-- NAVBAR --}}
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    {{-- SCRIPT GLOBAL --}}
    @include('partials.scripts')

</body>

</html>
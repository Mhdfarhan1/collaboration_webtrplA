<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRPL A Pagi - The Future Engineers</title>
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

    <nav id="navbar-container" class="fixed top-0 left-0 w-full z-50 pt-4 md:pt-6 transition-all duration-300">

        <div class="w-[92%] max-w-7xl mx-auto relative">

            <div id="nav-panel" class="rounded-full px-5 py-3 md:px-8 md:py-4 flex items-center justify-between
                                   bg-white/80 backdrop-blur-xl border border-white/60 
                                   shadow-xl shadow-slate-200/60
                                   transition-all duration-500 ease-in-out relative z-50">

                <div class="flex items-center gap-3 md:gap-8 shrink-0">
                    <img src="{{ asset('assets/img/logo_apgi.png') }}" alt="Logo APGI"
                        class="h-10 md:h-14 w-auto object-contain hover:scale-105 transition-transform duration-300">
                </div>

                <ul class="hidden lg:flex items-center gap-1">
                    <li><a href="#"
                            class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                                      hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Home</a>
                    </li>
                    <li><a href="#"
                            class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                                      hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Members</a>
                    </li>
                    <li><a href="#"
                            class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                                      hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Albums</a>
                    </li>
                    <li><a href="#"
                            class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                                      hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Projects</a>
                    </li>
                </ul>

                <div class="flex items-center gap-3">
                    <a href="https://notion.so" target="_blank"
                        class="hidden md:flex items-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-full 
                          text-xs font-bold hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/45/Notion_app_logo.png"
                            class="w-4 h-4 brightness-0 invert" alt="Notion">
                        Notion
                    </a>

                    <button id="hamburger-btn" onclick="toggleMenu()" class="lg:hidden w-10 h-10 flex flex-col justify-center items-center gap-1.5 p-2 rounded-full 
                               hover:bg-slate-100 transition active:scale-95">
                        <span id="line1" class="w-5 h-0.5 bg-slate-800 rounded-full transition-all duration-300"></span>
                        <span id="line2" class="w-5 h-0.5 bg-slate-800 rounded-full transition-all duration-300"></span>
                        <span id="line3"
                            class="w-3 ml-auto h-0.5 bg-slate-800 rounded-full transition-all duration-300"></span>
                    </button>
                </div>
            </div>

            <div id="mobile-menu"
                class="absolute top-full left-0 w-full mt-3
                                   origin-top scale-95 opacity-0 invisible transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] z-40">
                <div
                    class="bg-white/90 backdrop-blur-2xl border border-white/60 rounded-3xl p-4 shadow-2xl shadow-slate-300/50 flex flex-col gap-1">
                    <a href="#"
                        class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Home</a>
                    <a href="#"
                        class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Members</a>
                    <a href="#"
                        class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Albums</a>
                    <a href="#"
                        class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Projects</a>

                    <div class="mt-2 pt-2 border-t border-slate-200">
                        <a href="https://notion.so" target="_blank"
                            class="flex items-center justify-center gap-2 bg-slate-900 text-white py-3 rounded-2xl text-xs font-bold">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/4/45/Notion_app_logo.png"
                                class="w-3 h-3 brightness-0 invert" alt="">
                            Open Notion
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </nav>

    <section
        class="min-h-screen pt-40 px-4 md:px-0 w-[92%] max-w-6xl mx-auto flex flex-col justify-center relative pb-24">

        <div
            class="relative w-full h-[560px] md:h-[680px] rounded-[3rem] overflow-hidden group shadow-2xl reveal border border-white/40">

            <!-- Background Image -->
            <img src="{{ asset('assets/img/bg_utama.jpeg') }}"
                alt="TRPL Class"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2.5s] group-hover:scale-110">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-900/40 to-slate-900/20"></div>

            <!-- Glow Ornaments -->
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-blue-500/30 blur-[140px] rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-400/20 blur-[160px] rounded-full"></div>

            <!-- Content -->
            <div class="absolute inset-0 z-10 flex flex-col items-center justify-center px-6 text-center">

                <!-- Badge -->
                <div class="opacity-0 animate-fade-up mb-6 sm:mb-8" style="animation-delay:0.1s;">
                    <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full
                   bg-white/10 backdrop-blur-md border border-white/20 shadow-lg">
                        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                        <span class="text-[10px] sm:text-xs font-bold text-white tracking-[0.35em] uppercase">
                            Welcome To
                        </span>
                    </div>
                </div>

                <!-- Title -->
                <div class="opacity-0 animate-fade-up" style="animation-delay:0.3s;">
                    <h1 class="relative font-black text-white tracking-tight leading-[0.92]
               text-4xl sm:text-4xl md:text-7xl lg:text-7xl drop-shadow-[0_20px_40px_rgba(0,0,0,0.45)]">

                        <span class="block">
                            Terpal
                        </span>

                        <span class="block sm:inline text-transparent bg-clip-text
                   bg-gradient-to-r from-cyan-300 via-sky-400 to-teal-300
                   animate-gradient-x">
                            A PAGI 2024
                        </span>

                        <!-- Glow halus -->
                        <span class="absolute inset-0 -z-10 blur-3xl opacity-30
                   bg-gradient-to-r from-cyan-400 via-blue-500 to-teal-400">
                        </span>
                    </h1>
                </div>


                <!-- Subtitle -->
                <div class="opacity-0 animate-fade-up mt-4 sm:mt-5" style="animation-delay:0.5s;">
                    <p class="text-base sm:text-xl md:text-2xl text-slate-300 font-semibold tracking-wide">
                        Software Engineering Class
                    </p>
                </div>

                <!-- Description -->
                <div class="opacity-0 animate-fade-up mt-3" style="animation-delay:0.7s;">
                    <p class="max-w-xl sm:max-w-2xl text-sm sm:text-base text-slate-400 leading-relaxed">
                        Part of <span class="text-cyan-400 font-semibold">Prodi TRPL</span>
                        <span class="mx-2 text-slate-500">•</span>
                        <span class="text-white font-medium">Politeknik Negeri Batam</span>
                    </p>
                </div>

                <!-- CTA -->
                <div class="opacity-0 animate-fade-up mt-8 sm:mt-10 flex flex-col sm:flex-row gap-3 sm:gap-4"
                    style="animation-delay:0.9s;">

                    <!-- Our Members -->
                    <a href="#members" class="group relative inline-flex items-center justify-center
                   px-6 py-3 text-xs font-semibold uppercase tracking-widest
                   text-white rounded-full bg-brand-600
                   transition-all duration-300 hover:scale-105 active:scale-95
                   focus:outline-none focus:ring-2 focus:ring-brand-500 overflow-hidden">

                        <div class="absolute inset-0 bg-gradient-to-br
                       from-brand-500 via-blue-600 to-cyan-500
                       opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <span class="relative z-10">Our Members</span>
                    </a>

                    <!-- Our Projects -->
                    <a href="#projects" class="group relative inline-flex items-center justify-center
                   px-6 py-3 text-xs font-semibold uppercase tracking-widest
                   text-white rounded-full bg-white/10 backdrop-blur-md
                   border border-white/20
                   transition-all duration-300 hover:scale-105 active:scale-95
                   focus:outline-none focus:ring-2 focus:ring-white/30 overflow-hidden">

                        <div class="absolute inset-0 bg-gradient-to-br
                       from-gray-700 via-gray-800 to-black
                       opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <span class="relative z-10">Our Projects</span>
                    </a>

                </div>

            </div>
        </div>

    </section>



    <section id="about" class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-20">
        <div
            class="bg-slate-900 rounded-[3rem] p-8 md:p-14 overflow-hidden relative shadow-2xl group border border-slate-800 reveal">

            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/40 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-500/30 blur-[120px] rounded-full"></div>

            <div class="relative z-10 flex flex-col lg:flex-row gap-8 lg:gap-20">
                <div class="shrink-0">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-3">
                        Siapa <br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-400">Kami?</span>
                    </h2>
                    <div class="h-1.5 w-20 bg-blue-600 rounded-full"></div>
                </div>

                <div class="max-w-3xl">
                    <p class="text-lg md:text-2xl text-slate-300 font-medium">
                        <span
                            class="text-white font-bold underline decoration-blue-500 decoration-4 underline-offset-4">
                            TRPL A Pagi
                        </span>
                        adalah kelas unggulan Rekayasa Perangkat Lunak di
                        <span class="text-blue-400 font-bold">Politeknik Negeri Batam</span>.
                    </p>

                    <p class="text-sm md:text-base text-slate-400 mt-4 border-l-4 border-slate-700 pl-4">
                        Fokus pada <span class="text-amber-400 font-bold">Software Development</span>,
                        kolaborasi tim, dan manajemen proyek modern.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 reveal">

            <!-- Total Students -->
            <div class="glass-card rounded-[2.5rem] p-8 flex items-center justify-between group">
                <div>
                    <p class="text-slate-500 font-bold text-xs uppercase mb-2">Total Students</p>
                    <h2 class="text-5xl font-black text-slate-800 group-hover:text-brand-600 transition-colors">
                        32
                    </h2>
                </div>
                <div
                    class="w-14 h-14 rounded-full bg-blue-50 text-brand-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <!-- icon -->
                </div>
            </div>

            <!-- Schedule -->
            <div
                class="glass-card rounded-[2.5rem] p-8 flex flex-col justify-between group cursor-pointer relative overflow-hidden">
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-orange-600">
                    Class Schedule
                </h3>
                <p class="text-sm text-slate-500">Check today's timeline.</p>
            </div>

            <!-- Projects -->
            <div
                class="glass-card rounded-[2.5rem] p-8 flex flex-col justify-between group cursor-pointer relative overflow-hidden">
                <h3 class="text-xl font-bold text-slate-800">Our Projects</h3>
                <span class="text-xs text-slate-500 font-bold mt-3">+5 New</span>
            </div>

        </div>
    </section>


    <footer class="text-center py-10 text-slate-400 text-[10px] font-bold tracking-[0.3em] uppercase opacity-70">
        &copy; 2025 TRPL A Pagi • Batam State Polytechnic
    </footer>

    <script>
        // --- LOGIC NAVBAR TRANSITION ---
        const navPanel = document.getElementById('nav-panel');
        const navbarContainer = document.getElementById('navbar-container');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 30) {
                // Saat scroll ke bawah: Muncul Background Putih/Kaca & Shadow
                navPanel.classList.remove('bg-transparent', 'border-transparent', 'shadow-none', 'py-4');
                navPanel.classList.add('bg-white/80', 'backdrop-blur-xl', 'border-white/50', 'shadow-lg', 'py-3');

                navbarContainer.classList.remove('pt-6');
                navbarContainer.classList.add('pt-2');
            } else {
                // Saat di paling atas: Transparan & Lebih Renggang
                navPanel.classList.add('bg-transparent', 'border-transparent', 'shadow-none', 'py-4');
                navPanel.classList.remove('bg-white/80', 'backdrop-blur-xl', 'border-white/50', 'shadow-lg', 'py-3');

                navbarContainer.classList.add('pt-6');
                navbarContainer.classList.remove('pt-2');
            }
        });

        // --- MOBILE MENU ---
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburgerBtn.addEventListener('click', () => {
            hamburgerBtn.classList.toggle('active');
            if (mobileMenu.classList.contains('invisible')) {
                mobileMenu.classList.remove('invisible', 'scale-95', 'opacity-0');
            } else {
                mobileMenu.classList.add('invisible', 'scale-95', 'opacity-0');
            }
        });

        // --- SCROLL REVEAL ---
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                if (elementTop < windowHeight - 100) reveals[i].classList.add("active");
            }
        }
        window.addEventListener("scroll", reveal);
        reveal();
    </script>
</body>

</html>
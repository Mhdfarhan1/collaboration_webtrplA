@extends('layouts.app')

@section('title', 'Home')

@section('content')


<section class="min-h-screen pt-40 px-4 md:px-0 w-[92%] max-w-6xl mx-auto flex flex-col justify-center relative pb-24">

    <div
        class="relative w-full h-[560px] md:h-[680px] rounded-[3rem] overflow-hidden group shadow-2xl reveal border border-white/40">

        <!-- Background Image -->
        <img src="{{ asset('assets/img/bg_utama.jpeg') }}" alt="TRPL Class"
            class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2.5s] group-hover:scale-110">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-linear-to-br from-slate-900/95 via-slate-900/40 to-slate-900/20"></div>

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
                   bg-linear-to-r from-cyan-300 via-sky-400 to-teal-300
                   animate-gradient-x">
                        A PAGI 2024
                    </span>

                    <!-- Glow halus -->
                    <span class="absolute inset-0 -z-10 blur-3xl opacity-30
                   bg-linear-to-r from-cyan-400 via-blue-500 to-teal-400">
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

                    <div class="absolute inset-0 bg-linear-to-br
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

                    <div class="absolute inset-0 bg-linear-to-br
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
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-amber-400 to-orange-400">Kami?</span>
                </h2>
                <div class="h-1.5 w-20 bg-blue-600 rounded-full"></div>
            </div>

            <div class="max-w-3xl">
                <p class="text-lg md:text-2xl text-slate-300 font-medium">
                    <span class="text-white font-bold underline decoration-blue-500 decoration-4 underline-offset-4">
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

        <div
            class="glass-card rounded-[2.5rem] p-8 flex items-center justify-between group hover:shadow-xl hover:shadow-blue-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm">
            <div>
                <p class="text-slate-400 font-bold text-xs uppercase mb-2 tracking-wider">Total Students</p>
                <h2 class="text-5xl font-black text-slate-800 group-hover:text-blue-600 transition-colors">
                    32
                </h2>
            </div>
            <div
                class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
        </div>

        <div
            class="glass-card rounded-[2.5rem] p-8 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-orange-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm">
            <div class="flex flex-col justify-center h-full">
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-orange-600 transition-colors mb-1">
                    Class Schedule
                </h3>
                <p class="text-sm text-slate-400 font-medium group-hover:text-slate-600 transition-colors">Check today's
                    timeline.</p>
            </div>
            <div
                class="w-16 h-16 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center group-hover:scale-110 group-hover:-rotate-3 transition-all duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        </div>

        <div
            class="glass-card rounded-[2.5rem] p-8 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-green-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm">
            <div class="flex flex-col justify-center h-full">
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-green-600 transition-colors mb-1">
                    Our Projects
                </h3>
                <span
                    class="inline-flex items-center text-xs font-bold text-green-600 bg-green-100 px-2 py-1 rounded-md w-fit mt-1">
                    +5 New Updates
                </span>
            </div>
            <div
                class="w-16 h-16 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z">
                    </path>
                </svg>
            </div>
        </div>

    </div>
</section>

<section id="about" class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-24 pt-10">


    <div class="reveal">
        <p class="text-center text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-8">Tools & Technologies We
            Use</p>

        <div class="relative flex overflow-x-hidden group">
            <div class="absolute z-10 top-0 left-0 h-full w-24 bg-linear-to-r from-[#f8fafc] to-transparent"></div>
            <div class="absolute z-10 top-0 right-0 h-full w-24 bg-linear-to-l from-[#f8fafc] to-transparent"></div>

            <div class="animate-marquee whitespace-nowrap flex items-center gap-16 py-4">
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Laravel</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Flutter</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> PHP</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Tailwind</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Figma</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> GitHub</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> MySQL</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Python</span>

                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Laravel</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Flutter</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> PHP</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Tailwind</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Figma</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> GitHub</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> MySQL</span>
                <span class="text-2xl font-bold text-slate-400 flex items-center gap-2"><img
                        src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg"
                        class="w-8 h-8 opacity-60 grayscale hover:grayscale-0 transition-all"> Python</span>
            </div>
        </div>
    </div>
</section>

<section id="gallery" class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-24">

    <div class="text-center mb-12 reveal">
        <span class="text-brand-600 font-bold tracking-widest text-xs uppercase mb-2 block">Our Culture</span>
        <h2 class="text-3xl md:text-5xl font-black text-slate-800">
            Work Hard, <span class="italic font-serif text-slate-400 font-normal">Play Hard.</span>
        </h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 grid-rows-4 md:grid-rows-3 gap-4 h-[800px] md:h-[600px] reveal">

        <div
            class="col-span-2 row-span-2 md:row-span-3 relative rounded-[2.5rem] overflow-hidden group border border-white/40 shadow-xl">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                alt="Main Activity">
            <div class="absolute inset-0 bg-linear-to-t from-slate-900/90 via-transparent to-transparent opacity-80">
            </div>
            <div class="absolute bottom-0 left-0 p-8">
                <span
                    class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-200 border border-blue-400/30 text-[10px] font-bold uppercase backdrop-blur-md">Featured</span>
                <h3 class="text-white font-bold text-2xl mt-2 leading-tight">Momen Kebersamaan <br>di Lab Komputer</h3>
            </div>
        </div>

        <div
            class="col-span-2 md:col-span-2 row-span-1 relative rounded-[2.5rem] overflow-hidden group border border-white/40 shadow-lg">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                alt="Discussion">
            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors"></div>
            <div
                class="absolute bottom-4 left-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                <p class="text-white font-bold text-lg">Focus Group Discussion</p>
            </div>
        </div>

        <div
            class="col-span-1 md:col-span-1 row-span-1 md:row-span-2 relative rounded-[2.5rem] overflow-hidden group border border-white/40 shadow-lg">
            <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?q=80&w=1974&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                alt="Study">
            <div
                class="absolute top-4 right-4 w-8 h-8 bg-white/30 backdrop-blur-md rounded-full flex items-center justify-center text-white text-xs">
                📸</div>
        </div>

        <div
            class="col-span-1 md:col-span-1 row-span-1 md:row-span-2 relative rounded-[2.5rem] overflow-hidden group border border-white/40 shadow-lg cursor-pointer">

            <div class="absolute inset-0 bg-slate-900 group-hover:bg-brand-600 transition-colors duration-500 ease-out">
            </div>

            <div
                class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500/20 blur-[50px] rounded-full group-hover:bg-white/20 transition-all duration-500">
            </div>
            <div
                class="absolute -bottom-10 -left-10 w-40 h-40 bg-purple-500/20 blur-[50px] rounded-full group-hover:bg-white/20 transition-all duration-500">
            </div>

            <div class="relative h-full flex flex-col items-center justify-center z-10 p-6">

                <div
                    class="w-16 h-16 rounded-full border border-white/20 bg-white/5 backdrop-blur-md flex items-center justify-center mb-4 group-hover:bg-white group-hover:scale-110 group-hover:shadow-[0_0_30px_rgba(255,255,255,0.3)] transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-white group-hover:text-brand-600 transform group-hover:translate-x-0.5 transition-all duration-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </div>

                <h4 class="text-white font-bold text-lg md:text-xl text-center leading-tight">
                    Lihat Semua <br>
                    <span
                        class="text-slate-400 group-hover:text-blue-100 transition-colors duration-300">Kegiatan</span>
                </h4>

                <span
                    class="absolute bottom-6 text-[10px] font-black uppercase tracking-[0.2em] text-white/0 translate-y-4 group-hover:text-white/80 group-hover:translate-y-0 transition-all duration-500 ease-out delay-75">
                    Explore Gallery
                </span>
            </div>
        </div>

    </div>
</section>


<section id="members" class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-24 pt-10">

    <div class="flex flex-col md:flex-row items-end justify-between mb-12 reveal">
        <div>
            <span class="text-brand-600 font-bold tracking-widest text-xs uppercase mb-2 block">The Squad</span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-800">
                Meet The <span
                    class="text-transparent bg-clip-text bg-linear-to-r from-blue-600 to-blue-600">Kelas</span>
            </h2>
        </div>
        <div class="hidden md:flex gap-2 mt-4 md:mt-0">
            <span
                class="px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-bold cursor-pointer hover:bg-slate-700 transition">All
                Members</span>
            <span
                class="px-4 py-2 rounded-full bg-white border border-slate-200 text-slate-500 text-xs font-bold cursor-pointer hover:border-brand-500 hover:text-brand-500 transition">Core
                Team</span>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10 reveal">

        <div class="group relative">
            <div class="relative w-full aspect-4/5 rounded-4xl overflow-hidden mb-4 shadow-lg">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1974&auto=format&fit=crop"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0"
                    alt="Member">

                <div
                    class="absolute inset-0 bg-linear-to-t from-brand-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>

                <div
                    class="absolute bottom-0 left-0 w-full p-4 flex justify-center gap-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)]">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center hover:bg-white text-white hover:text-slate-900 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center hover:bg-white text-white hover:text-pink-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="text-center">
                <h3 class="font-bold text-slate-800 text-lg group-hover:text-brand-600 transition-colors">Rizky Ramadhan
                </h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Ketua Kelas</p>
            </div>
        </div>

        <div class="group relative">
            <div class="relative w-full aspect-4/5 rounded-4xl overflow-hidden mb-4 shadow-lg">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1974&auto=format&fit=crop"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0"
                    alt="Member">

                <div
                    class="absolute inset-0 bg-linear-to-t from-brand-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-full p-4 flex justify-center gap-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)]">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center hover:bg-white text-white hover:text-slate-900 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="text-center">
                <h3 class="font-bold text-slate-800 text-lg group-hover:text-brand-600 transition-colors">Siti Aisyah
                </h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Wakil Ketua</p>
            </div>
        </div>

        <div class="group relative">
            <div class="relative w-full aspect-4/5 rounded-4xl overflow-hidden mb-4 shadow-lg">
                <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?q=80&w=1974&auto=format&fit=crop"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0"
                    alt="Member">
                <div
                    class="absolute inset-0 bg-linear-to-t from-brand-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
            <div class="text-center">
                <h3 class="font-bold text-slate-800 text-lg group-hover:text-brand-600 transition-colors">Budi Santoso
                </h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Sekretaris</p>
            </div>
        </div>

        <div class="group relative">
            <div class="relative w-full aspect-4/5 rounded-4xl overflow-hidden mb-4 shadow-lg">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=1974&auto=format&fit=crop"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0"
                    alt="Member">
                <div
                    class="absolute inset-0 bg-linear-to-t from-brand-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
            <div class="text-center">
                <h3 class="font-bold text-slate-800 text-lg group-hover:text-brand-600 transition-colors">Ahmad Fauzi
                </h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Bendahara</p>
            </div>
        </div>

    </div>

    <div class="mt-16 text-center reveal">
        <button
            class="px-8 py-4 rounded-full bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all duration-300 shadow-lg hover:shadow-xl">
            View All 32 Members
        </button>
    </div>

</section>

<section id="projects" class="px-4 md:px-0 w-[92%] max-w-7xl mx-auto pb-32 pt-10">

    <div class="text-center mb-12 reveal">
        <span class="text-brand-600 font-bold tracking-widest text-xs uppercase mb-2 block">Our Portfolio</span>
        <h2 class="text-3xl md:text-5xl font-black text-slate-800">
            Made by <span class="text-transparent bg-clip-text bg-linear-to-r from-cyan-500 to-blue-600">TRPL A
                Pagi.</span>
        </h2>
        <p class="text-slate-500 mt-4 max-w-2xl mx-auto">
            Karya terbaik yang menggabungkan kreativitas dan kode.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 reveal">

        <div
            class="glass-card rounded-[2.5rem] p-4 flex flex-col gap-4 group hover:border-brand-400/50 transition-all duration-500 hover:-translate-y-2">
            <div
                class="w-full aspect-4/3 overflow-hidden rounded-4xl shadow-md relative group-hover:shadow-xl transition-all duration-500">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015&auto=format&fit=crop"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    alt="SIA Polibatam">

                <div
                    class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="#"
                        class="px-5 py-2.5 bg-white text-slate-900 rounded-full font-bold text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">View
                        Demo</a>
                </div>
            </div>

            <div class="px-2 pb-2 flex flex-col h-full">
                <div class="flex flex-wrap gap-2 mb-3">
                    <span
                        class="px-2.5 py-1 rounded-full bg-red-50 text-red-600 text-[10px] font-bold uppercase border border-red-100">Laravel</span>
                    <span
                        class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-600 text-[10px] font-bold uppercase border border-sky-100">Tailwind</span>
                </div>

                <h3
                    class="text-xl font-black text-slate-800 mb-2 leading-tight group-hover:text-brand-600 transition-colors">
                    Sistem Informasi Akademik</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-3">
                    Platform manajemen data mahasiswa terintegrasi dengan absensi real-time dan cetak KHS otomatis.
                </p>

                <div class="mt-auto pt-4 border-t border-slate-100">
                    <a href="#"
                        class="flex items-center gap-2 text-xs font-bold text-slate-800 hover:text-brand-600 transition-colors group/link">
                        <span>Lihat Case Study</span>
                        <svg class="w-3 h-3 transform group-hover/link:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div
            class="glass-card rounded-[2.5rem] p-4 flex flex-col gap-4 group hover:border-brand-400/50 transition-all duration-500 hover:-translate-y-2">
            <div
                class="w-full aspect-4/3 overflow-hidden rounded-4xl shadow-md relative group-hover:shadow-xl transition-all duration-500">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    alt="E-Kantin">
                <div
                    class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="#"
                        class="px-5 py-2.5 bg-white text-slate-900 rounded-full font-bold text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">View
                        Demo</a>
                </div>
            </div>

            <div class="px-2 pb-2 flex flex-col h-full">
                <div class="flex flex-wrap gap-2 mb-3">
                    <span
                        class="px-2.5 py-1 rounded-full bg-cyan-50 text-cyan-600 text-[10px] font-bold uppercase border border-cyan-100">Flutter</span>
                    <span
                        class="px-2.5 py-1 rounded-full bg-orange-50 text-orange-600 text-[10px] font-bold uppercase border border-orange-100">Firebase</span>
                </div>

                <h3
                    class="text-xl font-black text-slate-800 mb-2 leading-tight group-hover:text-brand-600 transition-colors">
                    E-Kantin Mobile App</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-3">
                    Aplikasi pemesanan makanan kantin kampus tanpa antri dengan fitur e-wallet terintegrasi.
                </p>

                <div class="mt-auto pt-4 border-t border-slate-100">
                    <a href="#"
                        class="flex items-center gap-2 text-xs font-bold text-slate-800 hover:text-brand-600 transition-colors group/link">
                        <span>Lihat Case Study</span>
                        <svg class="w-3 h-3 transform group-hover/link:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div
            class="glass-card rounded-[2.5rem] p-4 flex flex-col gap-4 group hover:border-brand-400/50 transition-all duration-500 hover:-translate-y-2">
            <div
                class="w-full aspect-4/3 overflow-hidden rounded-4xl shadow-md relative group-hover:shadow-xl transition-all duration-500">
                <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?q=80&w=2070&auto=format&fit=crop"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    alt="Smart Garden">
                <div
                    class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="#"
                        class="px-5 py-2.5 bg-white text-slate-900 rounded-full font-bold text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">View
                        Demo</a>
                </div>
            </div>

            <div class="px-2 pb-2 flex flex-col h-full">
                <div class="flex flex-wrap gap-2 mb-3">
                    <span
                        class="px-2.5 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-bold uppercase border border-green-100">IoT</span>
                    <span
                        class="px-2.5 py-1 rounded-full bg-yellow-50 text-yellow-600 text-[10px] font-bold uppercase border border-yellow-100">Python</span>
                </div>

                <h3
                    class="text-xl font-black text-slate-800 mb-2 leading-tight group-hover:text-brand-600 transition-colors">
                    Smart Garden System</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-3">
                    Sistem penyiraman otomatis berbasis kelembaban tanah menggunakan ESP32 dan monitoring real-time.
                </p>

                <div class="mt-auto pt-4 border-t border-slate-100">
                    <a href="#"
                        class="flex items-center gap-2 text-xs font-bold text-slate-800 hover:text-brand-600 transition-colors group/link">
                        <span>Lihat Case Study</span>
                        <svg class="w-3 h-3 transform group-hover/link:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-16 text-center reveal">
        <a href="https://github.com" target="_blank"
            class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-full font-bold hover:bg-slate-800 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
            </svg>
            See More on GitHub
        </a>
    </div>

</section>
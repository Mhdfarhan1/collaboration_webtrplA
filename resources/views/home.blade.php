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
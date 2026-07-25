@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- Mana ngoding di waktu luangnya --}}
<section class="min-h-screen pt-40 px-4 md:px-0 w-[92%] max-w-6xl mx-auto flex flex-col justify-center relative pb-24">

    <div
        class="relative w-full h-[560px] md:h-[680px] rounded-[3rem] overflow-hidden group shadow-2xl reveal border border-white/40">

        <!-- Background Image -->
        @if($heroMedia)
            <img src="{{ asset($heroMedia->image_url) }}" alt="{{ $heroMedia->hero_title }}"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2.5s] group-hover:scale-110">
        @else
            <img src="{{ asset('assets/img/bg_utama.jpeg') }}" alt="TRPL Class"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2.5s] group-hover:scale-110">
        @endif

        <!-- Overlay -->
        <div class="absolute inset-0 bg-slate-950/50"></div>

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
                        TRPL
                    </span>

                    <span class="block sm:inline bg-clip-text text-transparent"
                        style="background-image: linear-gradient(to right, #67e8f9, #38bdf8, #2dd4bf);">
                        {{ $heroMedia ? $heroMedia->hero_title : 'A MORNING 2024' }}
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
                    {{ $s['hero_subtitle'] ?? 'Software Engineering Class' }}
                </p>
            </div>

            <!-- Description -->
            <div class="opacity-0 animate-fade-up mt-3" style="animation-delay:0.7s;">
                <p class="max-w-xl sm:max-w-2xl text-sm sm:text-base text-slate-400 leading-relaxed">
                    {{ $s['hero_description'] ?? 'Part of Prodi TRPL • Politeknik Negeri Batam' }}
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
                    Who We <br>
                    <span
                        class="bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text text-transparent">Are?</span>
                </h2>
                <div class="h-1.5 w-20 bg-blue-600 rounded-full"></div>
            </div>

            <div class="max-w-3xl">
                <p class="text-lg md:text-2xl text-slate-300 font-medium">
                    <span class="text-white font-bold">
                        {{ $s['about_class_name'] ?? 'TRPL A Pagi 2024' }}
                    </span>
                    {{ $s['about_description'] ?? 'adalah salah satu kelas Program Studi Teknologi Rekayasa Perangkat Lunak di' }}
                    <span
                        class="text-blue-400 font-bold">{{ $s['about_university'] ?? 'Politeknik Negeri Batam' }}</span>.
                </p>

                <p class="text-sm md:text-base text-slate-400 mt-4 border-l-4 border-slate-700 pl-4">
                    Focusing on <span
                        class="text-amber-400 font-bold">{{ $s['about_focus_keyword'] ?? 'Software Development' }}</span>,
                    {{ $s['about_tagline'] ?? 'Team Collaboration, and Modern Project Management.' }}
                </p>
            </div>
        </div>

    </div>
</section>

<section class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-20">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 reveal">

        {{-- TOTAL STUDENTS --}}
        <div
            class="glass-card rounded-[2rem] p-6 flex items-center justify-between group hover:shadow-xl hover:shadow-blue-200/50 transition-all duration-300 bg-white border border-slate-300 shadow-sm">
            <div>
                <p class="text-slate-400 font-bold text-[10px] uppercase mb-1 tracking-wider">Total Students</p>
                <h2 class="text-4xl font-black text-slate-800 group-hover:text-blue-600 transition-colors">
                    32
                </h2>
            </div>
            <div
                class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
        </div>

        {{-- JADWAL MATKUL --}}
        @if(isset($links['schedule']))
            <a href="{{ $links['schedule']->link_url }}" target="_blank"
                class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-orange-200/50 transition-all duration-300 bg-white border border-slate-300 shadow-sm relative overflow-hidden">
                <div class="flex flex-col justify-center h-full relative z-10">
                    <p class="text-orange-600/50 font-bold text-[10px] uppercase mb-1 tracking-wider">E-Learning</p>
                    <h3 class="text-lg font-bold text-slate-800 group-hover:text-orange-600 transition-colors mb-0.5">
                        Class Schedule
                    </h3>
                    <p
                        class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic font-serif">
                        List of Courses</p>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center group-hover:scale-110 group-hover:-rotate-3 transition-all duration-300 relative z-10">
                    <i data-lucide="calendar" class="w-6 h-6"></i>
                </div>
            </a>
        @endif

        {{-- NOTION KELAS --}}
        @if(isset($links['notion']))
            <a href="{{ $links['notion']->link_url }}" target="_blank"
                class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 bg-white border border-slate-300 shadow-sm relative overflow-hidden">
                <div class="flex flex-col justify-center h-full relative z-10">
                    <p class="text-slate-500/50 font-bold text-[10px] uppercase mb-1 tracking-wider">Workspace</p>
                    <h3 class="text-lg font-bold text-slate-800 group-hover:text-black transition-colors mb-0.5">
                        Class Notion
                    </h3>
                    <p
                        class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic font-serif">
                        Notes & Projects</p>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-slate-900 text-white flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 relative z-10">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/45/Notion_app_logo.png"
                        class="w-6 h-6 brightness-0 invert" alt="">
                </div>
            </a>
        @endif

        {{-- INSTAGRAM --}}
        @if(isset($links['instagram']))
            <a href="{{ $links['instagram']->link_url }}" target="_blank"
                class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-pink-200/50 transition-all duration-300 bg-white border border-slate-300 shadow-sm relative overflow-hidden">
                <div class="flex flex-col justify-center h-full relative z-10">
                    <p class="text-pink-600/50 font-bold text-[10px] uppercase mb-1 tracking-wider">Social Media</p>
                    <h3 class="text-lg font-bold text-slate-800 group-hover:text-pink-600 transition-colors mb-0.5">
                        Instagram
                    </h3>
                    <p class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic">
                        @trplapagi</p>
                </div>
                <div
                    class="w-12 h-12 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center group-hover:scale-110 group-hover:-rotate-3 transition-all duration-300 relative z-10">
                    <i class="fa-brands fa-instagram fa-2x"></i>
                </div>
            </a>
        @endif

        {{-- OUR PROJECTS --}}
        <a href="{{ route('projects') }}"
            class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-green-200/50 transition-all duration-300 bg-white border border-slate-300 shadow-sm relative overflow-hidden">
            <div class="flex flex-col justify-center h-full relative z-10">
                <p class="text-green-600/50 font-bold text-[10px] uppercase mb-1 tracking-wider">Portfolio</p>
                <h3 class="text-lg font-bold text-slate-800 group-hover:text-green-600 transition-colors mb-0.5">
                    Our Projects
                </h3>
                <p
                    class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic font-serif">
                    List of Our Portfolios</p>
            </div>
            <div
                class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 relative z-10">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
        </a>

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

<section id="activities" class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-24 pt-10">
    <div class="flex flex-col items-center text-center mb-10 reveal">
        <span class="text-brand-600 font-bold tracking-widest text-[10px] uppercase mb-2">Our Events</span>
        <h2 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight">
            Class <span
                class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Activities</span>
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 reveal">
        @forelse($activities as $activity)
            <div
                class="reveal group bg-white rounded-3xl p-5 shadow-sm border border-slate-200/80 hover:shadow-xl hover:border-blue-300 transition-all duration-500 hover:-translate-y-1.5 relative overflow-hidden flex flex-col justify-between h-full">

                {{-- Background Accent Blob --}}
                <div
                    class="absolute -top-16 -right-16 w-36 h-36 bg-gradient-to-br from-blue-500/10 via-indigo-500/5 to-transparent rounded-full blur-xl pointer-events-none group-hover:scale-125 transition-transform duration-500">
                </div>

                <div class="relative z-10">
                    {{-- Image / Thumbnail Frame (Aspect 16:10 Box) --}}
                    <a href="{{ route('activities.detail', \App\Helpers\SecurityHelper::encode($activity->activity_id)) }}"
                        class="block w-full aspect-[16/10] rounded-2xl overflow-hidden relative shadow-2xs border border-slate-100 group-hover:border-blue-200 transition-colors mb-4">
                        @if($activity->activity_image)
                            <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            {{-- Modern Gradient Fallback Banner --}}
                            <div
                                class="w-full h-full bg-gradient-to-br from-blue-600 via-indigo-600 to-slate-900 flex flex-col items-center justify-center p-4 text-white text-center relative overflow-hidden">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-1.5 shadow-inner">
                                    <i data-lucide="sparkles" class="w-5 h-5 text-cyan-300"></i>
                                </div>
                                <span class="text-[9px] font-black uppercase tracking-widest text-cyan-200">TRPL A
                                    Activity</span>
                            </div>
                        @endif

                        {{-- Date Badge (Top-Left Floating) --}}
                        <div
                            class="absolute top-3 left-3 bg-white/95 backdrop-blur-md px-3 py-1.5 rounded-xl shadow-xs border border-white/80 flex flex-col items-center justify-center text-center">
                            <span
                                class="text-blue-600 text-sm font-black leading-none mb-0.5">{{ $activity->created_at->format('d') }}</span>
                            <span
                                class="text-[8px] font-extrabold text-slate-500 uppercase tracking-wider">{{ $activity->created_at->format('M Y') }}</span>
                        </div>

                        {{-- Photos Count Badge (Bottom-Right Floating) --}}
                        <div
                            class="absolute bottom-3 right-3 bg-slate-900/80 backdrop-blur-md text-white px-2.5 py-1 rounded-lg text-[10px] font-extrabold flex items-center gap-1 shadow-sm border border-white/20">
                            <i data-lucide="image" class="w-3.5 h-3.5 text-cyan-400"></i>
                            <span>{{ $activity->activityMedia->count() }} Foto</span>
                        </div>
                    </a>

                    {{-- Content Section --}}
                    <div class="mb-4">
                        <span
                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-100 mb-2.5">
                            <i data-lucide="calendar" class="w-3 h-3 text-blue-500"></i>
                            <span>Class Event</span>
                        </span>

                        <h3
                            class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors mb-2 line-clamp-2">
                            <a
                                href="{{ route('activities.detail', \App\Helpers\SecurityHelper::encode($activity->activity_id)) }}">
                                {{ $activity->activity_name }}
                            </a>
                        </h3>

                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 font-medium">
                            {{ $activity->activity_description }}
                        </p>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="relative z-10 pt-3 border-t border-slate-100 flex items-center justify-between gap-3 mt-auto">
                    <a href="{{ route('activities.detail', \App\Helpers\SecurityHelper::encode($activity->activity_id)) }}"
                        class="inline-flex items-center gap-1 text-[11px] font-extrabold text-blue-600 hover:text-blue-700 group-hover:translate-x-0.5 transition-transform">
                        <span>View Details</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>

                    {{-- Gallery Preview Thumbnails if media available --}}
                    @if($activity->activityMedia->count() > 0)
                        <div class="flex items-center -space-x-1.5 overflow-hidden">
                            @foreach($activity->activityMedia->take(3) as $media)
                                <div class="w-6 h-6 rounded-md overflow-hidden border-2 border-white shadow-2xs bg-slate-100">
                                    <img src="{{ asset($media->activity_media_url) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                            @if($activity->activityMedia->count() > 3)
                                <div
                                    class="w-6 h-6 rounded-md bg-blue-600 text-white text-[8px] font-black flex items-center justify-center border-2 border-white shadow-2xs">
                                    +{{ $activity->activityMedia->count() - 3 }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold italic">No class activities have been published yet.</p>
            </div>
        @endforelse
    </div>

    {{-- Bottom Action Button --}}
    <div class="mt-12 text-center reveal">
        <a href="{{ route('activities') }}"
            class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-white border border-slate-200 text-slate-700 font-extrabold text-xs hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all duration-300 shadow-md hover:shadow-xl group">
            <span>View All Activities</span>
            <i data-lucide="arrow-right"
                class="w-4 h-4 text-blue-600 group-hover:text-cyan-400 transition-transform group-hover:translate-x-1"></i>
        </a>
    </div>
</section>


<section id="gallery" class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-24">

    <div class="text-center mb-10 reveal">
        <span class="text-brand-600 font-bold tracking-widest text-[10px] uppercase mb-2 block">Our Culture</span>
        <h2 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight">
            Work Hard, <span class="italic font-serif text-slate-400 font-normal">Play Hard.</span>
        </h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 grid-rows-4 md:grid-rows-3 gap-4 h-[800px] md:h-[600px] reveal">

        @php $featuredAlbum = $albums->first(); @endphp
        @if($featuredAlbum)
            <div
                class="col-span-2 row-span-2 md:row-span-3 relative rounded-[2.5rem] overflow-hidden group border border-white/40 shadow-xl">
                <img src="{{ asset($featuredAlbum->album_cover) }}"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    alt="{{ $featuredAlbum->album_name }}">
                <div class="absolute inset-0 bg-linear-to-t from-slate-900/90 via-transparent to-transparent opacity-80">
                </div>
                <div class="absolute bottom-0 left-0 p-8">
                    <span
                        class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-200 border border-blue-400/30 text-[10px] font-bold uppercase backdrop-blur-md">Featured
                        Album</span>
                    <h3 class="text-white font-bold text-2xl mt-2 leading-tight">{{ $featuredAlbum->album_name }}</h3>
                </div>
                <a href="{{ route('albums.detail', $featuredAlbum->album_id) }}" class="absolute inset-0 z-20"></a>
            </div>
        @endif

        @php $secondAlbum = $albums->skip(1)->first(); @endphp
        @if($secondAlbum)
            <div
                class="col-span-2 md:col-span-2 row-span-1 relative rounded-[2.5rem] overflow-hidden group border border-white/40 shadow-lg">
                <img src="{{ asset($secondAlbum->album_cover) }}"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    alt="{{ $secondAlbum->album_name }}">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors"></div>
                <div
                    class="absolute bottom-4 left-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                    <p class="text-white font-bold text-lg">{{ $secondAlbum->album_name }}</p>
                </div>
                <a href="{{ route('albums.detail', $secondAlbum->album_id) }}" class="absolute inset-0 z-20"></a>
            </div>
        @endif

        @php $thirdAlbum = $albums->skip(2)->first(); @endphp
        @if($thirdAlbum)
            <div
                class="col-span-1 md:col-span-1 row-span-1 md:row-span-2 relative rounded-[2.5rem] overflow-hidden group border border-white/40 shadow-lg">
                <img src="{{ asset($thirdAlbum->album_cover) }}"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    alt="{{ $thirdAlbum->album_name }}">
                <div
                    class="absolute top-4 right-4 w-8 h-8 bg-white/30 backdrop-blur-md rounded-full flex items-center justify-center text-white text-xs">
                </div>
                <a href="{{ route('albums.detail', $thirdAlbum->album_id) }}" class="absolute inset-0 z-20"></a>
            </div>
        @endif

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
                    View All <br>
                    <span
                        class="text-slate-400 group-hover:text-blue-100 transition-colors duration-300 font-serif italic">Photo
                        Gallery</span>
                </h4>

                <span
                    class="absolute bottom-6 text-[10px] font-black uppercase tracking-[0.2em] text-white/0 translate-y-4 group-hover:text-white/80 group-hover:translate-y-0 transition-all duration-500 ease-out delay-75">
                    Explore Gallery
                </span>
            </div>
            <a href="{{ route('albums') }}" class="absolute inset-0 z-20"></a>
        </div>

    </div>
</section>

<section id="members" class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-24 pt-10">
    <div class="flex flex-col items-center text-center mb-12 reveal">
        <span class="text-blue-600 font-extrabold tracking-widest text-xs uppercase mb-2">The Squad</span>
        <h2 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">
            Meet The <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Squad
                Members</span>
        </h2>
        <p class="text-slate-500 text-sm max-w-xl font-medium">Talented students of TRPL A Morning collaborating in
            works and innovation.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 reveal">
        @forelse($members as $member)
            <div class="group relative cursor-pointer perspective">
                {{-- Card Container --}}
                <div
                    class="relative h-[420px] overflow-hidden rounded-[2rem] shadow-sm bg-slate-900 transition-all duration-500 hover:-translate-y-2 hover:shadow-xl hover:shadow-blue-900/20">

                    {{-- Foto Background --}}
                    @if ($member->member_image)
                        <img src="{{ asset($member->member_image) }}" alt="Foto {{ $member->member_name }}"
                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105 opacity-85 group-hover:opacity-100">
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-br from-blue-700 to-indigo-900 flex items-center justify-center text-white font-extrabold text-3xl opacity-85 group-hover:opacity-100 transition-opacity">
                            {{ strtoupper(substr($member->member_name, 0, 2)) }}
                        </div>
                    @endif

                    {{-- Gradient Overlay --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-900/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity duration-300">
                    </div>

                    {{-- Floating NIM Badge (Top Right) --}}
                    <div class="absolute top-6 right-5 z-10">
                        <div
                            class="px-4 py-1.5 bg-blue-600 border border-blue-400/20 rounded-full flex items-center shadow-md">
                            <span class="text-[10px] font-mono font-bold text-white tracking-wider uppercase">
                                NIM : {{ $member->member_nim ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- [BAWAH] Text Content --}}
                    <div class="absolute bottom-0 left-0 w-full p-6 z-10">

                        {{-- Role Label --}}
                        <div class="flex items-center gap-2 mb-2.5">
                            <div class="h-[2px] w-6 {{ $member->member_is_core ? 'bg-amber-400' : 'bg-blue-400' }}"></div>
                            <p
                                class="{{ $member->member_is_core ? 'text-amber-400' : 'text-blue-400' }} text-[10px] font-bold tracking-[0.2em] uppercase">
                                {{ $member->member_is_core ? 'CORE TEAM' : 'MEMBER' }}
                            </p>
                        </div>

                        {{-- Nama --}}
                        <h3
                            class="text-xl font-extrabold text-white mb-1.5 leading-tight group-hover:text-blue-300 transition-colors line-clamp-1">
                            {{ $member->member_name }}
                        </h3>
                        <p class="text-xs text-slate-300 mb-4 font-medium">Informatics Engineering • 2024</p>

                        {{-- Divider --}}
                        <div class="h-[1px] w-full bg-gradient-to-r from-white/30 to-transparent mb-4"></div>

                        {{-- Social Media --}}
                        <div class="flex items-center gap-3 transition-all duration-300">
                            @if ($member->instagram_url)
                                <a href="{{ $member->instagram_url }}" target="_blank"
                                    class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-gradient-to-tr hover:from-orange-500 hover:to-purple-600 hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                                    <i class="fa-brands fa-instagram text-xs"></i>
                                </a>
                            @endif

                            @if ($member->linkedin_url)
                                <a href="{{ $member->linkedin_url }}" target="_blank"
                                    class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-blue-600 hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                                    <i class="fa-brands fa-linkedin text-xs"></i>
                                </a>
                            @endif

                            @if ($member->github_url)
                                <a href="{{ $member->github_url }}" target="_blank"
                                    class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-slate-800 hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                                    <i class="fa-brands fa-github text-xs"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold italic">No class member data available.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-16 text-center reveal">
        <a href="{{ route('members')}}"
            class="px-8 py-4 rounded-full bg-white border border-slate-300 text-slate-600 font-bold hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all duration-300 shadow-lg hover:shadow-xl">
            View All 32 Members
        </a>
    </div>
</section>

<section id="projects" class="px-4 md:px-0 w-[92%] max-w-7xl mx-auto pb-32 pt-10">

    <div class="flex flex-col items-center text-center mb-12 reveal">
        <span class="text-brand-600 font-bold tracking-widest text-xs uppercase mb-2">Our Portfolio</span>
        <h2 class="text-3xl md:text-5xl font-black text-slate-800 tracking-tight">
            Made by <span class="bg-gradient-to-r from-cyan-500 to-blue-600 bg-clip-text text-transparent">TRPL A
                Morning.</span>
        </h2>
        <p class="text-slate-500 mt-4 max-w-2xl">
            Outstanding works combining creativity and code.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 reveal">
        @forelse($projects as $loopIndex => $project)
            @php
                $bgGradients = ['bg-indigo-600', 'bg-sky-600', 'bg-emerald-600', 'bg-purple-600', 'bg-blue-600'];
                $bgClass = $bgGradients[$loop->index % count($bgGradients)];
                $words = explode(' ', $project->title);
                $initials = count($words) >= 2 ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) : strtoupper(substr($project->title, 0, 2));
            @endphp
            <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-blue-200/60 transition-all duration-300 flex flex-col justify-between h-full group">
                <div>
                    <!-- Top Thumbnail Box -->
                    <div class="w-full aspect-[16/10] rounded-2xl overflow-hidden relative mb-4 shadow-2xs border border-slate-100">
                        @if($project->image_url)
                            <img src="{{ asset($project->image_url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $project->title }}">
                        @else
                            <div class="w-full h-full {{ $bgClass }} flex items-center justify-center">
                                <span class="text-5xl font-black text-white tracking-widest drop-shadow-md">{{ $initials }}</span>
                            </div>
                        @endif

                        <!-- Floating Badges Top-Left -->
                        <div class="absolute top-3 left-3 flex flex-wrap items-center gap-1.5 z-10">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/95 text-slate-800 text-[10px] font-extrabold backdrop-blur-md shadow-2xs border border-white/40">
                                <i data-lucide="layers" class="w-3 h-3 text-slate-500"></i>
                                <span>Sem {{ $project->semester ?? 1 }}</span>
                            </span>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/95 text-slate-800 text-[10px] font-extrabold backdrop-blur-md shadow-2xs border border-white/40">
                                <i data-lucide="globe" class="w-3 h-3 text-emerald-600"></i>
                                <span>{{ $project->project_type ?? 'Web Application' }}</span>
                            </span>
                        </div>

                        <!-- Floating Demo Badge Top-Right -->
                        @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="absolute top-3 right-3 inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-600/90 hover:bg-blue-600 text-white text-[10px] font-extrabold backdrop-blur-md transition-all shadow-2xs z-10">
                                <i data-lucide="external-link" class="w-3 h-3"></i>
                                <span>Demo</span>
                            </a>
                        @endif
                    </div>

                    <!-- Manpro Chip -->
                    @if($project->projectManager)
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100/90 border border-slate-200/80 text-slate-700 text-xs font-semibold mb-3">
                            <div class="w-5 h-5 rounded-full overflow-hidden shrink-0 bg-slate-200 border border-slate-300">
                                @if($project->projectManager->lecturer_image)
                                    <img src="{{ asset($project->projectManager->lecturer_image) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-[9px] font-bold text-slate-600 flex items-center justify-center h-full">{{ substr($project->projectManager->lecturer_name, 0, 1) }}</span>
                                @endif
                            </div>
                            <span class="text-slate-500 font-medium">Manpro:</span>
                            <span class="font-bold text-slate-800 truncate max-w-[160px]">{{ $project->projectManager->full_name_with_title }}</span>
                        </div>
                    @endif

                    <!-- Title & Description -->
                    <h3 class="text-lg font-extrabold text-slate-900 mb-1.5 leading-snug group-hover:text-blue-600 transition-colors line-clamp-1">
                        <a href="{{ route('projects.detail', \App\Helpers\SecurityHelper::encode($project->project_id)) }}">
                            {{ $project->title }}
                        </a>
                    </h3>
                    <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-2">
                        {{ $project->description }}
                    </p>

                    <!-- Dev Team -->
                    <div class="mb-4">
                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block mb-2">DEV TEAM:</span>
                        <div class="flex -space-x-2 items-center">
                            @foreach($project->projectMembers->take(4) as $pm)
                                @if($pm->member && $pm->member->member_image)
                                    <img class="w-7 h-7 rounded-full border-2 border-white shadow-2xs object-cover"
                                        src="{{ asset($pm->member->member_image) }}" alt="{{ $pm->member->member_name }}"
                                        title="{{ $pm->member->member_name }} - {{ $pm->project_member_role }}">
                                @else
                                    <div class="w-7 h-7 rounded-full border-2 border-white shadow-2xs bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600"
                                        title="{{ $pm->member ? $pm->member->member_name : 'Member' }}">
                                        {{ substr($pm->member ? $pm->member->member_name : 'U', 0, 1) }}
                                    </div>
                                @endif
                            @endforeach

                            @if($project->projectMembers->count() > 4)
                                <div class="w-7 h-7 rounded-full border-2 border-white shadow-2xs bg-slate-100 flex items-center justify-center text-[9px] font-bold text-slate-600">
                                    +{{ $project->projectMembers->count() - 4 }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer Bar: Tech Badges & Detail Button -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 mt-auto">
                    <div class="flex flex-wrap gap-1.5 items-center min-w-0">
                        @forelse($project->projectTechs->take(3) as $tech)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100/90 text-slate-700 text-[10px] font-extrabold uppercase border border-slate-200/80">
                                {!! \App\Helpers\TechHelper::renderIcon($tech->tech_name) !!}
                                {{ $tech->tech_name }}
                            </span>
                        @empty
                            <span class="text-[10px] font-medium text-slate-400 italic">General</span>
                        @endforelse

                        @if($project->projectTechs->count() > 3)
                            <span class="px-2 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-bold border border-slate-200/80">
                                +{{ $project->projectTechs->count() - 3 }}
                            </span>
                        @endif
                    </div>

                    <a href="{{ route('projects.detail', \App\Helpers\SecurityHelper::encode($project->project_id)) }}"
                        class="inline-flex items-center gap-1 px-4 py-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all text-xs font-extrabold shadow-2xs group/btn shrink-0">
                        <span>Detail</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-0.5"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-slate-500">
                <div class="flex justify-center mb-4">
                    <svg class="w-16 h-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-lg font-medium text-slate-600">No Projects Available</p>
                <p class="text-sm">Awesome projects from TRPL A Morning students will be available here soon.</p>
            </div>
        @endforelse
    </div>

    @if(isset($projects) && $projects->hasPages())
        <div class="mt-16 flex justify-center reveal">
            {{ $projects->links() }}
        </div>
    @endif

</section>
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

                    <span class="block sm:inline bg-clip-text text-transparent" 
                        style="background-image: linear-gradient(to right, #67e8f9, #38bdf8, #2dd4bf);">
                    {{ $heroMedia ? $heroMedia->hero_title : 'A PAGI 2024' }}
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
                    Siapa <br>
                    <span class="bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text text-transparent">Kami?</span>
                </h2>
                <div class="h-1.5 w-20 bg-blue-600 rounded-full"></div>
            </div>

            <div class="max-w-3xl">
                <p class="text-lg md:text-2xl text-slate-300 font-medium">
                    <span class="text-white font-bold">
                        {{ $s['about_class_name'] ?? 'TRPL A Pagi' }}
                    </span>
                    {{ $s['about_description'] ?? 'adalah kelas unggulan (howak) Rekayasa Perangkat Lunak di' }}
                    <span class="text-blue-400 font-bold">{{ $s['about_university'] ?? 'Politeknik Negeri Batam' }}</span>.
                </p>

                <p class="text-sm md:text-base text-slate-400 mt-4 border-l-4 border-slate-700 pl-4">
                    Fokus pada <span class="text-amber-400 font-bold">{{ $s['about_focus_keyword'] ?? 'Software Development' }}</span>,
                    {{ $s['about_tagline'] ?? 'kolaborasi tim, dan manajemen proyek modern.' }}
                </p>
            </div>
        </div>

    </div>
</section>

<section class="px-4 md:px-0 w-[92%] max-w-6xl mx-auto pb-20">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 reveal">

        {{-- TOTAL STUDENTS --}}
        <div
            class="glass-card rounded-[2rem] p-6 flex items-center justify-between group hover:shadow-xl hover:shadow-blue-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm">
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
            class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-orange-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="flex flex-col justify-center h-full relative z-10">
                <p class="text-orange-600/50 font-bold text-[10px] uppercase mb-1 tracking-wider">E-Learning</p>
                <h3 class="text-lg font-bold text-slate-800 group-hover:text-orange-600 transition-colors mb-0.5">
                    Jadwal Matkul
                </h3>
                <p class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic">Daftar Mata Kuliah</p>
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
            class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="flex flex-col justify-center h-full relative z-10">
                <p class="text-slate-500/50 font-bold text-[10px] uppercase mb-1 tracking-wider">Workspace</p>
                <h3 class="text-lg font-bold text-slate-800 group-hover:text-black transition-colors mb-0.5">
                    Notion Kelas
                </h3>
                <p class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic">Catatan & Projek</p>
            </div>
            <div
                class="w-12 h-12 rounded-xl bg-slate-900 text-white flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 relative z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/45/Notion_app_logo.png" class="w-6 h-6 brightness-0 invert" alt="">
            </div>
        </a>
        @endif

        {{-- INSTAGRAM --}}
        @if(isset($links['instagram']))
        <a href="{{ $links['instagram']->link_url }}" target="_blank"
            class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-pink-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="flex flex-col justify-center h-full relative z-10">
                <p class="text-pink-600/50 font-bold text-[10px] uppercase mb-1 tracking-wider">Social Media</p>
                <h3 class="text-lg font-bold text-slate-800 group-hover:text-pink-600 transition-colors mb-0.5">
                    Instagram
                </h3>
                <p class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic">@trplapagi</p>
            </div>
            <div
                class="w-12 h-12 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center group-hover:scale-110 group-hover:-rotate-3 transition-all duration-300 relative z-10">
                <i data-lucide="instagram" class="w-6 h-6"></i>
            </div>
        </a>
        @endif

        {{-- OUR PROJECTS --}}
        <a href="{{ route('projects') }}"
            class="glass-card rounded-[2rem] p-6 flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-green-200/50 transition-all duration-300 bg-white border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="flex flex-col justify-center h-full relative z-10">
                <p class="text-green-600/50 font-bold text-[10px] uppercase mb-1 tracking-wider">Portfolio</p>
                <h3 class="text-lg font-bold text-slate-800 group-hover:text-green-600 transition-colors mb-0.5">
                    Our Projects
                </h3>
                <p class="text-[10px] text-slate-400 font-medium group-hover:text-slate-600 transition-colors italic">Daftar Karya Kami</p>
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
        <h2 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight mb-4">
            Class <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Activities</span>
        </h2>
        <a href="{{ route('activities') }}" class="group flex items-center gap-2 text-slate-400 hover:text-brand-600 font-bold text-sm transition-all">
            Lihat Semua Kegiatan
            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 reveal">
        @forelse($activities as $activity)
            <div class="group relative bg-white rounded-[2.5rem] p-5 shadow-xl shadow-slate-200/40 border border-slate-100 hover:-translate-y-2 transition-all duration-500">
                <div class="relative aspect-video rounded-[1.8rem] overflow-hidden mb-6">
                    @if($activity->activity_image)
                        <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                            <i data-lucide="image" class="w-10 h-10"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-lg shadow-sm border border-white/50 text-[10px] font-black text-slate-800 uppercase tracking-widest">
                        {{ $activity->created_at->format('d M Y') }}
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-brand-600 transition-colors line-clamp-1">{{ $activity->activity_name }}</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2 italic">"{{ $activity->activity_description }}"</p>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">Event</span>
                    <a href="{{ route('activities') }}" class="text-brand-600 font-bold text-xs flex items-center gap-1.5 group/link">
                        Detail
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-0.5"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-slate-50 rounded-[2.5rem] border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold italic">Belum ada kegiatan yang dipublikasikan.</p>
            </div>
        @endforelse
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
                    class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-200 border border-blue-400/30 text-[10px] font-bold uppercase backdrop-blur-md">Featured Album</span>
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
                📸</div>
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
                    Lihat Semua <br>
                    <span
                        class="text-slate-400 group-hover:text-blue-100 transition-colors duration-300">Galeri Foto</span>
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
        <span class="text-brand-600 font-bold tracking-widest text-xs uppercase mb-2">The Squad</span>
        <h2 class="text-3xl md:text-5xl font-black text-slate-800 tracking-tight mb-6">
            Meet The <span class="bg-gradient-to-r from-blue-600 to-blue-600 bg-clip-text text-transparent">Member</span>
        </h2>
        <div class="flex gap-2">
            <span class="px-4 py-2 rounded-full bg-slate-900 text-white text-[10px] font-bold cursor-pointer hover:bg-slate-700 transition">All Members</span>
            <span class="px-4 py-2 rounded-full bg-white border border-slate-200 text-slate-500 text-[10px] font-bold cursor-pointer hover:border-brand-500 hover:text-brand-500 transition">Core Team</span>
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

    <div class="flex flex-col items-center text-center mb-12 reveal">
        <span class="text-brand-600 font-bold tracking-widest text-xs uppercase mb-2">Our Portfolio</span>
        <h2 class="text-3xl md:text-5xl font-black text-slate-800 tracking-tight">
            Made by <span class="bg-gradient-to-r from-cyan-500 to-blue-600 bg-clip-text text-transparent">TRPL A Pagi.</span>
        </h2>
        <p class="text-slate-500 mt-4 max-w-2xl">
            Karya terbaik yang menggabungkan kreativitas dan kode.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 reveal">
        @forelse($projects as $project)
        <div
            class="glass-card rounded-[2.5rem] p-4 flex flex-col gap-4 group hover:border-brand-400/50 transition-all duration-500 hover:-translate-y-2">
            <div
                class="w-full aspect-4/3 overflow-hidden rounded-4xl shadow-md relative group-hover:shadow-xl transition-all duration-500">
                @if($project->image_url)
                    <img src="{{ asset($project->image_url) }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="{{ $project->title }}">
                @else
                    <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                        <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
                <div
                    class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="{{ $project->demo_url ?? '#' }}" {{ $project->demo_url ? 'target="_blank"' : '' }}
                        class="px-5 py-2.5 bg-white text-slate-900 rounded-full font-bold text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">View
                        Demo</a>
                </div>
            </div>

            <div class="px-2 pb-2 flex flex-col h-full">
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach($project->projectTechs as $tech)
                        @php
                            $colors = ['red', 'sky', 'cyan', 'orange', 'green', 'yellow', 'blue', 'purple', 'pink', 'indigo'];
                            $colorIndex = abs(crc32($tech->tech_name)) % count($colors);
                            $color = $colors[$colorIndex];
                        @endphp
                        <span
                            class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold uppercase border border-slate-200">{{ $tech->tech_name }}</span>
                    @endforeach
                </div>

                <h3
                    class="text-xl font-black text-slate-800 mb-2 leading-tight group-hover:text-brand-600 transition-colors">
                    {{ $project->title }}
                </h3>

                <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-3">
                    {{ $project->description }}
                </p>

                <div class="flex items-center gap-3 mb-4 mt-auto">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Dev Team:</span>
                    <div class="flex -space-x-2">
                        @foreach($project->projectMembers->take(3) as $pm)
                            @if($pm->member && $pm->member->member_image)
                                <img class="w-8 h-8 rounded-full border-2 border-white shadow-sm object-cover"
                                    src="{{ asset($pm->member->member_image) }}" alt="{{ $pm->member->member_name }}" title="{{ $pm->member->member_name }} - {{ $pm->project_member_role }}">
                            @else
                                <div class="w-8 h-8 rounded-full border-2 border-white shadow-sm bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-500" title="{{ $pm->member ? $pm->member->member_name : 'Member' }}">
                                    {{ substr($pm->member ? $pm->member->member_name : 'U', 0, 1) }}
                                </div>
                            @endif
                        @endforeach
                        
                        @if($project->projectMembers->count() > 3)
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white shadow-sm bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600">
                                +{{ $project->projectMembers->count() - 3 }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 mt-2">
                    <a href="{{ route('projects.detail', $project->project_id) }}"
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
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-slate-500">
                <div class="flex justify-center mb-4">
                    <svg class="w-16 h-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-lg font-medium text-slate-600">Belum Ada Proyek</p>
                <p class="text-sm">Proyek-proyek keren dari mahasiswa TRPL A Pagi akan segera hadir di sini.</p>
            </div>
        @endforelse
    </div>

    @if(isset($projects) && $projects->hasPages())
        <div class="mt-16 flex justify-center reveal">
            {{ $projects->links() }}
        </div>
    @endif

</section>
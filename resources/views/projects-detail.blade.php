@extends('layouts.app')

@section('title', $project->title . ' - Project Detail')

@section('content')
    <section class="bg-gray-50 min-h-screen pt-32 pb-24 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-4 sm:px-6 max-w-6xl">

            {{-- BACK BUTTON & BREADCRUMB --}}
            <nav class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
                <a href="{{ route('projects') }}" 
                    class="group inline-flex items-center gap-2.5 px-5 py-2.5 bg-white rounded-full border border-slate-200/80 hover:bg-slate-50 hover:border-blue-300 transition-all duration-300 shadow-2xs">
                    <i data-lucide="arrow-left" class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transform group-hover:-translate-x-1 transition-all"></i>
                    <span class="text-xs font-extrabold text-slate-600 group-hover:text-blue-700">Kembali ke Projects</span>
                </a>
                
                <ol class="hidden sm:inline-flex items-center space-x-1.5 sm:space-x-2 bg-white/90 backdrop-blur-md py-2.5 px-5 rounded-full shadow-2xs border border-slate-200/80 text-xs font-bold text-slate-500">
                    <li><a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-blue-600 transition-colors"><i data-lucide="home" class="w-3.5 h-3.5 text-slate-400"></i> Home</a></li>
                    <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i></li>
                    <li><a href="{{ route('projects') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-blue-600 transition-colors"><i data-lucide="folder-code" class="w-3.5 h-3.5 text-slate-400"></i> Projects</a></li>
                    <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i></li>
                    <li class="text-blue-600 font-extrabold">{{ Str::limit($project->title, 25) }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- LEFT SIDE: MAIN HERO & CONTENT --}}
                <div class="lg:col-span-8 space-y-8">
                    
                    {{-- HEADER DETAILS CARD --}}
                    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-bl from-blue-500/10 via-cyan-400/5 to-transparent rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
                        
                        <div class="relative z-10 space-y-4">
                            <!-- Semester & Tech Stack Badges -->
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-900 text-white text-[11px] font-bold shadow-2xs">
                                    <i data-lucide="layers" class="w-3.5 h-3.5 text-blue-400"></i>
                                    <span>Semester {{ $project->semester ?? 1 }}</span>
                                </span>
                                
                                @foreach($project->projectTechs as $tech)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 text-[11px] font-bold uppercase border border-blue-100">
                                        {!! \App\Helpers\TechHelper::renderIcon($tech->tech_name) !!}
                                        {{ $tech->tech_name }}
                                    </span>
                                @endforeach
                            </div>
                            
                            <!-- Project Title -->
                            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug tracking-tight">
                                {{ $project->title }}
                            </h1>

                            <!-- Live Demo Button if Available -->
                            @if($project->demo_url)
                                <div class="pt-1">
                                    <a href="{{ $project->demo_url }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white rounded-xl font-bold text-xs shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 active:scale-95">
                                        <i data-lucide="globe" class="w-4 h-4"></i>
                                        <span>Kunjungi Web / Live Demo</span>
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- MAIN FEATURED IMAGE --}}
                    <div class="bg-white p-3 rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="w-full aspect-[16/10] sm:aspect-video rounded-2xl overflow-hidden relative bg-slate-100 group">
                            @if($project->image_url)
                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400 gap-2">
                                    <i data-lucide="image" class="w-16 h-16 text-slate-300"></i>
                                    <span class="text-xs font-semibold text-slate-400">Tidak Ada Gambar Project</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- PROJECT DESCRIPTION --}}
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                        <div class="flex items-center gap-3.5 mb-6 pb-4 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100 shadow-2xs">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-slate-900">Deskripsi Project</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Project Story & Details</p>
                            </div>
                        </div>
                        <div class="text-slate-600 text-sm sm:text-base leading-relaxed whitespace-pre-line font-medium">
                            {{ $project->description }}
                        </div>
                    </div>

                </div>

                {{-- RIGHT SIDEBAR: SUPERVISOR & TEAM WIDGETS --}}
                <div class="lg:col-span-4 space-y-8 lg:sticky lg:top-28">
                    
                    {{-- SUPERVISOR / DOSEN PEMBIMBING WIDGET --}}
                    @if($project->projectManager)
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm relative overflow-hidden">
                            <div class="flex items-center gap-2 mb-6 text-xs font-extrabold text-slate-400 uppercase tracking-widest">
                                <i data-lucide="graduation-cap" class="w-4 h-4 text-indigo-500"></i>
                                <span>Dosen Pembimbing (Manpro)</span>
                            </div>
                            
                            <div class="flex flex-col items-center text-center gap-4">
                                <div class="relative">
                                    <div class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-indigo-100 shadow-md bg-indigo-50 flex items-center justify-center">
                                        @if($project->projectManager->lecturer_image)
                                            <img src="{{ asset($project->projectManager->lecturer_image) }}" alt="{{ $project->projectManager->lecturer_name }}" 
                                                class="w-full h-full object-cover">
                                        @else
                                            <i data-lucide="user" class="w-8 h-8 text-indigo-400"></i>
                                        @endif
                                    </div>
                                </div>
                                
                                <div>
                                    <h5 class="text-lg font-extrabold text-slate-900 leading-tight mb-1">{{ $project->projectManager->lecturer_name }}</h5>
                                    <p class="text-xs font-semibold text-slate-400 mb-3">
                                        NIP/NIDN: {{ $project->projectManager->lecturer_nip ?? '-' }}
                                    </p>
                                    @if($project->projectManager->lecturer_expertise)
                                        <span class="inline-flex items-center px-3 py-1 rounded-xl bg-indigo-50 text-indigo-700 text-xs font-bold border border-indigo-100">
                                            {{ $project->projectManager->lecturer_expertise }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- DEVELOPMENT TEAM WIDGET --}}
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                        <div class="flex items-center gap-2 mb-6 text-xs font-extrabold text-slate-400 uppercase tracking-widest">
                            <i data-lucide="users" class="w-4 h-4 text-blue-600"></i>
                            <span>Tim Pengembang ({{ $project->projectMembers->count() }})</span>
                        </div>
                        
                        <div class="space-y-3">
                            @forelse($project->projectMembers as $pm)
                                <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-blue-50/50 hover:border-blue-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden shadow-2xs flex-shrink-0 bg-white border border-slate-200/60 flex items-center justify-center">
                                        @if($pm->member && $pm->member->member_image)
                                            <img src="{{ asset($pm->member->member_image) }}" alt="{{ $pm->member->member_name }}" 
                                                class="w-full h-full object-cover">
                                        @else
                                            <span class="text-xs font-extrabold text-slate-500">
                                                {{ substr($pm->member ? $pm->member->member_name : 'M', 0, 1) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-extrabold text-slate-800 text-xs sm:text-sm truncate leading-tight group-hover:text-blue-600 transition-colors">
                                            {{ $pm->member ? $pm->member->member_name : 'Anggota Tim' }}
                                        </p>
                                        <span class="inline-block px-2 py-0.5 mt-1 rounded-md text-[10px] font-bold bg-white text-slate-500 border border-slate-200/60">
                                            {{ $pm->project_member_role }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-6 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                    <p class="text-xs font-semibold text-slate-400 italic">Belum ada anggota tim terdaftar</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </section>
@endsection


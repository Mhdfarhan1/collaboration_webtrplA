@extends('layouts.app')

@section('title', $project->title . ' - Detail Project')

@section('content')
    <section class="bg-gray-50 min-h-screen pt-36 sm:pt-40 pb-16 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-4 sm:px-6 max-w-6xl">

            {{-- BACK BUTTON & BREADCRUMB --}}
            <nav class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
                <a href="{{ route('projects') }}" 
                    class="group inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full border border-slate-200/80 hover:bg-slate-50 hover:border-blue-300 transition-all duration-300 shadow-2xs">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transform group-hover:-translate-x-0.5 transition-all"></i>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-700">Kembali ke Projects</span>
                </a>
                
                <ol class="hidden sm:inline-flex items-center space-x-1.5 bg-white/90 backdrop-blur-md py-1.5 px-4 rounded-full shadow-2xs border border-slate-200/80 text-xs font-bold text-slate-500">
                    <li><a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors"><i data-lucide="home" class="w-3.5 h-3.5 text-slate-400"></i> Home</a></li>
                    <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i></li>
                    <li><a href="{{ route('projects') }}" class="inline-flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors"><i data-lucide="folder-code" class="w-3.5 h-3.5 text-slate-400"></i> Projects</a></li>
                    <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i></li>
                    <li class="text-blue-600 font-extrabold truncate max-w-[200px]">{{ $project->title }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                {{-- LEFT SIDE: MAIN HERO & CONTENT --}}
                <div class="lg:col-span-8 space-y-6">
                    
                    {{-- HEADER DETAILS CARD --}}
                    <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-xs relative overflow-hidden space-y-4">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-blue-500/10 via-cyan-400/5 to-transparent rounded-full blur-2xl -mr-16 -mt-16 pointer-events-none"></div>
                        
                        <!-- Project Title -->
                        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug tracking-tight">
                            {{ $project->title }}
                        </h1>

                        <!-- Metadata Grid -->
                        <div class="space-y-2.5 pt-1">
                            <!-- Kategori & Semester -->
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wide shrink-0 sm:w-20">Kategori:</span>
                                <div class="flex flex-wrap items-center gap-1.5">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-900 text-white text-[10px] font-bold shadow-2xs">
                                        <i data-lucide="layers" class="w-3 h-3 text-blue-400"></i>
                                        <span>Semester {{ $project->semester ?? 1 }}</span>
                                    </span>
                                    
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-600 text-white text-[10px] font-bold shadow-2xs">
                                        <i data-lucide="{{ str_contains(strtolower($project->project_type ?? ''), 'mobile') ? 'smartphone' : (str_contains(strtolower($project->project_type ?? ''), 'hardware') || str_contains(strtolower($project->project_type ?? ''), 'iot') ? 'cpu' : (str_contains(strtolower($project->project_type ?? ''), 'desktop') ? 'monitor' : 'globe')) }}" class="w-3 h-3 text-emerald-200"></i>
                                        <span>{{ $project->project_type ?? 'Web Application' }}</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Teknologi -->
                            @if($project->projectTechs->count() > 0)
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wide shrink-0 sm:w-20">Teknologi:</span>
                                    <div class="flex flex-wrap items-center gap-1.5">
                                        @foreach($project->projectTechs as $tech)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-blue-50/80 text-blue-700 text-[10px] font-extrabold uppercase border border-blue-100/80 shadow-2xs">
                                                {!! \App\Helpers\TechHelper::renderIcon($tech->tech_name) !!}
                                                <span>{{ $tech->tech_name }}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Live Demo Button if Available -->
                        @if($project->demo_url)
                            <div class="pt-2 border-t border-slate-100/80">
                                <a href="{{ $project->demo_url }}" target="_blank"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white rounded-lg font-bold text-[11px] shadow-2xs hover:shadow transition-all duration-200 active:scale-95">
                                    <i data-lucide="globe" class="w-3.5 h-3.5"></i>
                                    <span>Kunjungi Web / Live Demo</span>
                                    <i data-lucide="external-link" class="w-3 h-3"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- MAIN FEATURED IMAGE --}}
                    <div class="bg-white p-2 rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="w-full aspect-[16/9] max-h-[400px] rounded-xl overflow-hidden relative bg-slate-100 group">
                            @if($project->image_url)
                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400 gap-2">
                                    <i data-lucide="image" class="w-12 h-12 text-slate-300"></i>
                                    <span class="text-xs font-semibold text-slate-400">Tidak Ada Gambar Project</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- PROJECT DESCRIPTION --}}
                    <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-sm">
                        <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100 shadow-2xs">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900">Deskripsi Project</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Project Story & Details</p>
                            </div>
                        </div>
                        <div class="text-slate-700 text-sm leading-relaxed whitespace-pre-line font-normal">
                            {{ $project->description }}
                        </div>
                    </div>

                </div>

                {{-- RIGHT SIDEBAR: SUPERVISOR & TEAM WIDGETS --}}
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
                    
                    {{-- SUPERVISOR / DOSEN PEMBIMBING WIDGET --}}
                    @if($project->projectManager)
                        <div class="bg-white rounded-xl p-4 sm:p-5 border border-slate-200/80 shadow-xs relative overflow-hidden">
                            <div class="flex items-center gap-1.5 mb-3.5 pb-2.5 border-b border-slate-100/80 text-[10px] font-extrabold text-slate-400 uppercase tracking-wide">
                                <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-indigo-500"></i>
                                <span>Dosen Pembimbing (Manpro)</span>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden border border-indigo-100 shadow-2xs bg-indigo-50 flex items-center justify-center shrink-0">
                                        @if($project->projectManager->lecturer_image)
                                            <img src="{{ asset($project->projectManager->lecturer_image) }}" alt="{{ $project->projectManager->full_name_with_title }}" 
                                                class="w-full h-full object-cover">
                                        @else
                                            <i data-lucide="user" class="w-5 h-5 text-indigo-400"></i>
                                        @endif
                                    </div>
                                    
                                    <div class="min-w-0 flex-1">
                                        <h5 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-snug">
                                            <a href="{{ route('lecturers.detail', \App\Helpers\SecurityHelper::encode($project->projectManager->lecturer_id)) }}" class="hover:text-blue-600 transition-colors">
                                                {{ $project->projectManager->full_name_with_title }}
                                            </a>
                                        </h5>
                                        
                                        @if(!empty($project->projectManager->lecturer_nip))
                                            <p class="text-[11px] font-semibold text-slate-400 mt-0.5">
                                                NIDN/NIK: {{ $project->projectManager->lecturer_nip }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                @if(!empty($project->projectManager->lecturer_position))
                                    <div class="px-3 py-1.5 rounded-lg bg-indigo-50/80 text-indigo-800 text-[11px] font-bold border border-indigo-100/80 leading-relaxed">
                                        {{ $project->projectManager->lecturer_position }}
                                    </div>
                                @elseif(!empty($project->projectManager->lecturer_expertise))
                                    <div class="px-3 py-1.5 rounded-lg bg-indigo-50/80 text-indigo-800 text-[11px] font-bold border border-indigo-100/80 leading-relaxed">
                                        {{ $project->projectManager->lecturer_expertise }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- DEVELOPMENT TEAM WIDGET --}}
                    <div class="bg-white rounded-xl p-4 sm:p-5 border border-slate-200/80 shadow-xs">
                        <div class="flex items-center gap-1.5 mb-3.5 pb-2.5 border-b border-slate-100/80 text-[10px] font-extrabold text-slate-400 uppercase tracking-wide">
                            <i data-lucide="users" class="w-3.5 h-3.5 text-blue-600"></i>
                            <span>Tim Pengembang ({{ $project->projectMembers->count() }})</span>
                        </div>
                        
                        <div class="space-y-2.5">
                            @forelse($project->projectMembers as $pm)
                                <div class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100 hover:bg-blue-50/50 hover:border-blue-100 transition-all duration-200 group">
                                    <div class="w-9 h-9 rounded-lg overflow-hidden shadow-2xs shrink-0 bg-white border border-slate-200/60 flex items-center justify-center">
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
                                        <p class="font-bold text-slate-800 text-xs truncate leading-tight group-hover:text-blue-600 transition-colors">
                                            {{ $pm->member ? $pm->member->member_name : 'Anggota Tim' }}
                                        </p>
                                        <span class="inline-block px-1.5 py-0.5 mt-0.5 rounded text-[9px] font-bold bg-white text-slate-500 border border-slate-200/60">
                                            {{ $pm->project_member_role }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-5 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200">
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


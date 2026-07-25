@extends('layouts.app')

@section('title', $lecturer->full_name_with_title . ' - Detail Profil Dosen')

@section('content')
    @php
        $isManpro = ($lecturer->lecturer_type == 'manpro' || $lecturer->projects->count() > 0);
    @endphp

    <section class="bg-gray-50 min-h-screen pt-36 sm:pt-40 pb-20 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-4 sm:px-6 max-w-6xl">

            {{-- BACK BUTTON & BREADCRUMB --}}
            <nav class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-8">
                <a href="{{ route('lecturers') }}" 
                    class="group inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full border border-slate-200/80 hover:bg-slate-50 hover:border-blue-300 transition-all duration-300 shadow-2xs">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transform group-hover:-translate-x-0.5 transition-all"></i>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-700">Kembali ke Daftar Dosen</span>
                </a>

                <ol class="hidden sm:inline-flex items-center space-x-1.5 bg-white/90 backdrop-blur-md py-1.5 px-4 rounded-full shadow-2xs border border-slate-200/80 text-xs font-bold text-slate-500">
                    <li><a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors"><i data-lucide="home" class="w-3.5 h-3.5 text-slate-400"></i> Home</a></li>
                    <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i></li>
                    <li><a href="{{ route('lecturers') }}" class="inline-flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors"><i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-slate-400"></i> Dosen</a></li>
                    <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i></li>
                    <li class="text-blue-600 font-extrabold truncate max-w-[200px]">{{ $lecturer->full_name_with_title }}</li>
                </ol>
            </nav>

            {{-- 2-COLUMN MAIN LAYOUT --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- LEFT SIDEBAR: PROFILE CARD --}}
                <div class="lg:col-span-4 space-y-6">

                    {{-- DETAIL PROFILE CARD (EXACT MATCH FOR SCREENSHOT) --}}
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs flex flex-col items-center text-center relative overflow-hidden">
                        
                        <!-- Avatar -->
                        <div class="relative w-36 h-36 sm:w-44 sm:h-44 rounded-full overflow-hidden border-4 border-white shadow-md shrink-0 bg-slate-100 mb-6 mx-auto ring-1 ring-slate-200/80">
                            @if($lecturer->lecturer_image)
                                <img src="{{ asset($lecturer->lecturer_image) }}" alt="{{ $lecturer->full_name_with_title }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300 bg-gradient-to-br from-slate-100 to-slate-200">
                                    <i data-lucide="user" class="w-16 h-16"></i>
                                </div>
                            @endif

                            @if($isManpro)
                                <div class="absolute bottom-2 right-2 bg-amber-500 text-white p-1.5 rounded-full shadow-lg border-2 border-white" title="Manager Proyek">
                                    <i data-lucide="briefcase" class="w-3.5 h-3.5"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Name -->
                        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight mb-2 tracking-tight">
                            {{ $lecturer->full_name_with_title }}
                        </h1>

                        <!-- NIDN/NIK -->
                        @if(!empty($lecturer->lecturer_nip))
                            <p class="text-xs sm:text-sm font-extrabold text-slate-900 mb-4 tracking-wide">
                                NIDN/NIK: <span class="font-mono font-extrabold text-slate-900 tracking-wider ml-1">{{ $lecturer->lecturer_nip }}</span>
                            </p>
                        @endif

                        <!-- Tag 1: Program Studi Pill -->
                        <div class="mb-2 w-full flex justify-center">
                            <span class="inline-block px-3.5 py-1.5 rounded-full bg-slate-100 text-slate-700 font-medium text-xs text-center">
                                Teknologi Rekayasa Perangkat Lunak
                            </span>
                        </div>

                        <!-- Tag 2: Jabatan / Position Pill -->
                        <div class="mb-5 w-full flex justify-center">
                            <span class="inline-block px-4 py-2 rounded-full bg-blue-50/80 border border-blue-200/80 text-blue-600 font-semibold text-xs text-center leading-snug">
                                {{ $lecturer->lecturer_position ?? 'Dosen Pengajar TRPL' }}
                            </span>
                        </div>

                        <!-- Divider 1 -->
                        <div class="w-full h-px bg-slate-200/80 my-4"></div>

                        <!-- Action / Social Icons Row -->
                        <div class="flex items-center justify-center gap-3 w-full py-1">
                            @if($lecturer->scopus_url)
                                <a href="{{ $lecturer->scopus_url }}" target="_blank" title="Scopus Profile"
                                    class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white hover:bg-slate-50 hover:border-blue-400 text-slate-700 hover:text-blue-600 flex items-center justify-center transition-all duration-200 shadow-2xs">
                                    <i data-lucide="bookmark" class="w-4 h-4"></i>
                                </a>
                            @else
                                <div class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white text-slate-400 flex items-center justify-center shadow-2xs" title="Bookmark">
                                    <i data-lucide="bookmark" class="w-4 h-4"></i>
                                </div>
                            @endif

                            @if($lecturer->scholar_url)
                                <a href="{{ $lecturer->scholar_url }}" target="_blank" title="Google Scholar"
                                    class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white hover:bg-slate-50 hover:border-blue-400 text-slate-700 hover:text-blue-600 flex items-center justify-center transition-all duration-200 shadow-2xs">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                </a>
                            @else
                                <div class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white text-slate-400 flex items-center justify-center shadow-2xs" title="Google Scholar">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                </div>
                            @endif

                            @if($lecturer->linkedin_url)
                                <a href="{{ $lecturer->linkedin_url }}" target="_blank" title="LinkedIn"
                                    class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white hover:bg-slate-50 hover:border-blue-400 text-slate-700 hover:text-blue-600 flex items-center justify-center transition-all duration-200 shadow-2xs">
                                    <i class="fa-brands fa-linkedin-in text-sm"></i>
                                </a>
                            @endif

                            @if($lecturer->twitter_url)
                                <a href="{{ $lecturer->twitter_url }}" target="_blank" title="Twitter"
                                    class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white hover:bg-slate-50 hover:border-blue-400 text-slate-700 hover:text-blue-600 flex items-center justify-center transition-all duration-200 shadow-2xs">
                                    <i class="fa-brands fa-twitter text-sm"></i>
                                </a>
                            @endif

                            @if($lecturer->instagram_url)
                                <a href="{{ $lecturer->instagram_url }}" target="_blank" title="Instagram"
                                    class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white hover:bg-slate-50 hover:border-blue-400 text-slate-700 hover:text-blue-600 flex items-center justify-center transition-all duration-200 shadow-2xs">
                                    <i class="fa-brands fa-instagram text-sm"></i>
                                </a>
                            @endif

                            @if($lecturer->facebook_url)
                                <a href="{{ $lecturer->facebook_url }}" target="_blank" title="Facebook"
                                    class="w-10 h-10 rounded-xl border border-slate-200/90 bg-white hover:bg-slate-50 hover:border-blue-400 text-slate-700 hover:text-blue-600 flex items-center justify-center transition-all duration-200 shadow-2xs">
                                    <i class="fa-brands fa-facebook-f text-sm"></i>
                                </a>
                            @endif
                        </div>

                        <!-- Divider 2 -->
                        <div class="w-full h-px bg-slate-200/80 my-4"></div>

                        <!-- Bottom Details: Email & Keahlian -->
                        <div class="w-full space-y-3 text-left pt-1">
                            <!-- Email -->
                            <div class="flex items-center gap-3 text-slate-700 text-xs sm:text-sm font-medium min-w-0">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-500 shrink-0"></i>
                                <span class="truncate">
                                    @if($lecturer->lecturer_email)
                                        <a href="mailto:{{ $lecturer->lecturer_email }}" class="text-slate-800 hover:text-blue-600 font-medium transition-colors">
                                            {{ $lecturer->lecturer_email }}
                                        </a>
                                    @else
                                        <span class="text-slate-400 italic">Email belum diperbarui</span>
                                    @endif
                                </span>
                            </div>

                            <!-- Keahlian -->
                            <div class="flex items-start gap-3 text-slate-700 text-xs sm:text-sm font-medium">
                                <i data-lucide="bookmark" class="w-4 h-4 text-slate-500 shrink-0 mt-0.5"></i>
                                <div class="leading-relaxed">
                                    <span class="font-extrabold text-slate-900">Keahlian:</span>
                                    <span class="text-slate-600 font-medium ml-1">
                                        {{ $lecturer->lecturer_expertise ?? 'Human-Computer Software Engineering' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT MAIN COLUMN: RIWAYAT PENDIDIKAN & PROYEK BIMBINGAN --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- RIWAYAT PENDIDIKAN CARD --}}
                    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between gap-4 mb-5 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shadow-2xs">
                                    <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">Riwayat Pendidikan</h3>
                                    <p class="text-[11px] font-medium text-slate-400">Jalur akademik dan latar belakang studi</p>
                                </div>
                            </div>
                        </div>

                        @if($lecturer->education_history)
                            @php
                                $eduLines = array_values(array_filter(array_map('trim', explode("\n", $lecturer->education_history))));
                            @endphp
                            @if(!empty($eduLines))
                                <div class="relative space-y-3.5 before:absolute before:left-[9px] before:top-3 before:bottom-3 before:w-[2px] before:bg-gradient-to-b before:from-blue-500 before:via-indigo-300 before:to-slate-200">
                                    @foreach($eduLines as $index => $edu)
                                        @php
                                            $title = $edu;
                                            $subtitle = null;
                                            if (str_contains($edu, ':')) {
                                                $parts = explode(':', $edu, 2);
                                                $title = trim($parts[0]);
                                                $subtitle = trim($parts[1]);
                                            } elseif (str_contains($edu, '—')) {
                                                $parts = explode('—', $edu, 2);
                                                $title = trim($parts[0]);
                                                $subtitle = trim($parts[1]);
                                            } elseif (str_contains($edu, '|')) {
                                                $parts = explode('|', $edu, 2);
                                                $title = trim($parts[0]);
                                                $subtitle = trim($parts[1]);
                                            }

                                            $badge = null;
                                            if (preg_match('/(DIII|D3|Diploma\s*3|Diploma\s*III)/i', $title)) {
                                                $badge = 'D3';
                                            } elseif (preg_match('/(DIV|D4|Diploma\s*4|Diploma\s*IV)/i', $title)) {
                                                $badge = 'D4';
                                            } elseif (preg_match('/(S1|Sarjana)/i', $title)) {
                                                $badge = 'S1';
                                            } elseif (preg_match('/(S2|Magister)/i', $title)) {
                                                $badge = 'S2';
                                            } elseif (preg_match('/(S3|Doktor|Ph\.?D)/i', $title)) {
                                                $badge = 'S3';
                                            }
                                        @endphp
                                        <div class="relative flex items-start gap-3.5 group">
                                            <!-- Timeline Target Node Icon (20px width, center at 10px perfectly aligned with line at 9px + 1px) -->
                                            <div class="relative z-10 w-5 h-5 rounded-full bg-white border-2 border-slate-700 flex items-center justify-center shrink-0 group-hover:border-blue-600 group-hover:bg-blue-50 group-hover:scale-110 transition-all duration-300 shadow-2xs mt-1">
                                                <div class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-blue-600 transition-colors"></div>
                                            </div>

                                            <!-- Content Card (Compact) -->
                                            <div class="flex-1 min-w-0 bg-slate-50/60 hover:bg-white border border-slate-200/70 hover:border-blue-300/80 rounded-xl p-3 sm:p-3.5 transition-all duration-300 hover:shadow-sm group/card">
                                                <div class="flex flex-wrap items-center justify-between gap-1.5">
                                                    <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 group-hover/card:text-blue-600 transition-colors leading-snug">
                                                        {{ $title }}
                                                    </h4>
                                                    @if($badge)
                                                        <span class="px-2 py-0.5 text-[10px] font-extrabold tracking-wide uppercase text-slate-600 bg-white group-hover/card:bg-blue-50 group-hover/card:text-blue-700 group-hover/card:border-blue-200 border border-slate-200/80 rounded-md transition-colors shrink-0 shadow-2xs">
                                                            {{ $badge }}
                                                        </span>
                                                    @endif
                                                </div>

                                                @if($subtitle)
                                                    <div class="mt-1.5 pt-1.5 border-t border-slate-100/80 flex items-center gap-1.5 text-xs font-semibold text-slate-500 group-hover/card:text-slate-700 transition-colors">
                                                        <i data-lucide="book-open" class="w-3.5 h-3.5 text-slate-400 group-hover/card:text-blue-500 shrink-0 transition-colors"></i>
                                                        <span class="truncate">{{ $subtitle }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-6 text-center bg-slate-50/60 rounded-xl border border-dashed border-slate-200">
                                    <div class="w-8 h-8 mx-auto mb-1.5 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-400 italic">Informasi riwayat pendidikan belum diperbarui.</p>
                                </div>
                            @endif
                        @else
                            <div class="py-6 text-center bg-slate-50/60 rounded-xl border border-dashed border-slate-200">
                                <div class="w-8 h-8 mx-auto mb-1.5 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                </div>
                                <p class="text-xs font-semibold text-slate-400 italic">Informasi riwayat pendidikan belum diperbarui.</p>
                            </div>
                        @endif
                    </div>

                    {{-- PROYEK BIMBINGAN MANPRO CARD --}}
                    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-5 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shadow-2xs">
                                    <i data-lucide="folder-kanban" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">Portofolio Proyek PBL</h3>
                                    <p class="text-[11px] font-medium text-slate-400">Hasil bimbingan Project-Based Learning TRPL A Pagi 2024</p>
                                </div>
                            </div>

                            @if($lecturer->projects->count() > 0)
                                @php
                                    $availableSemesters = $lecturer->projects->pluck('semester')->filter()->unique()->sort()->values();
                                @endphp
                                <div class="flex items-center gap-2">
                                    {{-- Dropdown Filter Semester --}}
                                    @if($availableSemesters->count() > 0)
                                        <div class="relative">
                                            <select id="semester-filter-select" 
                                                    onchange="filterProjectsBySemester(this.value)"
                                                    class="appearance-none bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs font-bold py-1.5 pl-3 pr-8 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 cursor-pointer transition-colors shadow-2xs">
                                                <option value="all">Semua Semester</option>
                                                @foreach($availableSemesters as $sem)
                                                    <option value="{{ $sem }}">Semester {{ $sem }}</option>
                                                @endforeach
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-400">
                                                <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                                            </div>
                                        </div>
                                    @endif

                                    <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 text-[11px] font-bold text-amber-700 bg-amber-50/80 border border-amber-200/60 rounded-full shadow-2xs">
                                        <i data-lucide="folder-kanban" class="w-3 h-3 text-amber-600"></i>
                                        <span id="project-counter-text">{{ $lecturer->projects->count() }} Proyek</span>
                                    </span>
                                </div>
                            @endif
                        </div>

                        <style>
                            .custom-scrollbar::-webkit-scrollbar {
                                width: 5px;
                            }
                            .custom-scrollbar::-webkit-scrollbar-track {
                                background: #f8fafc;
                                border-radius: 10px;
                            }
                            .custom-scrollbar::-webkit-scrollbar-thumb {
                                background: #cbd5e1;
                                border-radius: 10px;
                            }
                            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                                background: #94a3b8;
                            }
                        </style>

                        <div class="space-y-4 max-h-[560px] overflow-y-auto pr-1.5 custom-scrollbar">
                            @forelse($lecturer->projects as $project)
                                <div class="project-item bg-slate-50/80 rounded-2xl p-4 border border-slate-200/60 hover:bg-white hover:shadow-md hover:border-blue-200 transition-all duration-300 group" data-semester="{{ $project->semester ?? 1 }}">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <!-- Project Thumbnail -->
                                        <div class="w-full sm:w-36 aspect-[16/10] sm:aspect-square rounded-xl overflow-hidden bg-slate-200 shrink-0 relative">
                                            @if($project->image_url)
                                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" 
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                    <i data-lucide="image" class="w-6 h-6"></i>
                                                </div>
                                            @endif
                                            <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-slate-900/80 text-white text-[9px] font-extrabold backdrop-blur-xs">
                                                Sem {{ $project->semester ?? 1 }}
                                            </span>
                                        </div>

                                        <!-- Project Info -->
                                        <div class="flex-1 min-w-0 flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                                    <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                        {{ $project->project_type ?? 'Web Application' }}
                                                    </span>
                                                </div>

                                                <h4 class="text-sm sm:text-base font-extrabold text-slate-900 mb-1.5 group-hover:text-blue-600 transition-colors line-clamp-1">
                                                    <a href="{{ route('projects.detail', \App\Helpers\SecurityHelper::encode($project->project_id)) }}">
                                                        {{ $project->title }}
                                                    </a>
                                                </h4>

                                                <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed mb-2.5">
                                                    {{ $project->description }}
                                                </p>

                                                <!-- Anggota Pengembang (Dev Team) -->
                                                @if($project->projectMembers && $project->projectMembers->count() > 0)
                                                    <div class="flex flex-wrap items-center gap-2 mb-3 py-1.5 px-2.5 bg-white/90 rounded-xl border border-slate-200/60 shadow-2xs">
                                                        <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider shrink-0">Tim:</span>
                                                        <div class="flex items-center -space-x-1.5 overflow-hidden">
                                                            @foreach($project->projectMembers->take(4) as $pm)
                                                                @if($pm->member && $pm->member->member_image)
                                                                    <img class="w-6 h-6 rounded-full border-2 border-white shadow-2xs object-cover shrink-0"
                                                                         style="width: 24px; height: 24px;"
                                                                         src="{{ asset($pm->member->member_image) }}" alt="{{ $pm->member->member_name }}" 
                                                                         title="{{ $pm->member->member_name }} ({{ $pm->project_member_role }})">
                                                                @else
                                                                    <div class="w-6 h-6 rounded-full border-2 border-white shadow-2xs bg-blue-100 text-blue-700 flex items-center justify-center text-[9px] font-bold shrink-0"
                                                                         style="width: 24px; height: 24px;"
                                                                         title="{{ $pm->member ? $pm->member->member_name : 'Mahasiswa' }} ({{ $pm->project_member_role }})">
                                                                        {{ substr($pm->member ? $pm->member->member_name : 'M', 0, 1) }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            @if($project->projectMembers->count() > 4)
                                                                <div class="w-6 h-6 rounded-full border-2 border-white shadow-2xs bg-slate-100 flex items-center justify-center text-[9px] font-extrabold text-slate-600 shrink-0"
                                                                     style="width: 24px; height: 24px;">
                                                                    +{{ $project->projectMembers->count() - 4 }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <span class="text-xs font-semibold text-slate-700 truncate">
                                                            {{ $project->projectMembers->map(fn($pm) => $pm->member ? $pm->member->member_name : null)->filter()->take(2)->implode(', ') }}
                                                            @if($project->projectMembers->count() > 2)
                                                                <span class="text-slate-400 font-normal">dll.</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Bottom Tech Stack & Detail Link -->
                                            <div class="flex items-center justify-between gap-2 pt-2 border-t border-slate-200/60 mt-auto">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($project->projectTechs->take(3) as $tech)
                                                        <span class="px-2 py-0.5 rounded-md bg-white text-slate-600 text-[9.5px] font-extrabold border border-slate-200/80">
                                                            {{ $tech->tech_name }}
                                                        </span>
                                                    @endforeach
                                                </div>

                                                <a href="{{ route('projects.detail', \App\Helpers\SecurityHelper::encode($project->project_id)) }}" 
                                                    class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors shrink-0">
                                                    <span>Lihat Proyek</span>
                                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3 text-slate-300">
                                        <i data-lucide="folder-open" class="w-6 h-6"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-600">Belum Ada Proyek Bimbingan</p>
                                    <p class="text-[11px] text-slate-400 mt-1">Dosen ini belum terdaftar memegang proyek mahasiswa.</p>
                                </div>
                            @endforelse

                            {{-- State jika filter semester tidak menemukan proyek --}}
                            <div id="empty-filter-state" class="hidden py-8 text-center bg-slate-50/60 rounded-2xl border border-dashed border-slate-200">
                                <div class="w-9 h-9 mx-auto mb-2 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <i data-lucide="filter-x" class="w-5 h-5"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-600">Tidak ada proyek pada semester ini</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Silakan pilih semester lain dari menu dropdown di atas.</p>
                            </div>
                        </div>
                    </div>

                    <script>
                        function filterProjectsBySemester(selectedSemester) {
                            const items = document.querySelectorAll('.project-item');
                            let count = 0;

                            items.forEach(item => {
                                const sem = item.getAttribute('data-semester');
                                if (selectedSemester === 'all' || sem === selectedSemester) {
                                    item.style.display = 'block';
                                    count++;
                                } else {
                                    item.style.display = 'none';
                                }
                            });

                            const counterText = document.getElementById('project-counter-text');
                            if (counterText) {
                                counterText.textContent = count + ' Proyek';
                            }

                            const emptyState = document.getElementById('empty-filter-state');
                            if (emptyState) {
                                if (count === 0) {
                                    emptyState.classList.remove('hidden');
                                } else {
                                    emptyState.classList.add('hidden');
                                }
                            }
                        }
                    </script>

                </div>

            </div>

        </div>
    </section>
@endsection

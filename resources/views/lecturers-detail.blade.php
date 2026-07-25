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
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs">
                        <div class="flex items-center gap-3 mb-5 pb-3 border-b border-slate-100">
                            <i data-lucide="book-marked" class="w-5 h-5 text-slate-800"></i>
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900">Riwayat Pendidikan</h3>
                        </div>

                        @if($lecturer->education_history)
                            @php
                                $eduLines = array_values(array_filter(array_map('trim', explode("\n", $lecturer->education_history))));
                            @endphp
                            <div class="relative pl-6 space-y-5 before:absolute before:left-[8px] before:top-2.5 before:bottom-2.5 before:w-[1.5px] before:bg-slate-200">
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
                                    @endphp
                                    <div class="relative group">
                                        <!-- Timeline Dot Node Icon -->
                                        <div class="absolute -left-[24.5px] top-0.5 w-[17px] h-[17px] rounded-full bg-white border-2 border-slate-700 flex items-center justify-center shadow-2xs group-hover:border-blue-600 transition-colors">
                                            <div class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-blue-600 transition-colors"></div>
                                        </div>

                                        <!-- Content -->
                                        <div>
                                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors">
                                                {{ $title }}
                                            </h4>
                                            @if($subtitle)
                                                <p class="text-xs font-semibold text-slate-500 mt-0.5">
                                                    {{ $subtitle }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-6 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                <p class="text-xs font-semibold text-slate-400 italic">Informasi riwayat pendidikan belum diperbarui.</p>
                            </div>
                        @endif
                    </div>

                    {{-- PROYEK BIMBINGAN MANPRO CARD --}}
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs">
                        <div class="flex items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 border border-amber-100 shadow-2xs">
                                    <i data-lucide="folder-kanban" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-extrabold text-slate-900">Portofolio Proyek PBL</h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Hasil Bimbingan Project-Based Learning TRPL A Pagi 2024</p>
                                </div>
                            </div>

                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-extrabold border border-amber-200/80">
                                {{ $lecturer->projects->count() }} Proyek
                            </span>
                        </div>

                        <div class="space-y-4">
                            @forelse($lecturer->projects as $project)
                                <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/60 hover:bg-white hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
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

                                                <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed mb-3">
                                                    {{ $project->description }}
                                                </p>
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
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection

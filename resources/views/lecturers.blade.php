@extends('layouts.app')

@section('title', 'Dosen Pengajar')

@section('content')
    <div class="pt-32 pb-20">
        <div class="w-[92%] max-w-7xl mx-auto">

            {{-- BREADCRUMB --}}
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1.5 sm:space-x-2 bg-white/90 backdrop-blur-md py-2.5 px-5 rounded-full shadow-2xs border border-slate-200/80 text-xs font-bold text-slate-500">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-blue-600 transition-colors group">
                            <i data-lucide="home" class="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
                    </li>
                    <li>
                        <div class="flex items-center gap-1.5 text-blue-600 font-extrabold">
                            <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-blue-600"></i>
                            <span>Dosen</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-8 reveal">
                <div class="text-center md:text-left">
                    <span class="text-brand-600 font-bold tracking-widest text-xs uppercase mb-3 block">Pendidik Kami</span>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-800 tracking-tight leading-none">
                        Dosen <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">& Manpro</span>
                    </h1>
                    <p class="text-slate-500 mt-4 text-lg max-w-xl">Kenali dosen-dosen hebat dan Manager Proyek yang membimbing kami di TRPL A Pagi.</p>
                </div>

                {{-- Search & Filter Box --}}
                <div class="w-full md:w-[500px] flex flex-col sm:flex-row gap-4">
                    <form action="{{ route('lecturers') }}" method="GET" class="flex-1 relative group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama atau keahlian..."
                            class="w-full bg-white border-2 border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-medium focus:border-brand-500 focus:ring-0 transition-all shadow-xl shadow-slate-200/50">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-brand-500 transition-colors">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                        @if(request('search'))
                            <a href="{{ route('lecturers', ['type' => request('type')]) }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-500">
                                <i data-lucide="x-circle" class="w-5 h-5"></i>
                            </a>
                        @endif
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    </form>

                    <div class="relative min-w-[200px]">
                        <select onchange="window.location.href = '{{ route('lecturers') }}?search={{ request('search') }}&type=' + this.value"
                            class="w-full appearance-none bg-white border-2 border-slate-100 rounded-2xl py-4 pl-6 pr-12 text-sm font-bold text-slate-700 focus:border-brand-500 focus:ring-0 transition-all shadow-xl shadow-slate-200/50 cursor-pointer">
                            <option value="">Semua Dosen</option>
                            <option value="manpro" {{ request('type') == 'manpro' ? 'selected' : '' }}>Hanya Manajer Proyek</option>
                            <option value="advisor" {{ request('type') == 'advisor' ? 'selected' : '' }}>Hanya Wali Dosen</option>
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">
                @forelse($lecturers as $lecturer)
                    @php
                        // Seseorang dianggap Manpro jika bertipe manpro di DB ATAU memegang proyek
                        $isManpro = ($lecturer->lecturer_type == 'manpro' || $lecturer->projects->count() > 0);
                    @endphp
                    <div class="reveal group bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-200 h-full flex flex-col transition-all hover:shadow-xl hover:shadow-slate-200/50">
                        
                        <div class="flex flex-col sm:flex-row gap-6 md:gap-8 w-full flex-grow">
                            <div class="shrink-0 flex justify-center sm:justify-start">
                                <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-slate-50 shadow-inner">
                                    @if($lecturer->lecturer_image)
                                        <img src="{{ asset($lecturer->lecturer_image) }}" alt="{{ $lecturer->lecturer_name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                            <i data-lucide="user" class="w-16 h-16"></i>
                                        </div>
                                    @endif
                                    
                                    @if($isManpro)
                                        <div class="absolute bottom-0 right-0 bg-amber-500 text-white p-1.5 rounded-full shadow-lg border-2 border-white">
                                            <i data-lucide="briefcase" class="w-3 h-3"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col flex-1 text-slate-600">
                                <div class="mb-4 text-center sm:text-left">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1 justify-center sm:justify-start flex-wrap">
                                        <h2 class="text-xl md:text-2xl font-bold text-[#2A4365] leading-tight">
                                            {{ $lecturer->lecturer_name }}{{ $lecturer->lecturer_title ? ', ' . $lecturer->lecturer_title : '' }}
                                        </h2>
                                        @if($isManpro)
                                            <span class="inline-flex items-center text-[9px] font-black uppercase tracking-widest text-amber-600 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-100 flex-shrink-0">Manager Proyek</span>
                                        @endif
                                        @if($lecturer->is_advisor)
                                            <span class="inline-flex items-center text-[9px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100 flex-shrink-0">Wali Dosen</span>
                                        @endif
                                    </div>
                                    <p class="text-[15px] font-medium text-slate-500">
                                        {{ $lecturer->lecturer_position ?? 'Dosen Pengajar' }}
                                    </p>
                                </div>

                                <div class="space-y-1.5 text-sm mb-6">
                                    <p><span class="font-bold text-slate-800">NIK :</span> {{ $lecturer->lecturer_nip ?? '-' }}</p>
                                    <p><span class="font-bold text-slate-800">Program Studi :</span> Teknologi Rekayasa Perangkat Lunak</p>
                                    <p><span class="font-bold text-slate-800">Pendidikan Terakhir :</span> {{ $lecturer->last_education ?? 'Belum Diperbarui' }}</p>
                                    <p>
                                        <span class="font-bold text-slate-800">Email :</span> 
                                        @if($lecturer->lecturer_email)
                                            <a href="mailto:{{ $lecturer->lecturer_email }}" class="text-[#5D5CDB] hover:underline transition-colors">{{ $lecturer->lecturer_email }}</a>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="mb-6">
                                    <h3 class="text-[18px] font-bold text-[#2A4365] mb-3">
                                        Riwayat Pendidikan
                                    </h3>
                                    <div class="space-y-3 text-sm text-slate-600 leading-relaxed">
                                        @if($lecturer->education_history)
                                            @foreach(explode("\n", $lecturer->education_history) as $edu)
                                                @if(trim($edu))
                                                    <p class="flex items-start gap-2">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-200 mt-1.5 flex-shrink-0"></span>
                                                        {{ trim($edu) }}
                                                    </p>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="italic text-slate-400">Informasi riwayat pendidikan belum tersedia.</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Rekam Jejak / Riwayat Manpro di TRPL A Pagi (Hanya muncul saat filter Hanya Manager Proyek aktif) --}}
                                @if(request('type') == 'manpro' && $lecturer->projects->count() > 0)
                                    <div class="mb-6 p-4 bg-gradient-to-br from-amber-50/80 to-orange-50/40 rounded-2xl border border-amber-100 shadow-2xs">
                                        <div class="flex items-center justify-between gap-2 mb-3">
                                            <h3 class="text-xs font-extrabold text-amber-900 uppercase tracking-wider flex items-center gap-1.5">
                                                <i data-lucide="folder-kanban" class="w-4 h-4 text-amber-600"></i>
                                                <span>Riwayat Manpro di TRPL A Pagi</span>
                                            </h3>
                                            <span class="text-[10px] font-extrabold text-amber-700 bg-amber-100/80 px-2.5 py-0.5 rounded-full border border-amber-200">
                                                {{ $lecturer->projects->count() }} Proyek
                                            </span>
                                        </div>

                                        <div class="space-y-2">
                                            @foreach($lecturer->projects as $project)
                                                <div class="flex items-center justify-between gap-3 bg-white p-2.5 rounded-xl border border-amber-100/80 shadow-2xs group/project transition-all hover:border-amber-300 hover:shadow-xs">
                                                    <div class="flex items-center gap-3 min-w-0 flex-1">
                                                        <div class="w-9 h-9 rounded-xl overflow-hidden shrink-0 bg-slate-100 border border-slate-200/60 shadow-2xs">
                                                            @if($project->image_url)
                                                                <img src="{{ asset($project->image_url) }}" class="w-full h-full object-cover">
                                                            @else
                                                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                                    <i data-lucide="image" class="w-4 h-4"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <a href="{{ route('projects.detail', \App\Helpers\SecurityHelper::encode($project->project_id)) }}" class="text-xs font-extrabold text-slate-800 truncate block group-hover/project:text-blue-600 transition-colors">
                                                                {{ $project->title }}
                                                            </a>
                                                            <p class="text-[10px] text-slate-400 truncate mt-0.5">
                                                                {{ Str::limit($project->description, 45) }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    {{-- Semester Badge --}}
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-100 shrink-0">
                                                        <i data-lucide="layers" class="w-3 h-3 text-blue-500"></i>
                                                        <span>Semester {{ $project->semester ?? 1 }}</span>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-auto pt-4 border-t border-slate-50">
                                    <p class="text-sm mb-5 text-slate-600">
                                        <span class="font-bold text-slate-800">Bidang Spesialis :</span> {{ $lecturer->lecturer_expertise ?? 'Umum' }}
                                    </p>

                                    <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                                        @php
                                            $socialIcons = [
                                                'twitter' => ['url' => $lecturer->twitter_url, 'icon' => 'fa-brands fa-twitter'],
                                                'facebook' => ['url' => $lecturer->facebook_url, 'icon' => 'fa-brands fa-facebook-f'],
                                                'instagram' => ['url' => $lecturer->instagram_url, 'icon' => 'fa-brands fa-instagram'],
                                                'linkedin' => ['url' => $lecturer->linkedin_url, 'icon' => 'fa-brands fa-linkedin-in'],
                                            ];
                                        @endphp

                                        @foreach($socialIcons as $key => $social)
                                            @if($social['url'])
                                                <a href="{{ $social['url'] }}" target="_blank" 
                                                   class="w-8 h-8 rounded-full bg-[#F3F4F6] flex items-center justify-center text-[#2A4365] hover:bg-[#2A4365] hover:text-white transition-all duration-300">
                                                    <i class="{{ $social['icon'] }} text-[15px]"></i>
                                                </a>
                                            @endif
                                        @endforeach

                                        @if($lecturer->scholar_url)
                                            <a href="{{ $lecturer->scholar_url }}" target="_blank" 
                                                class="w-8 h-8 rounded-full bg-[#F3F4F6] flex items-center justify-center text-[#2A4365] hover:bg-[#2A4365] hover:text-white transition-all duration-300">
                                                <i data-lucide="graduation-cap" class="w-4 h-4 text-[15px]"></i>
                                            </a>
                                        @endif

                                        @if($lecturer->scopus_url)
                                            <a href="{{ $lecturer->scopus_url }}" target="_blank" 
                                                class="w-8 h-8 rounded-full bg-[#1E5D6A] flex items-center justify-center hover:opacity-90 transition-all duration-300">
                                                <span class="text-[6px] font-black text-white tracking-widest mt-px">SCOPUS</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-2xl border-2 border-dashed border-slate-100 reveal">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="user-x" class="w-10 h-10 text-slate-300"></i>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800 mb-2">Pendidik Tidak Ditemukan</h2>
                        <p class="text-slate-500">Maaf, kami tidak dapat menemukan profil dengan kriteria tersebut.</p>
                        <a href="{{ route('lecturers') }}" class="mt-6 inline-flex items-center gap-2 text-[#5D5CDB] font-bold hover:underline">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke daftar
                        </a>
                    </div>
                @endforelse
            </div>



            @if($lecturers->hasPages())
                <div class="flex justify-center mt-10 reveal">
                    <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-slate-100">
                        {{ $lecturers->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
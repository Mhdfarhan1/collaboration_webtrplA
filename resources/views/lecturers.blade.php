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
                    <div class="reveal group bg-white rounded-3xl p-6 shadow-xs border border-slate-200/80 hover:shadow-xl hover:border-blue-300/60 transition-all duration-300 flex flex-col justify-between h-full min-w-0">
                        <div>
                            <!-- Top Row: Avatar + Main Info -->
                            <div class="flex items-start gap-4 mb-4 pb-4 border-b border-slate-100 min-w-0">
                                <!-- Avatar -->
                                <a href="{{ route('lecturers.detail', \App\Helpers\SecurityHelper::encode($lecturer->lecturer_id)) }}" 
                                    class="relative w-20 h-20 sm:w-22 sm:h-22 rounded-2xl overflow-hidden border-2 border-slate-100 shadow-xs shrink-0 bg-slate-100 group/avatar block">
                                    @if($lecturer->lecturer_image)
                                        <img src="{{ asset($lecturer->lecturer_image) }}" alt="{{ $lecturer->full_name_with_title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover/avatar:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <i data-lucide="user" class="w-10 h-10"></i>
                                        </div>
                                    @endif

                                    @if(request('type') == 'manpro' && $isManpro)
                                        <div class="absolute bottom-1 right-1 bg-amber-500 text-white p-1 rounded-full shadow-md border border-white" title="Manager Proyek">
                                            <i data-lucide="briefcase" class="w-2.5 h-2.5"></i>
                                        </div>
                                    @endif
                                </a>

                                <!-- Name, Badges & Position -->
                                <div class="min-w-0 flex-1">
                                    <h2 class="text-lg sm:text-xl font-black text-slate-900 leading-tight mb-1 line-clamp-2">
                                        <a href="{{ route('lecturers.detail', \App\Helpers\SecurityHelper::encode($lecturer->lecturer_id)) }}" class="hover:text-blue-600 transition-colors">
                                            {{ $lecturer->full_name_with_title }}
                                        </a>
                                    </h2>

                                    @if(!empty($lecturer->lecturer_nip))
                                        <p class="text-xs font-semibold text-slate-500 mb-2 flex items-center gap-1.5">
                                            <span class="text-slate-400 font-bold">NIDN/NIK:</span>
                                            <span class="font-mono font-extrabold text-slate-700 tracking-wide">{{ $lecturer->lecturer_nip }}</span>
                                        </p>
                                    @endif

                                    <div class="mb-2.5">
                                        <span class="inline-block px-3 py-1 rounded-full bg-slate-50 border border-slate-200/90 text-[11px] sm:text-xs font-bold text-slate-700 leading-normal max-w-full">
                                            {{ $lecturer->lecturer_position ?? 'Dosen Pengajar' }}
                                        </span>
                                    </div>

                                    @if(request('type') == 'manpro' || request('type') == 'advisor')
                                        <div class="flex flex-wrap items-center gap-1.5 mb-2">
                                            @if(request('type') == 'manpro' && $isManpro)
                                                <span class="inline-flex items-center gap-1 text-[9.5px] font-black uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-md border border-amber-200/80 shrink-0">
                                                    <i data-lucide="briefcase" class="w-3 h-3 text-amber-500"></i>
                                                    <span>Manager Proyek</span>
                                                </span>
                                            @endif
                                            @if(request('type') == 'advisor' && $lecturer->is_advisor)
                                                <span class="inline-flex items-center gap-1 text-[9.5px] font-black uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-md border border-emerald-200/80 shrink-0">
                                                    <i data-lucide="award" class="w-3 h-3 text-emerald-500"></i>
                                                    <span>Wali Dosen</span>
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Quick Summary List -->
                            <div class="space-y-2.5 text-xs text-slate-600 mb-5 min-w-0">
                                <div class="flex items-center gap-2 min-w-0">
                                    <span class="font-bold text-slate-400 w-24 shrink-0">Pendidikan</span>
                                    @php
                                        $lastEduDisplay = $lecturer->last_education;
                                        if ($lecturer->education_history) {
                                            $lines = array_values(array_filter(array_map('trim', explode("\n", $lecturer->education_history))));
                                            if (!empty($lines)) {
                                                $lastLine = end($lines);
                                                if ($lastEduDisplay && str_contains($lastLine, $lastEduDisplay)) {
                                                    $lastEduDisplay = str_replace(':', '—', $lastLine);
                                                } elseif (!$lastEduDisplay) {
                                                    $lastEduDisplay = str_replace(':', '—', $lastLine);
                                                }
                                            }
                                        }
                                    @endphp
                                    <span class="font-semibold text-slate-700 truncate" title="{{ $lastEduDisplay ?? 'Belum Diperbarui' }}">
                                        : {{ $lastEduDisplay ?? 'Belum Diperbarui' }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 min-w-0">
                                    <span class="font-bold text-slate-400 w-24 shrink-0">Keahlian</span>
                                    <span class="font-bold text-blue-600 truncate">: {{ $lecturer->lecturer_expertise ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Bottom: Socials & Detail Button -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 min-w-0 mt-auto">
                            <div class="flex flex-wrap gap-1.5">
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
                                           class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white transition-all duration-200">
                                            <i class="{{ $social['icon'] }} text-xs"></i>
                                        </a>
                                    @endif
                                @endforeach

                                @if($lecturer->scholar_url)
                                    <a href="{{ $lecturer->scholar_url }}" target="_blank" title="Google Scholar"
                                        class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white transition-all duration-200">
                                        <i data-lucide="graduation-cap" class="w-3.5 h-3.5"></i>
                                    </a>
                                @endif
                            </div>

                            <a href="{{ route('lecturers.detail', \App\Helpers\SecurityHelper::encode($lecturer->lecturer_id)) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-extrabold text-blue-600 bg-blue-50 border border-blue-100 hover:bg-blue-600 hover:text-white transition-all shadow-2xs group/btn shrink-0">
                                <span>Detail Profil</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-0.5"></i>
                            </a>
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
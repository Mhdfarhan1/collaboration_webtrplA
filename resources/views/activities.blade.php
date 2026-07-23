@extends('layouts.app')

@section('title', 'Activities')

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
                            <i data-lucide="activity" class="w-3.5 h-3.5 text-blue-600"></i>
                            <span>Activities</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- HEADER & SEARCH BAR --}}
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 pb-8 border-b border-slate-200/80 gap-6 reveal">
                <div>
                    <span class="text-blue-600 font-extrabold tracking-widest text-xs uppercase mb-2 block">Agenda & Dokumentasi</span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-none">
                        Class <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 bg-clip-text text-transparent">Activities</span>
                    </h1>
                    <p class="text-slate-500 mt-3 text-sm sm:text-base max-w-xl">Dokumentasi momen berharga dan agenda kegiatan seru kelas TRPL A Pagi.</p>
                </div>

                {{-- Sleek Pill Search Input --}}
                <form action="{{ route('activities') }}" method="GET" class="w-full lg:w-auto">
                    <div class="relative flex items-center bg-white rounded-full shadow-lg border border-slate-100 w-full sm:w-80 group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari agenda atau kegiatan..."
                            class="w-full py-3.5 pl-6 pr-14 text-xs font-semibold text-slate-700 placeholder:text-slate-400 focus:outline-none bg-transparent">
                        
                        @if(request('search'))
                            <a href="{{ route('activities') }}" 
                                class="absolute right-12 text-slate-400 hover:text-red-500 transition-colors" title="Hapus pencarian">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </a>
                        @endif

                        <button type="submit" 
                            class="absolute right-1.5 w-9 h-9 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center shadow-md shadow-blue-500/30 transition-all active:scale-95 shrink-0">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-12">
                @forelse($activities as $activity)
                    <div class="reveal group bg-white rounded-3xl p-5 shadow-sm border border-slate-200/80 hover:shadow-xl hover:border-blue-300 transition-all duration-500 hover:-translate-y-1.5 relative overflow-hidden flex flex-col justify-between h-full">
                        
                        
                        <div class="absolute -top-16 -right-16 w-36 h-36 bg-gradient-to-br from-blue-500/10 via-indigo-500/5 to-transparent rounded-full blur-xl pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>

                        <div class="relative z-10">
                            {{-- Image / Thumbnail Frame (Aspect 16:10 Box) --}}
                            <a href="{{ route('activities.detail', \App\Helpers\SecurityHelper::encode($activity->activity_id)) }}" class="block w-full aspect-[16/10] rounded-2xl overflow-hidden relative shadow-2xs border border-slate-100 group-hover:border-blue-200 transition-colors mb-4">
                                @if($activity->activity_image)
                                    <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    {{-- Modern Gradient Fallback Banner --}}
                                    <div class="w-full h-full bg-gradient-to-br from-blue-600 via-indigo-600 to-slate-900 flex flex-col items-center justify-center p-4 text-white text-center relative overflow-hidden">
                                        <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-1.5 shadow-inner">
                                            <i data-lucide="sparkles" class="w-5 h-5 text-cyan-300"></i>
                                        </div>
                                        <span class="text-[9px] font-black uppercase tracking-widest text-cyan-200">TRPL A Activity</span>
                                    </div>
                                @endif

                                {{-- Date Badge (Top-Left Floating) --}}
                                <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-md px-3 py-1.5 rounded-xl shadow-xs border border-white/80 flex flex-col items-center justify-center text-center">
                                    <span class="text-blue-600 text-sm font-black leading-none mb-0.5">{{ $activity->created_at->format('d') }}</span>
                                    <span class="text-[8px] font-extrabold text-slate-500 uppercase tracking-wider">{{ $activity->created_at->format('M Y') }}</span>
                                </div>

                                {{-- Photos Count Badge (Bottom-Right Floating) --}}
                                <div class="absolute bottom-3 right-3 bg-slate-900/80 backdrop-blur-md text-white px-2.5 py-1 rounded-lg text-[10px] font-extrabold flex items-center gap-1 shadow-sm border border-white/20">
                                    <i data-lucide="image" class="w-3.5 h-3.5 text-cyan-400"></i>
                                    <span>{{ $activity->activityMedia->count() }} Foto</span>
                                </div>
                            </a>

                            {{-- Content Section --}}
                            <div class="mb-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-100 mb-2.5">
                                    <i data-lucide="calendar" class="w-3 h-3 text-blue-500"></i>
                                    <span>Event Kelas</span>
                                </span>

                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors mb-2 line-clamp-2">
                                    <a href="{{ route('activities.detail', \App\Helpers\SecurityHelper::encode($activity->activity_id)) }}">
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
                            <a href="{{ route('activities.detail', \App\Helpers\SecurityHelper::encode($activity->activity_id)) }}" class="inline-flex items-center gap-1 text-[11px] font-extrabold text-blue-600 hover:text-blue-700 group-hover:translate-x-0.5 transition-transform">
                                <span>Lihat Detail</span>
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
                                        <div class="w-6 h-6 rounded-md bg-blue-600 text-white text-[8px] font-black flex items-center justify-center border-2 border-white shadow-2xs">
                                            +{{ $activity->activityMedia->count() - 3 }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200 reveal">
                        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600 border border-blue-100">
                            <i data-lucide="calendar-x" class="w-10 h-10"></i>
                        </div>
                        <h2 class="text-xl font-extrabold text-slate-800 mb-2">Kegiatan Tidak Ditemukan</h2>
                        <p class="text-slate-500 text-sm">Maaf, kami tidak dapat menemukan agenda kegiatan dengan pencarian tersebut.</p>
                        <a href="{{ route('activities') }}" class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl text-xs shadow-md hover:bg-blue-700 transition-all">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Semua Kegiatan
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if(isset($activities) && $activities->hasPages())
                <div class="flex justify-center mt-10 reveal">
                    {{ $activities->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
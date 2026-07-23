@extends('layouts.app')

@section('title', $activity->activity_name . ' - Detail Kegiatan')

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
                    <li class="inline-flex items-center">
                        <a href="{{ route('activities') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-blue-600 transition-colors">
                            <i data-lucide="activity" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span>Activities</span>
                        </a>
                    </li>
                    <li>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
                    </li>
                    <li>
                        <div class="flex items-center gap-1.5 text-blue-600 font-extrabold truncate max-w-[150px] sm:max-w-xs">
                            <span>{{ $activity->activity_name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- HEADER BOX --}}
            <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-2xs border border-slate-200/80 mb-6 relative overflow-hidden group">
                <div class="absolute -top-20 -right-20 w-48 h-48 bg-gradient-to-br from-blue-500/10 via-indigo-500/5 to-transparent rounded-full blur-2xl opacity-70 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-2.5">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-100 shadow-2xs">
                                <i data-lucide="calendar" class="w-3.5 h-3.5 text-blue-500"></i>
                                <span>{{ $activity->created_at->translatedFormat('d F Y') }}</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500"></i>
                                <span>Official Event TRPL A</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-200/60 shadow-2xs">
                                <i data-lucide="image" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>{{ $activity->activityMedia->count() }} Dokumentasi Foto</span>
                            </span>
                        </div>

                        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-snug mb-2 tracking-tight">
                            {{ $activity->activity_name }}
                        </h1>
                        <p class="text-slate-600 text-xs sm:text-sm max-w-3xl leading-relaxed font-medium">
                            {{ $activity->activity_description }}
                        </p>
                    </div>

                    <div class="shrink-0 flex items-center gap-3 w-full md:w-auto pt-3 md:pt-0 border-t md:border-t-0 border-slate-100">
                        <a href="{{ route('activities') }}" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            <span>Kembali ke Activities</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- MAIN IMAGE BANNER --}}
            @if($activity->activity_image)
                <div class="mb-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200/80 max-h-[280px] sm:max-h-[320px] bg-slate-900 relative group">
                    <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}" class="w-full h-full object-cover max-h-[280px] sm:max-h-[320px] group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white pointer-events-none">
                        <span class="text-[10px] font-black uppercase tracking-widest text-cyan-300 mb-0.5 block">Sampul Utama Kegiatan</span>
                        <h2 class="text-base sm:text-lg font-bold leading-tight truncate">{{ $activity->activity_name }}</h2>
                    </div>
                </div>
            @endif

            {{-- DOCUMENTATION PHOTO GALLERY --}}
            <div class="mb-16">
                <div class="flex items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-200/80">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                            <i data-lucide="images" class="w-5 h-5 text-blue-600"></i>
                            <span>Galeri Dokumentasi Foto</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">Dokumentasi momen kegiatan {{ $activity->activity_name }}.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">
                        {{ $activity->activityMedia->count() }} Foto
                    </span>
                </div>

                @if($activity->activityMedia->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                        @foreach($activity->activityMedia as $media)
                            <div class="group bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-2xs hover:shadow-xl hover:border-blue-300 transition-all duration-300 relative aspect-[4/3] cursor-pointer"
                                 onclick="openLightbox('{{ asset($media->activity_media_url) }}')">
                                <img src="{{ asset($media->activity_media_url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                
                                {{-- Hover Overlay --}}
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                                    <div class="w-10 h-10 rounded-full bg-white/90 text-slate-800 flex items-center justify-center shadow-md transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                        <i data-lucide="zoom-in" class="w-5 h-5"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-16 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-400">
                            <i data-lucide="image-off" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-700 mb-1">Belum Ada Dokumentasi Tambahan</h3>
                        <p class="text-xs text-slate-400">Foto dokumentasi tambahan untuk kegiatan ini belum diunggah.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- LIGHTBOX MODAL --}}
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md hidden items-center justify-center p-4" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white hover:text-slate-300 text-sm font-bold bg-white/10 hover:bg-white/20 p-2.5 rounded-full transition-all">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain border border-white/10" onclick="event.stopPropagation()">
    </div>

    <script>
        function openLightbox(src) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-modal').classList.remove('hidden');
            document.getElementById('lightbox-modal').classList.add('flex');
        }
        function closeLightbox() {
            document.getElementById('lightbox-modal').classList.add('hidden');
            document.getElementById('lightbox-modal').classList.remove('flex');
        }
    </script>
@endsection

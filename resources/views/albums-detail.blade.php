@extends('layouts.app')

@section('title', $album->album_name . ' - Galeri')

@section('content')
    {{-- SECURE BODY WRAPPER: Mencegah Klik Kanan di seluruh area galeri --}}
    <div oncontextmenu="return false;" class="select-none">

        <section class="bg-slate-50 min-h-screen pt-32 pb-20 font-sans selection:bg-brand-500 selection:text-white">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">

                {{-- BREADCRUMB --}}
                <nav class="flex mb-6 animate-fade-in-up" aria-label="Breadcrumb">
                    <ol
                        class="inline-flex items-center space-x-1 sm:space-x-2 bg-white/80 backdrop-blur-md py-2 px-4 rounded-full shadow-sm border border-slate-200/60">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center text-[11px] font-bold text-slate-500 hover:text-brand-600 transition-colors group">
                                <i data-lucide="home" class="w-3.5 h-3.5 mr-1.5"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <i data-lucide="chevron-right" class="w-3 h-3 text-slate-300 mx-1"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a href="{{ route('albums') }}"
                                class="inline-flex items-center text-[11px] font-bold text-slate-500 hover:text-brand-600 transition-colors">
                                Albums
                            </a>
                        </li>
                        <li>
                            <i data-lucide="chevron-right" class="w-3 h-3 text-slate-300 mx-1"></i>
                        </li>
                        <li>
                            <div class="flex items-center text-[11px] font-bold text-brand-600">
                                <i data-lucide="images" class="w-3.5 h-3.5 mr-1.5"></i> Detail
                            </div>
                        </li>
                    </ol>
                </nav>

                {{-- HEADER & SHARE --}}
                <div
                    class="bg-white rounded-[1.5rem] p-5 md:p-8 shadow-xl shadow-slate-200/30 border border-slate-100 mb-8 flex flex-col md:flex-row gap-6 items-start md:items-center justify-between relative overflow-hidden group">
                    {{-- Decorative Background --}}
                    <div
                        class="absolute -top-24 -right-24 w-64 h-64 bg-gradient-to-br from-brand-100/40 to-blue-50/40 rounded-full blur-3xl opacity-50 group-hover:scale-110 transition-transform duration-700 pointer-events-none">
                    </div>

                    <div class="relative z-10 flex-1">
                        <div
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-brand-50 text-brand-600 text-[10px] font-bold uppercase tracking-widest mb-3 border border-brand-100">
                            <i data-lucide="calendar" class="w-3 h-3"></i>
                            {{ $album->created_at->translatedFormat('d F Y') }}
                        </div>
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight mb-3 tracking-tight">
                            {{ $album->album_name }}
                        </h1>
                        <p class="text-slate-500 text-sm md:text-base max-w-2xl leading-relaxed font-medium">
                            {{ $album->album_description }}
                        </p>
                    </div>

                    {{-- Action Buttons (Share) --}}
                    <div
                        class="relative z-10 shrink-0 w-full md:w-auto flex items-center justify-start md:justify-end gap-3 pt-4 md:pt-0 border-t md:border-t-0 border-slate-50">
                        <button onclick="shareAction()"
                            class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-brand-600 text-white px-5 py-3 rounded-xl text-xs font-bold transition-all duration-300 shadow-lg shadow-slate-900/10 hover:shadow-brand-500/20 hover:-translate-y-0.5">
                            <i data-lucide="share-2" class="w-4 h-4"></i>
                            <span>Bagikan Album</span>
                        </button>
                    </div>
                </div>

                {{-- STATS BAR --}}
                <div class="flex items-center gap-3 mb-8 px-1 text-[11px] font-bold tracking-wide uppercase text-slate-500">
                    <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-lg shadow-sm border border-slate-200">
                        <i data-lucide="image" class="w-3.5 h-3.5 text-brand-500"></i>
                        <span>{{ $album->images->count() + ($album->album_cover ? 1 : 0) }} Photos</span>
                    </div>
                    <div class="flex items-center gap-1.5 bg-white px-3 py-1.5 rounded-lg shadow-sm border border-slate-200">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500"></i>
                        <span class="text-emerald-600">Terlindungi</span>
                    </div>
                </div>

                {{-- GALLERY GRID MAOSNRY-STYLE --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 auto-rows-max">

                    {{-- MAIN IMAGE --}}
                    @if($album->album_cover)
                        <div
                            class="group relative rounded-3xl overflow-hidden bg-slate-200 shadow-md hover:shadow-2xl transition-all duration-500 aspect-[4/5] sm:aspect-square lg:aspect-[3/4]">

                            {{-- Image Container (Mencegah drag) --}}
                            <div class="absolute inset-0 w-full h-full">
                                <img src="{{ asset($album->album_cover) }}" alt="Sampul {{ $album->album_name }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    draggable="false">
                            </div>

                            {{-- Transparent Overlay - BLOCKER DRAG & SAVE --}}
                            <div class="absolute inset-0 w-full h-full z-10 pointer-events-auto bg-transparent"></div>

                            {{-- UI Overlay Layer --}}
                            <div
                                class="absolute inset-x-0 bottom-0 top-1/2 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5 md:p-6 pointer-events-none">

                                <div
                                    class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <span
                                        class="inline-block px-2.5 py-1 bg-brand-500 text-white text-[10px] font-bold uppercase rounded-md mb-3 shadow-sm">Sampul
                                        Utama</span>

                                    {{-- Enable pointer events JUST for the button --}}
                                    <div class="pointer-events-auto mt-2">
                                        <a href="{{ asset($album->album_cover) }}"
                                            download="Sampul_{{ Str::slug($album->album_name) }}.jpg"
                                            class="inline-flex items-center justify-center w-full gap-2 bg-white/10 hover:bg-white text-white hover:text-slate-900 backdrop-blur-md px-4 py-2.5 rounded-xl text-sm font-bold border border-white/20 transition-all duration-300 group/btn">
                                            <i data-lucide="download"
                                                class="w-4 h-4 group-hover/btn:-translate-y-0.5 transition-transform"></i> Unduh
                                            Resmi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- ADDITIONAL MEDIA --}}
                    @foreach($album->images as $image)
                        @if($image->image_url !== $album->album_cover)
                            <div
                                class="group relative rounded-3xl overflow-hidden bg-slate-200 shadow-md hover:shadow-2xl transition-all duration-500 aspect-[4/5] sm:aspect-square lg:aspect-[3/4]">

                                {{-- Image Container (Mencegah drag) --}}
                                <div class="absolute inset-0 w-full h-full">
                                    <img src="{{ asset($image->image_url) }}" alt="Dokumentasi"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                        draggable="false">
                                </div>

                                {{-- Transparent Overlay - BLOCKER DRAG & SAVE --}}
                                <div class="absolute inset-0 w-full h-full z-10 pointer-events-auto bg-transparent"></div>

                                {{-- UI Overlay Layer --}}
                                <div
                                    class="absolute inset-x-0 bottom-0 top-1/2 bg-gradient-to-t from-slate-900/80 via-slate-900/40 to-transparent z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5 md:p-6 pointer-events-none">

                                    <div
                                        class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        {{-- Enable pointer events JUST for the button --}}
                                        <div class="pointer-events-auto">
                                            <a href="{{ asset($image->image_url) }}"
                                                download="Dokumentasi_{{ Str::slug($album->album_name) }}_{{ $loop->iteration }}.jpg"
                                                class="inline-flex items-center justify-center w-full gap-2 bg-white/10 hover:bg-white text-white hover:text-slate-900 backdrop-blur-md px-4 py-2.5 rounded-xl text-sm font-bold border border-white/20 transition-all duration-300 group/btn">
                                                <i data-lucide="download"
                                                    class="w-4 h-4 group-hover/btn:-translate-y-0.5 transition-transform"></i> Unduh
                                                Resmi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if(!$album->album_cover && $album->images->isEmpty())
                        <div
                            class="col-span-full bg-white rounded-[2rem] p-12 text-center border border-dashed border-slate-300">
                            <div
                                class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 mb-6 border border-slate-100 shadow-sm">
                                <i data-lucide="image-off" class="w-10 h-10 text-slate-300"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-700 mb-2">Album Kosong</h3>
                            <p class="text-slate-500">Belum ada foto dokumentasi yang diunggah untuk album ini.</p>
                        </div>
                    @endif

                </div>

            </div>
        </section>
    </div>

    {{-- TOAST NOTIFICATION FOR COPY LINK --}}
    <div id="toast"
        class="fixed bottom-5 right-5 z-50 transform translate-y-full opacity-0 transition-all duration-500 bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
        <div class="bg-emerald-500/20 text-emerald-400 p-2 rounded-full">
            <i data-lucide="check" class="w-4 h-4"></i>
        </div>
        <div>
            <p class="text-sm font-bold">Berhasil!</p>
            <p class="text-xs text-slate-300">Tautan album disalin ke clipboard.</p>
        </div>
    </div>

    @push('scripts')
        <script>
            // Mencegah select teks dan gambar secara global dalam scope container
            document.addEventListener('selectstart', function (e) {
                e.preventDefault();
            });

            // Mencegah shortcut Keyboard (Ctrl+S, Ctrl+U)
            document.addEventListener('keydown', function (e) {
                // F12, Ctrl+U (View Source), Ctrl+S (Save), Ctrl+Shift+I (DevTools)
                if (e.keyCode === 123 ||
                    (e.ctrlKey && e.keyCode === 85) ||
                    (e.ctrlKey && e.keyCode === 83) ||
                    (e.ctrlKey && e.shiftKey && e.keyCode === 73)) {
                    e.preventDefault();
                    return false;
                }
            });

            // Fitur Share
            function shareAction() {
                const url = window.location.href;
                const title = "{{ $album->album_name }} - Galeri Kelas";
                const text = "Lihat dokumentasi seru dari {{ $album->album_name }}.";

                if (navigator.share) {
                    navigator.share({
                        title: title,
                        text: text,
                        url: url
                    })
                        .catch(console.error); // Catch dismissals
                } else {
                    // Fallback: Copy to clipboard
                    navigator.clipboard.writeText(url).then(function () {
                        const toast = document.getElementById('toast');
                        toast.classList.remove('translate-y-full', 'opacity-0');

                        setTimeout(() => {
                            toast.classList.add('translate-y-full', 'opacity-0');
                        }, 3000);
                    });
                }
            }
        </script>
    @endpush
@endsection
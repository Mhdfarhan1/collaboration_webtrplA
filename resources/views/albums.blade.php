@extends('layouts.app')

@section('title', 'Galeri Kegiatan')

@section('content')
    {{-- Main Section dengan background gray-50 agar card putih/biru terlihat menonjol --}}
    <section class="bg-gray-50 min-h-screen pt-36 pb-20 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-6">

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
                            <i data-lucide="images" class="w-3.5 h-3.5 text-blue-600"></i>
                            <span>Albums</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- 2. HEADER & SEARCH --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 border-b border-gray-200 pb-6 gap-6">
                <div class="mb-2 md:mb-0 w-full md:w-auto">
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight mb-2 tracking-tight">
                        Our <span class="text-brand-600">Gallery</span>
                    </h2>
                    <p class="text-slate-500 max-w-lg text-sm md:text-base font-medium">
                        Kenangan dan dokumentasi kegiatan kami.
                    </p>
                </div>

                {{-- Search Box --}}
                <form action="{{ route('albums') }}" method="GET" class="relative w-full md:w-96 group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-brand-400 to-purple-400 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500">
                    </div>
                    <div
                        class="relative flex items-center bg-white rounded-full shadow-lg overflow-hidden border border-slate-100">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari album kegiatan..."
                            class="w-full pl-6 pr-14 py-4 text-sm font-medium text-slate-700 bg-transparent outline-none placeholder-slate-400">
                        <div class="absolute right-2 top-2 bottom-2">
                            <button type="submit"
                                class="w-10 h-10 rounded-full bg-gradient-to-tr from-brand-600 to-brand-500 text-white flex items-center justify-center shadow-md hover:shadow-brand-500/50 hover:scale-105 transition-all duration-300">
                                <i data-lucide="search" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($albums as $album)
                    <div class="group relative perspective">
                        {{-- Card Container (Ukuran diperkecil ke aspect-square) --}}
                        <div
                            class="relative aspect-square overflow-hidden rounded-[2rem] bg-white p-2 shadow-lg shadow-slate-200/50 transition-all duration-700 group-hover:-translate-y-2 group-hover:shadow-xl">

                            {{-- Image --}}
                            <div class="h-full w-full overflow-hidden rounded-[1.5rem] bg-slate-100">
                                @if ($album->album_cover)
                                    <img src="{{ asset($album->album_cover) }}" alt="{{ $album->album_name }}"
                                        class="h-full w-full object-cover transition-all duration-1000 group-hover:scale-110 grayscale group-hover:grayscale-0">
                                @else
                                    <div class="h-full w-full bg-slate-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Overlay Konten (Ukuran teks & padding diperkecil) --}}
                            <div
                                class="absolute inset-0 z-10 flex flex-col justify-end bg-gradient-to-t from-blue-900/90 via-blue-800/60 to-transparent opacity-0 transition-all duration-500 group-hover:opacity-100 px-5 pb-6 rounded-[1.5rem] m-2">

                                {{-- Judul (Kecilkan ke text-lg) --}}
                                <h3
                                    class="text-base sm:text-lg font-bold text-white leading-tight mb-3 translate-y-8 transition-all duration-500 group-hover:translate-y-0 delay-150 line-clamp-2">
                                    {{ $album->album_name }}
                                </h3>

                                {{-- Button (Dibuat lebih compact) --}}
                                <div class="translate-y-8 transition-all duration-500 group-hover:translate-y-0 delay-300">
                                    <a href="{{ route('albums.detail', \App\Helpers\SecurityHelper::encode($album->album_id)) }}"
                                        class="inline-flex items-center justify-center rounded-lg bg-white px-4 py-2 text-[10px] font-black text-blue-600 shadow-md uppercase tracking-tight hover:bg-blue-50 transition-colors w-max">
                                        View Album
                                        <svg class="w-3 h-3 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4">
                            <i data-lucide="image-off" class="w-8 h-8 text-blue-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Belum ada Album</h3>
                        <p class="text-slate-500">Galeri kegiatan kelas saat ini sedang kosong.</p>
                    </div>
                @endforelse
            </div>

            {{-- 4. PAGINATION (Style Identik dengan Members) --}}
            @if(isset($albums) && $albums->hasPages())
                <div class="mt-20 flex justify-center">
                    {{ $albums->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
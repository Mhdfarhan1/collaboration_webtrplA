@extends('layouts.app')

@section('title', 'Galeri Kegiatan')

@section('content')
    {{-- Main Section dengan background gray-50 agar card putih/biru terlihat menonjol --}}
    <section class="bg-gray-50 min-h-screen pt-36 pb-20 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-6">

            {{-- 1. BREADCRUMB (Style Identik dengan Members) --}}
            <nav class="flex mb-10" aria-label="Breadcrumb">
                <ol
                    class="inline-flex items-center space-x-2 bg-white py-3 px-6 rounded-full shadow-lg shadow-gray-200/50 border border-gray-100">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors group">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-blue-100 group-hover:text-blue-600 transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </div>
                            Home
                        </a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <span class="inline-flex items-center text-sm font-bold text-blue-600">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3 text-blue-600 shadow-sm shadow-blue-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                Albums
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- 2. HEADER & SEARCH BOX (Style Identik dengan Members) --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-gray-200 pb-8 gap-6">
                <div class="mb-2 md:mb-0 w-full md:w-auto">
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">
                        Our <span class="text-blue-600">Gallery</span>
                    </h2>
                    <p class="text-gray-500 max-w-lg text-lg">
                        Kenangan dan dokumentasi kegiatan kami.
                    </p>
                </div>

                {{-- Search Box --}}
                <div class="relative w-full md:w-96 group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500">
                    </div>
                    <div
                        class="relative flex items-center bg-white rounded-full shadow-lg overflow-hidden border border-gray-100">
                        <input type="text" placeholder="Cari album kegiatan..."
                            class="w-full pl-6 pr-14 py-4 text-sm font-medium text-gray-700 bg-transparent outline-none placeholder-gray-400">
                        <div class="absolute right-2 top-2 bottom-2">
                            <button
                                class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-blue-500 text-white flex items-center justify-center shadow-md hover:shadow-blue-500/50 hover:scale-105 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @for($i = 1; $i <= 8; $i++)
                    <div class="group relative perspective">
                        {{-- Card Container (Ukuran diperkecil ke aspect-square) --}}
                        <div
                            class="relative aspect-square overflow-hidden rounded-[2rem] bg-white p-2 shadow-lg shadow-slate-200/50 transition-all duration-700 group-hover:-translate-y-2 group-hover:shadow-xl">

                            {{-- Image --}}
                            <div class="h-full w-full overflow-hidden rounded-[1.5rem] bg-slate-100">
                                <img src="https://picsum.photos/seed/{{ $i + 500 }}/600/600" alt="Album {{ $i }}"
                                    class="h-full w-full object-cover transition-all duration-1000 group-hover:scale-110 grayscale group-hover:grayscale-0">
                            </div>

                            {{-- Overlay Konten (Ukuran teks & padding diperkecil) --}}
                            <div
                                class="absolute inset-0 z-10 flex flex-col justify-end bg-gradient-to-t from-blue-900/90 via-blue-800/20 to-transparent opacity-0 transition-all duration-500 group-hover:opacity-100 px-5 pb-6">

                                {{-- Badge --}}
                                <div class="mb-2 translate-y-8 transition-all duration-500 group-hover:translate-y-0 delay-75">
                                    <span
                                        class="text-[9px] font-black tracking-tighter text-white bg-blue-500 px-2 py-0.5 rounded-md uppercase">
                                        Event {{ $i }}
                                    </span>
                                </div>

                                {{-- Judul (Kecilkan ke text-lg) --}}
                                <h3
                                    class="text-lg font-bold text-white leading-tight mb-3 translate-y-8 transition-all duration-500 group-hover:translate-y-0 delay-150">
                                    Workshop IT {{ $i }}
                                </h3>

                                {{-- Button (Dibuat lebih compact) --}}
                                <div class="translate-y-8 transition-all duration-500 group-hover:translate-y-0 delay-300">
                                    <span
                                        class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-[10px] font-black text-blue-600 shadow-md uppercase tracking-tight">
                                        View Album
                                        <svg class="w-3 h-3 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- 4. PAGINATION (Style Identik dengan Members) --}}
            <div class="mt-20 flex justify-center">
                <nav class="flex space-x-2" aria-label="Pagination">
                    {{-- Previous --}}
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-white hover:shadow-md transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    {{-- Numbers --}}
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-500/40 font-bold transform scale-110">1</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-white hover:shadow-md transition-all">2</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-white hover:shadow-md transition-all">3</button>

                    {{-- Next --}}
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-white hover:shadow-md transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </nav>
            </div>

        </div>
    </section>
@endsection
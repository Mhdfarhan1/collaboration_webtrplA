@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')


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
                            <i data-lucide="users" class="w-3.5 h-3.5 text-blue-600"></i>
                            <span>Members</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- 2. HEADER & SEARCH BOX --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-gray-200 pb-8 gap-6">
                <div class="mb-2 md:mb-0 w-full md:w-auto">
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">
                        Our <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-600">Squad</span>
                    </h2>
                    <p class="text-gray-500 max-w-lg text-lg">
                        Kenalan dengan tim hebat di balik layar.
                    </p>
                </div>

                {{-- Search Box --}}
                <div class="relative w-full md:w-96 group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500">
                    </div>
                    <div
                        class="relative flex items-center bg-white rounded-full shadow-lg overflow-hidden border border-gray-100">
                        <form action="{{ route('members.search') }}" method="GET">
                            <input type="text" placeholder="Cari nama atau NIM..." name="q"
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
                        </form>
                    </div>
                </div>
            </div>

            {{-- 3. GRID MEMBERS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($members as $i => $member)
                    <div class="group relative cursor-pointer perspective">
                        {{-- Card Container --}}
                        <div
                            class="relative h-[450px] overflow-hidden rounded-[2rem] shadow-md bg-gray-900 transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:shadow-blue-900/30">

                            {{-- Foto Background --}}
                            @if ($member->member_image)
                                <img src="{{ asset($member->member_image) }}" alt="Foto {{ $member->member_name }}"
                                    class="w-full h-full object-cover grayscale transition-all duration-700 group-hover:grayscale-0 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($member->member_name) }}&background=0D8ABC&color=fff&size=500"
                                    alt="Avatar {{ $member->member_name }}"
                                    class="w-full h-full object-cover grayscale transition-all duration-700 group-hover:grayscale-0 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                            @endif

                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-blue-900/95 via-black/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity duration-300">
                            </div>


                            <div class="absolute top-8 right-5 z-10">
                                <div
                                    class="px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full flex items-center shadow-lg group-hover:bg-blue-600/90 transition-all duration-300">
                                    <span class="text-[11px] font-mono font-bold text-white tracking-widest uppercase">
                                        NIM : {{ $member->member_nim }}
                                    </span>
                                </div>
                            </div>


                            {{-- [BAWAH] Text Content --}}
                            <div
                                class="absolute bottom-0 left-0 w-full p-7 translate-y-8 group-hover:translate-y-0 transition-transform duration-500 ease-out z-10">

                                {{-- Role Label --}}
                                <div class="flex items-center gap-2 mb-3 opacity-80 group-hover:opacity-100">
                                    <div class="h-px w-6 {{ $member->member_is_core ? 'bg-amber-400' : 'bg-blue-400' }}"></div>
                                    <p
                                        class="{{ $member->member_is_core ? 'text-amber-300' : 'text-blue-300' }} text-[10px] font-bold tracking-[0.2em] uppercase">
                                        {{ $member->member_is_core ? 'CORE TEAM' : 'MEMBER' }}
                                    </p>
                                </div>

                                {{-- Nama --}}
                                <h3 class="text-2xl font-bold text-white mb-2 leading-tight">
                                    {{ $member->member_name }}
                                </h3>
                                <p class="text-xs text-gray-400 mb-6 font-medium">Teknik Informatika • 2024</p>

                                {{-- Divider --}}
                                <div class="h-[1px] w-full bg-gradient-to-r from-white/30 to-transparent mb-5"></div>

                                {{-- Social Media --}}
                                <div
                                    class="flex items-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100 translate-y-4 group-hover:translate-y-0">

                                    @if ($member->instagram_url)
                                        <a href="{{ $member->instagram_url }}" target="_blank"
                                            class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-gradient-to-tr hover:from-orange-500 hover:to-purple-600 hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($member->linkedin_url)
                                        <a href="{{ $member->linkedin_url }}" target="_blank"
                                            class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-blue-600 hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($member->github_url)
                                        <a href="{{ $member->github_url }}" target="_blank"
                                            class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-black hover:border-transparent hover:-translate-y-1 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- 4. PAGINATION --}}
            <div class="mt-16 flex justify-center">
                {{ $members->links() }}
            </div>

        </div>
    </section>

@endsection
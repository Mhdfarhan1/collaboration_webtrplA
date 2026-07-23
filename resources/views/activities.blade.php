@extends('layouts.app')

@section('title', 'Activities')

@section('content')
    <section class="bg-gray-50 min-h-screen pt-36 pb-20 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-6">

            {{-- BREADCRUMB --}}
            <nav class="flex mb-8 animate-fade-in-up" aria-label="Breadcrumb">
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
                    <li>
                        <div class="flex items-center text-[11px] font-bold text-brand-600">
                            <i data-lucide="activity" class="w-3.5 h-3.5 mr-1.5"></i> Activities
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- HEADER & SEARCH --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 border-b border-gray-200 pb-6 gap-6">
                <div class="mb-2 md:mb-0 w-full md:w-auto">
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight mb-2 tracking-tight">
                        Class <span class="text-brand-600">Activities</span>
                    </h2>
                    <p class="text-slate-500 max-w-lg text-sm md:text-base font-medium">
                        Informasi dan agenda kegiatan kelas kami.
                    </p>
                </div>

                {{-- Search Box --}}
                <form action="{{ route('activities') }}" method="GET" class="relative w-full md:w-96 group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-brand-400 to-purple-400 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500">
                    </div>
                    <div
                        class="relative flex items-center bg-white rounded-full shadow-lg overflow-hidden border border-slate-100">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan..."
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

            {{-- LIST OF ACTIVITIES --}}
            <div class="space-y-10">
                @forelse($activities as $activity)
                    <div
                        class="bg-white rounded-[2rem] p-6 md:p-8 flex flex-col md:flex-row gap-8 shadow-xl shadow-slate-200/40 border border-slate-100 group relative overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-brand-500/10">

                        {{-- Decorative gradient blob for hover effect --}}
                        <div
                            class="absolute -top-32 -right-32 w-64 h-64 bg-gradient-to-br from-brand-100/50 to-blue-50/50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none">
                        </div>

                        {{-- Image / Thumbnail --}}
                        <div class="w-full md:w-5/12 lg:w-1/3 shrink-0 relative z-10">
                            <div
                                class="w-full aspect-[4/3] rounded-[1.5rem] overflow-hidden bg-slate-100 relative shadow-inner">
                                @if($activity->activity_image)
                                    <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}"
                                        class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-50">
                                        <i data-lucide="image" class="w-16 h-16 text-slate-200"></i>
                                    </div>
                                @endif


                                <div
                                    class="absolute top-4 left-4 bg-white/90 backdrop-blur-md text-slate-800 text-xs font-black tracking-wider uppercase px-4 py-2 rounded-xl shadow-sm border border-white/50 flex flex-col items-center justify-center">
                                    <span
                                        class="text-brand-600 text-lg leading-none mb-0.5">{{ $activity->created_at->format('d') }}</span>
                                    <span class="text-[9px]">{{ $activity->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="w-full md:w-7/12 lg:w-2/3 flex flex-col justify-center relative z-10 py-2">

                            {{-- Category / Meta --}}
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest">
                                    <i data-lucide="folder" class="w-3 h-3"></i> Class Event
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-slate-400 text-xs font-medium">
                                    <i data-lucide="image" class="w-3.5 h-3.5"></i> {{ $activity->activityMedia->count() }}
                                    Photos
                                </span>
                            </div>

                            {{-- Title & Desc --}}
                            <h3
                                class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-4 group-hover:text-brand-600 transition-colors duration-300 tracking-tight leading-tight">
                                {{ $activity->activity_name }}
                            </h3>
                            <p class="text-slate-500 text-base md:text-lg mb-8 line-clamp-3 leading-relaxed">
                                {{ $activity->activity_description }}
                            </p>

                            {{-- Placeholder for potential detail page in the future --}}
                            <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-6">
                                <span
                                    class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest border border-blue-100">
                                    Official Event
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="bg-white rounded-[2rem] p-16 text-center border border-dashed border-slate-300 w-full max-w-2xl mx-auto">
                        <div
                            class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-50 mb-6 shadow-inner">
                            <i data-lucide="calendar-x" class="w-10 h-10 text-slate-400"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-800 mb-3 tracking-tight">Belum ada Kegiatan</h3>
                        <p class="text-slate-500 text-lg">Informasi dan agenda kegiatan belum tersedia saat ini. Silakan kembali
                            lagi nanti.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if(isset($activities) && $activities->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $activities->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
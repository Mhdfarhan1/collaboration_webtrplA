@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <section class="bg-gray-50 min-h-screen pt-36 pb-20 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-6 max-w-7xl">

            {{-- BREADCRUMB --}}
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
                                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                    </svg>
                                </div>
                                Projects
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-gray-200 pb-8 gap-6">
                <div class="mb-2 md:mb-0 w-full md:w-auto">
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">
                        Class <span class="bg-gradient-to-r from-cyan-500 to-blue-600 bg-clip-text text-transparent">Projects</span>
                    </h2>
                    <p class="text-gray-500 max-w-lg text-lg">
                        Kumpulan karya dan proyek terbaik dari mahasiswa TRPL A Pagi.
                    </p>
                </div>
            </div>

            {{-- PROJECT GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 reveal">
                @forelse($projects as $project)
                <div class="bg-white rounded-[2.5rem] p-4 flex flex-col gap-4 group hover:shadow-xl hover:shadow-brand-500/10 hover:border-brand-400/50 transition-all duration-500 hover:-translate-y-2 border border-slate-100">
                    <div class="w-full aspect-4/3 overflow-hidden rounded-4xl shadow-md relative group-hover:shadow-lg transition-all duration-500">
                        @if($project->image_url)
                            <img src="{{ asset($project->image_url) }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $project->title }}">
                        @else
                            <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        {{-- Floating Manpro Section --}}
                        @if($project->projectManager)
                            <div class="absolute top-4 left-4 z-10 flex items-center gap-2 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-2xl border border-white shadow-lg transform group-hover:-translate-y-1 transition-all duration-300">
                                <div class="w-7 h-7 rounded-full overflow-hidden border-2 border-brand-100 shadow-sm flex-shrink-0">
                                    @if($project->projectManager->lecturer_image)
                                        <img src="{{ asset($project->projectManager->lecturer_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                            <i data-lucide="user" class="w-3 h-3 text-slate-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black uppercase tracking-widest text-brand-600 leading-none">Manpro</span>
                                    <span class="text-[10px] font-bold text-slate-800 leading-tight truncate max-w-[80px]">{{ $project->projectManager->lecturer_name }}</span>
                                </div>
                            </div>
                        @endif

                        <div
                            class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ $project->demo_url ?? '#' }}" {{ $project->demo_url ? 'target="_blank"' : '' }}
                                class="px-5 py-2.5 bg-white text-slate-900 rounded-full font-bold text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:scale-105">View
                                Demo</a>
                        </div>
                    </div>

                    <div class="px-2 pb-2 flex flex-col h-full">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($project->projectTechs as $tech)
                                <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 text-[10px] font-bold uppercase border border-slate-200 inline-block">{{ $tech->tech_name }}</span>
                            @endforeach
                        </div>

                        <h3 class="text-xl font-black text-slate-800 mb-2 leading-tight group-hover:text-brand-600 transition-colors">
                            {{ $project->title }}
                        </h3>

                        <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-3 bg-white">
                            {{ $project->description }}
                        </p>

                        <div class="flex items-center gap-3 mb-4 mt-auto">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Dev Team:</span>
                            <div class="flex -space-x-2">
                                @foreach($project->projectMembers->take(3) as $pm)
                                    @if($pm->member && $pm->member->member_image)
                                        <img class="w-8 h-8 rounded-full border-2 border-white shadow-sm object-cover"
                                            src="{{ asset($pm->member->member_image) }}" alt="{{ $pm->member->member_name }}" title="{{ $pm->member->member_name }} - {{ $pm->project_member_role }}">
                                    @else
                                        <div class="w-8 h-8 rounded-full border-2 border-white shadow-sm bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-500" title="{{ $pm->member ? $pm->member->member_name : 'Member' }}">
                                            {{ substr($pm->member ? $pm->member->member_name : 'U', 0, 1) }}
                                        </div>
                                    @endif
                                @endforeach
                                
                                @if($project->projectMembers->count() > 3)
                                    <div
                                        class="w-8 h-8 rounded-full border-2 border-white shadow-sm bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600">
                                        +{{ $project->projectMembers->count() - 3 }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 mt-2">
                            <a href="{{ route('projects.detail', $project->project_id) }}"
                                class="flex items-center gap-2 text-xs font-bold text-slate-800 hover:text-brand-600 transition-colors group/link">
                                <span>Lihat Case Study</span>
                                <svg class="w-3 h-3 transform group-hover/link:translate-x-1 transition-transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-slate-500">
                        <div class="flex justify-center mb-4">
                            <svg class="w-16 h-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <p class="text-lg font-medium text-slate-600">Belum Ada Proyek</p>
                        <p class="text-sm">Proyek-proyek keren dari mahasiswa TRPL A Pagi akan segera hadir di sini.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if(isset($projects) && $projects->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection

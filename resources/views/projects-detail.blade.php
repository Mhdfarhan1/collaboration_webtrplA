@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <section class="bg-gray-50 min-h-screen pt-36 pb-20 font-sans selection:bg-brand-500 selection:text-white">
        <div class="container mx-auto px-4 max-w-5xl">

            {{-- MINIMAL BACK BUTTON & BREADCRUMB --}}
            <nav class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-10 reveal">
                <a href="{{ route('projects') }}" 
                    class="group flex items-center gap-2.5 px-5 py-2.5 bg-white/60 backdrop-blur-md rounded-2xl border border-slate-200/50 hover:bg-white hover:border-brand-500/30 transition-all duration-300 shadow-sm">
                    <i data-lucide="arrow-left" class="w-4 h-4 text-slate-400 group-hover:text-brand-600 transform group-hover:-translate-x-1 transition-all"></i>
                    <span class="text-xs font-bold text-slate-500 group-hover:text-slate-800">Back to Projects</span>
                </a>
                
                <ol class="hidden sm:inline-flex items-center space-x-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Home</a></li>
                    <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                    <li><a href="{{ route('projects') }}" class="hover:text-brand-600 transition-colors">Projects</a></li>
                    <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                    <li class="text-brand-600">{{ Str::limit($project->title, 20) }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- LEFT SIDE: HERO & MAIN CONTENT --}}
                <div class="lg:col-span-8 space-y-8">
                    
                    {{-- CINEMATIC HEADER CARD --}}
                    <div class="glass-card rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden reveal">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-500/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
                        
                        <div class="relative z-10 flex flex-col gap-6">
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->projectTechs as $tech)
                                    <span class="px-3 py-1.5 rounded-xl bg-slate-900 text-white text-[9px] font-bold uppercase tracking-widest">{{ $tech->tech_name }}</span>
                                @endforeach
                            </div>
                            
                            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 leading-[1.1] tracking-tight text-glow">
                                {{ $project->title }}
                            </h1>

                            @if($project->demo_url)
                                <div class="pt-4">
                                    <a href="{{ $project->demo_url }}" target="_blank"
                                        class="inline-flex items-center gap-3 px-8 py-4 bg-brand-600 hover:bg-brand-700 text-white rounded-2xl font-bold text-sm shadow-xl shadow-brand-500/20 hover:shadow-brand-500/40 hover:-translate-y-1 transition-all duration-300">
                                        <span>Explore Project</span>
                                        <i data-lucide="external-link" class="w-4.5 h-4.5"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- MAIN IMAGE --}}
                    <div class="reveal" style="transition-delay: 200ms">
                        <div class="group relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-200/50 border border-white">
                            @if($project->image_url)
                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" 
                                    class="w-full aspect-video object-cover transition-transform duration-1000 group-hover:scale-105">
                            @else
                                <div class="w-full aspect-video bg-slate-100 flex items-center justify-center">
                                    <i data-lucide="image" class="w-20 h-20 text-slate-200"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-linear-to-t from-slate-900/40 to-transparent"></div>
                        </div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="glass-card rounded-[2.5rem] p-8 md:p-10 reveal" style="transition-delay: 400ms">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 border border-brand-100/50 shadow-sm">
                                <i data-lucide="align-left" class="w-4.5 h-4.5"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900">Project Story</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Detailed Breakdown</p>
                            </div>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-500 leading-relaxed text-base md:text-lg">
                            {{ $project->description }}
                        </div>
                    </div>

                </div>

                {{-- RIGHT SIDE: SIDEBAR WIDGETS --}}
                <div class="lg:col-span-4 space-y-8 h-full lg:sticky lg:top-24">
                    
                    {{-- LECTURER WIDGET --}}
                    @if($project->projectManager)
                        <div class="glass-card rounded-[2.5rem] p-8 reveal" style="transition-delay: 300ms">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center gap-3">
                                <span class="w-8 h-px bg-slate-200"></span>
                                Supervisor
                            </h4>
                            
                            <div class="flex flex-col items-center text-center gap-6">
                                <div class="relative">
                                    <div class="absolute -inset-4 bg-linear-to-tr from-brand-500 to-cyan-400 rounded-full opacity-20 blur-xl"></div>
                                    @if($project->projectManager->lecturer_image)
                                        <img src="{{ asset($project->projectManager->lecturer_image) }}" alt="{{ $project->projectManager->lecturer_name }}" 
                                            class="relative w-24 h-24 rounded-3xl object-cover ring-8 ring-white shadow-2xl">
                                    @else
                                        <div class="relative w-24 h-24 rounded-3xl bg-brand-50 flex items-center justify-center text-2xl font-black text-brand-600 ring-8 ring-white shadow-2xl">
                                            {{ substr($project->projectManager->lecturer_name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="absolute bottom-2 right-2 w-6 h-6 bg-emerald-500 border-4 border-white rounded-full flex items-center justify-center shadow-lg" title="Active Member">
                                        <div class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h5 class="text-xl font-black text-slate-900 leading-tight mb-2">{{ $project->projectManager->lecturer_name }}</h5>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">
                                        NIP/NIDN: {{ $project->projectManager->lecturer_nip ?? '-' }}
                                    </p>
                                    @if($project->projectManager->lecturer_expertise)
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-xl bg-brand-50 text-brand-700 text-[10px] font-bold uppercase tracking-wider border border-brand-100/50 shadow-sm">
                                            {{ $project->projectManager->lecturer_expertise }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- TEAM WIDGET --}}
                    <div class="glass-card rounded-[2.5rem] p-8 reveal" style="transition-delay: 500ms">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center gap-3">
                            <span class="w-8 h-px bg-slate-200"></span>
                            Development Team
                        </h4>
                        
                        <div class="grid grid-cols-1 gap-4">
                            @forelse($project->projectMembers as $pm)
                                <div class="flex items-center gap-4 bg-white/40 p-3 rounded-2xl border border-white shadow-sm hover:shadow-md transition-all duration-300 group cursor-default">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                                        @if($pm->member && $pm->member->member_image)
                                            <img src="{{ asset($pm->member->member_image) }}" alt="{{ $pm->member->member_name }}" 
                                                class="w-full h-full object-cover transition-transform group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-400">
                                                {{ substr($pm->member ? $pm->member->member_name : 'U', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-800 text-sm truncate leading-tight group-hover:text-brand-600 transition-colors">{{ $pm->member ? $pm->member->member_name : 'Unknown' }}</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter mt-1">{{ $pm->project_member_role }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center bg-slate-50/50 rounded-2xl border-2 border-dashed border-slate-200">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">TBA</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </section>
@endsection

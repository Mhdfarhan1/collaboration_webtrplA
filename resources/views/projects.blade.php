@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <section class="bg-gray-50 min-h-screen pt-36 pb-20 font-sans selection:bg-blue-500 selection:text-white">
        <div class="container mx-auto px-6 max-w-7xl">

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
                            <i data-lucide="folder-code" class="w-3.5 h-3.5 text-blue-600"></i>
                            <span>Projects</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- HEADER WITH DROPDOWN FILTER & SEARCH --}}
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 border-b border-gray-200/80 pb-8 gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-2">
                        Class <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 bg-clip-text text-transparent">Projects</span>
                    </h2>
                    <p class="text-gray-500 max-w-lg text-sm sm:text-base">
                        Kumpulan karya dan proyek terbaik dari mahasiswa TRPL A Pagi.
                    </p>
                </div>

                <!-- Unified Form for Semester & Search -->
                <form action="{{ route('projects') }}" method="GET" class="w-full lg:w-auto flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <!-- Dropdown Select Filter Semester -->
                    <div class="relative w-full sm:w-64">
                        <select name="semester" onchange="this.form.submit()"
                            class="w-full appearance-none px-6 py-3.5 pr-12 bg-white border border-slate-100 shadow-lg rounded-full text-xs font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer hover:border-slate-200">
                            <option value="" {{ request('semester') == '' ? 'selected' : '' }}>
                                Semua Semester
                            </option>
                            @for ($s = 1; $s <= 8; $s++)
                                @php $countS = \App\Models\Project::where('semester', $s)->count(); @endphp
                                <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>
                                    Semester {{ $s }} ({{ $countS }} Project)
                                </option>
                            @endfor
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>

                    <!-- Sleek Pill Search Bar (Matching Mockup) -->
                    <div class="relative flex items-center bg-white rounded-full shadow-lg border border-slate-100 w-full sm:w-80 group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari karya / tech stack..."
                            class="w-full py-3.5 pl-6 pr-14 text-xs font-semibold text-slate-700 placeholder:text-slate-400 focus:outline-none bg-transparent">
                        
                        @if(request('search'))
                            <a href="{{ route('projects', array_filter(['semester' => request('semester')])) }}" 
                                class="absolute right-13 text-slate-400 hover:text-red-500 transition-colors" title="Hapus pencarian">
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

            {{-- PROJECT GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 reveal">
                @forelse($projects as $project)
                <div class="bg-white rounded-3xl p-5 flex flex-col justify-between group hover:shadow-xl hover:shadow-blue-500/10 hover:border-blue-400/60 transition-all duration-500 hover:-translate-y-1.5 border border-slate-200/80 overflow-hidden relative">
                    <div>
                        <!-- Image Container with Clean Overlay Badges -->
                        <div class="w-full aspect-[16/10] overflow-hidden rounded-2xl shadow-xs relative bg-slate-100 mb-4 group-hover:shadow-md transition-all">
                            @if($project->image_url)
                                <img src="{{ asset($project->image_url) }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="{{ $project->title }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-400">
                                    <i data-lucide="image" class="w-10 h-10"></i>
                                </div>
                            @endif

                            <!-- Floating Semester Badge (Top-Left, Clean Dark Glassmorphism) -->
                            <div class="absolute top-3 left-3 z-10 bg-slate-900/80 text-white backdrop-blur-md text-[10px] font-extrabold tracking-wider px-3 py-1 rounded-xl shadow-sm border border-white/20 flex items-center gap-1">
                                <i data-lucide="layers" class="w-3 h-3 text-blue-400"></i>
                                <span>Semester {{ $project->semester ?? 1 }}</span>
                            </div>

                            <!-- Floating Demo Link / Action (Top-Right) -->
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank"
                                    class="absolute top-3 right-3 z-10 bg-blue-600/90 hover:bg-blue-600 text-white backdrop-blur-md px-3 py-1 rounded-xl text-[10px] font-extrabold inline-flex items-center gap-1 shadow-sm border border-white/20 transition-all active:scale-95">
                                    <i data-lucide="external-link" class="w-3 h-3"></i>
                                    <span>Demo</span>
                                </a>
                            @endif
                        </div>

                        <!-- Manpro Lecturer Chip (If available) -->
                        @if($project->projectManager)
                            <div class="flex items-center gap-2 mb-3.5 px-1 bg-slate-50 p-1.5 rounded-full border border-slate-200/80 w-fit">
                                <div class="w-6 h-6 rounded-full overflow-hidden border border-indigo-200 shadow-2xs shrink-0 bg-indigo-50 flex items-center justify-center">
                                    @if($project->projectManager->lecturer_image)
                                        <img src="{{ asset($project->projectManager->lecturer_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-[10px] font-bold text-indigo-600">{{ substr($project->projectManager->lecturer_name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <p class="text-[11px] font-semibold text-slate-500 truncate pr-2">
                                    Manpro: <span class="font-bold text-slate-800">{{ $project->projectManager->lecturer_name }}</span>
                                </p>
                            </div>
                        @endif

                        <!-- Title -->
                        <h3 class="text-lg font-extrabold text-slate-800 mb-2 leading-snug group-hover:text-blue-600 transition-colors px-1 line-clamp-1">
                            {{ $project->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-slate-500 text-xs leading-relaxed line-clamp-2 mb-4 px-1">
                            {{ $project->description }}
                        </p>

                        <!-- Dev Team Avatars -->
                        <div class="flex items-center gap-2 mb-4 px-1 mt-auto">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Dev Team:</span>
                            <div class="flex -space-x-2 overflow-hidden py-0.5">
                                @foreach($project->projectMembers->take(3) as $pm)
                                    @if($pm->member && $pm->member->member_image)
                                        <img class="w-7 h-7 rounded-full border-2 border-white shadow-2xs object-cover"
                                            src="{{ asset($pm->member->member_image) }}" alt="{{ $pm->member->member_name }}" title="{{ $pm->member->member_name }} ({{ $pm->project_member_role }})">
                                    @else
                                        <div class="w-7 h-7 rounded-full border-2 border-white shadow-2xs bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600" title="{{ $pm->member ? $pm->member->member_name : 'Anggota' }}">
                                            {{ substr($pm->member ? $pm->member->member_name : 'M', 0, 1) }}
                                        </div>
                                    @endif
                                @endforeach
                                
                                @if($project->projectMembers->count() > 3)
                                    <div class="w-7 h-7 rounded-full border-2 border-white shadow-2xs bg-slate-100 flex items-center justify-center text-[9px] font-extrabold text-slate-600">
                                        +{{ $project->projectMembers->count() - 3 }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer Section: Tech Stack Badges at Bottom & Detail Link -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 px-1 mt-2">
                        <div class="flex flex-wrap gap-1.5">
                            @forelse($project->projectTechs->take(3) as $tech)
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100/90 text-slate-700 text-[10px] font-extrabold uppercase border border-slate-200/80 inline-flex items-center gap-1.5">
                                    {!! \App\Helpers\TechHelper::renderIcon($tech->tech_name) !!}
                                    {{ $tech->tech_name }}
                                </span>
                            @empty
                                <span class="text-[10px] font-medium text-slate-400 italic">Umum</span>
                            @endforelse

                            @if($project->projectTechs->count() > 3)
                                <span class="px-2 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-bold">
                                    +{{ $project->projectTechs->count() - 3 }}
                                </span>
                            @endif
                        </div>

                        <a href="{{ route('projects.detail', \App\Helpers\SecurityHelper::encode($project->project_id)) }}"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 hover:bg-blue-600 hover:text-white transition-all shadow-2xs group/btn shrink-0">
                            <span>Detail</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-0.5"></i>
                        </a>
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

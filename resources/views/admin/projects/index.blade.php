@extends('admin.layouts.app')

@section('content')
    <div class="p-2 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-4 sm:space-y-6 min-w-0 w-full overflow-hidden sm:overflow-visible">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2 text-xs sm:text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Projects</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-2xl p-4 sm:p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4 sm:gap-6 min-w-0 w-full overflow-hidden">
            <div class="space-y-1.5 min-w-0 w-full md:w-auto">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center shadow-xs border border-brand-100 shrink-0">
                        <i data-lucide="folder-code" class="w-5 h-5"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight truncate">Daftar Project</h2>
                        <p class="text-xs sm:text-sm text-slate-500 truncate">Kelola dan tampilkan karya terbaik mahasiswa.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.projects.create') }}"
                class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-4 sm:px-5 py-2.5 sm:py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-xs sm:text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95 shrink-0 whitespace-nowrap">
                <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Project</span>
            </a>
        </div>

        <!-- Filter Semester & Search Form Bar -->
        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs min-w-0 w-full">
            <form action="{{ route('admin.projects.index') }}" method="GET" class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 min-w-0 w-full">
                <!-- Semester Select Dropdown -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto flex-1">
                    <label for="admin-semester-filter" class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5 whitespace-nowrap shrink-0">
                        <i data-lucide="filter" class="w-4 h-4 text-brand-600"></i>
                        <span>Filter Semester:</span>
                    </label>
                    <div class="relative w-full sm:w-64">
                        <select id="admin-semester-filter" name="semester" onchange="this.form.submit()"
                            class="w-full appearance-none px-4 py-2.5 pr-10 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all cursor-pointer">
                            <option value="" {{ request('semester') == '' ? 'selected' : '' }}>
                                Semua Semester ({{ \App\Models\Project::count() }} Project)
                            </option>
                            @for ($s = 1; $s <= 8; $s++)
                                @php $countSem = \App\Models\Project::where('semester', $s)->count(); @endphp
                                <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>
                                    Semester {{ $s }} ({{ $countSem }} Project)
                                </option>
                            @endfor
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                <!-- Search Input Form -->
                <div class="relative w-full md:w-72">
                    @if(request('semester'))
                        <input type="hidden" name="semester" value="{{ request('semester') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul, deskripsi, tech..."
                        class="w-full pl-10 pr-9 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                    @if(request('search'))
                        <a href="{{ route('admin.projects.index', array_filter(['semester' => request('semester')])) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Container Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden min-w-0 w-full">
            <!-- Table Header info -->
            <div class="px-4 sm:px-6 py-3.5 sm:py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center min-w-0">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse shrink-0"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider truncate">
                        Total {{ $projects->total() }} Project {{ request('semester') ? '(Sem ' . request('semester') . ')' : '' }}
                    </span>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Informasi Project</th>
                            <th class="px-6 py-4">Tech Stack</th>
                            <th class="px-6 py-4">Demo / Tautan Web</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($projects as $project)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-14 flex-shrink-0 rounded-xl overflow-hidden border border-slate-200/80 shadow-xs bg-slate-50 relative group-hover:shadow-sm transition-all">
                                            @if ($project->image_url)
                                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                                                    <i data-lucide="image" class="w-6 h-6"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-base leading-snug group-hover:text-brand-600 transition-colors">{{ $project->title }}</h3>
                                            <div class="flex items-center gap-2 flex-wrap mt-1">
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200/80">
                                                    <i data-lucide="layers" class="w-3 h-3 text-blue-500"></i>
                                                    <span>Semester {{ $project->semester ?? 1 }}</span>
                                                </span>
                                                @if($project->projectManager)
                                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                        <i data-lucide="graduation-cap" class="w-3 h-3 text-indigo-500"></i>
                                                        <span>Manpro: {{ $project->projectManager->lecturer_name }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-1 max-w-sm" title="{{ $project->description }}">
                                                {{ Str::limit($project->description, 60) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="flex flex-wrap gap-1.5">
                                        @forelse ($project->projectTechs as $tech)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100/80 text-slate-700 border border-slate-200/60 shadow-2xs hover:bg-slate-200/60 transition-colors">
                                                <i data-lucide="code-2" class="w-3 h-3 text-brand-500"></i>
                                                {{ $tech->tech_name }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-slate-400 italic">Belum ada tech stack</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-brand-600 bg-brand-50 border border-brand-200/70 hover:bg-brand-600 hover:text-white transition-all duration-200 shadow-2xs group">
                                            <i data-lucide="external-link" class="w-3.5 h-3.5 transition-transform group-hover:scale-110"></i>
                                            <span>Lihat Live Demo</span>
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-400 border border-slate-200/40 italic">
                                            <i data-lucide="link-2-off" class="w-3 h-3"></i> Tautan Kosong
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.projects.members.index', $project->project_id) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-brand-700 bg-brand-50 border border-brand-200 hover:bg-brand-600 hover:text-white hover:border-brand-600 transition-all shadow-2xs"
                                            title="Kelola Anggota Tim">
                                            <i data-lucide="users" class="w-4 h-4"></i>
                                            <span>Tim</span>
                                        </a>

                                        <a href="{{ route('admin.projects.edit', $project->project_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-amber-600 bg-amber-50 border border-amber-200 hover:bg-amber-500 hover:text-white hover:border-amber-500 transition-all shadow-2xs"
                                            title="Edit Project">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.projects.destroy', $project->project_id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all shadow-2xs"
                                                title="Hapus Project">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto space-y-3">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 border border-slate-200 shadow-inner">
                                            <i data-lucide="folder-code" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="font-bold text-slate-700 text-base">Belum Ada Project</h3>
                                        <p class="text-xs text-slate-400">Silakan tambahkan data project pertama untuk mempercantik portofolio kelas Anda.</p>
                                        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-brand-600 text-white text-xs font-bold rounded-xl hover:bg-brand-700 transition-colors shadow-sm">
                                            + Tambah Project Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Stacked View -->
            <div class="md:hidden divide-y divide-slate-100 min-w-0 w-full">
                @forelse ($projects as $project)
                    <div class="p-4 sm:p-5 space-y-3 hover:bg-slate-50/50 transition-colors min-w-0 w-full">
                        <div class="flex items-start gap-3 min-w-0">
                            <div class="w-16 h-14 sm:w-20 sm:h-16 rounded-xl overflow-hidden border border-slate-200 shadow-2xs shrink-0 bg-slate-50">
                                @if ($project->image_url)
                                    <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                        <i data-lucide="image" class="w-5 h-5"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 text-sm sm:text-base leading-snug truncate">{{ $project->title }}</h3>
                                <div class="flex items-center gap-1.5 flex-wrap my-1 min-w-0">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200/80 shrink-0">
                                        <i data-lucide="layers" class="w-3 h-3 text-blue-500"></i>
                                        <span>Semester {{ $project->semester ?? 1 }}</span>
                                    </span>
                                    @if($project->projectManager)
                                        <span class="text-[10px] font-bold text-indigo-700 tracking-tight flex items-center gap-1 truncate max-w-[130px]" title="Manpro: {{ $project->projectManager->lecturer_name }}">
                                            <i data-lucide="graduation-cap" class="w-3 h-3 text-indigo-500 shrink-0"></i>
                                            <span class="truncate">{{ $project->projectManager->lecturer_name }}</span>
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">
                                    {{ Str::limit($project->description, 60) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-1">
                            @foreach ($project->projectTechs as $tech)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $tech->tech_name }}
                                </span>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-between gap-2 pt-2.5 border-t border-slate-100">
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="text-xs font-bold text-brand-600 flex items-center gap-1 hover:underline shrink-0">
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Demo
                                </a>
                            @else
                                <span class="text-xs text-slate-400 italic shrink-0">No Demo</span>
                            @endif

                            <div class="flex items-center gap-1.5 shrink-0">
                                <a href="{{ route('admin.projects.members.index', $project->project_id) }}" class="px-2.5 py-1.5 rounded-lg text-xs font-bold text-brand-700 bg-brand-50 border border-brand-200 flex items-center gap-1">
                                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                    <span>Tim</span>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project->project_id) }}" class="p-1.5 rounded-lg text-amber-600 bg-amber-50 border border-amber-200">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->project_id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-red-600 bg-red-50 border border-red-200">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-500">
                        <p class="font-medium text-slate-600 text-sm">Belum ada project</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $projects->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection

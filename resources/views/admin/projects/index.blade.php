@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-4 sm:mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 sm:mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Projects</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4 mt-6 sm:mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Project</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola data project kelas yang akan ditampilkan di halaman utama.</p>
            </div>
            <a href="{{ route('admin.projects.create') }}"
                class="w-full sm:w-auto group inline-flex justify-center items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm hover:shadow-brand-200 hover:-translate-y-0.5">
                <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Project</span>
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div
                class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            <!-- Desktop Table View (Hidden on mobile) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Project</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tech Stack</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Demo / Link</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($projects as $project)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-16 h-12 flex-shrink-0 rounded-lg overflow-hidden border border-slate-200 bg-slate-50">
                                            @if ($project->image_url)
                                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i data-lucide="image" class="w-5 h-5 text-slate-300"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $project->title }}</p>
                                            @if($project->projectManager)
                                                <p class="text-[10px] font-bold text-brand-600 uppercase tracking-tight flex items-center gap-1 mt-0.5" title="Manajer Proyek: {{ $project->projectManager->lecturer_name }}">
                                                    <i data-lucide="graduation-cap" class="w-3 h-3"></i>
                                                    Manpro: {{ $project->projectManager->lecturer_name }}
                                                </p>
                                            @endif
                                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-1 w-48"
                                                title="{{ $project->description }}">
                                                {{ Str::limit($project->description, 50) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="flex flex-wrap gap-1.5">
                                        @forelse ($project->projectTechs as $tech)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                {{ $tech->tech_name }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-slate-400 italic">Data Techstack Kosong</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    @if($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank"
                                            class="inline-flex items-center gap-1.5 text-xs font-medium text-brand-600 hover:text-brand-700 hover:underline">
                                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                            Kunjungi Web
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum Ada Tautan Demo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.projects.members.index', $project->project_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-brand-600 bg-brand-50 border border-brand-200 hover:text-white hover:bg-brand-600 hover:border-brand-600 transition-all shadow-sm tooltip"
                                            title="Kelola Tim">
                                            <i data-lucide="users" class="w-4 h-4"></i>
                                        </a>

                                        <a href="{{ route('admin.projects.edit', $project->project_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm tooltip"
                                            title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.projects.destroy', $project->project_id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus project ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-red-600 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm tooltip"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                            <i data-lucide="folder-code" class="w-8 h-8 text-slate-300"></i>
                                        </div>
                                        <p class="font-medium text-slate-600">Belum ada project</p>
                                        <p class="text-xs text-slate-400 mt-1">Mulai tambahkan daftar project kelas Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Stacked View (Hidden on desktop) -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse ($projects as $project)
                    <div class="p-4 space-y-4">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-20 h-14 rounded-lg overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 bg-slate-50 flex items-center justify-center">
                                @if ($project->image_url)
                                    <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="image" class="w-6 h-6 text-slate-400"></i>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 truncate">{{ $project->title }}</h3>
                                @if($project->projectManager)
                                    <p class="text-[9px] font-bold text-brand-600 uppercase tracking-tight flex items-center gap-1 mb-1">
                                        <i data-lucide="graduation-cap" class="w-3 h-3"></i>
                                        Manpro: {{ $project->projectManager->lecturer_name }}
                                    </p>
                                @endif
                                <p class="text-xs text-slate-500 mt-0.5 mb-2 line-clamp-2">
                                    {{ Str::limit($project->description, 80) }}
                                </p>

                                <div class="flex flex-wrap gap-1 mb-2">
                                    @foreach ($project->projectTechs->take(3) as $tech)
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ $tech->tech_name }}
                                        </span>
                                    @endforeach
                                    @if($project->projectTechs->count() > 3)
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-medium bg-slate-100 text-slate-500">
                                            +{{ $project->projectTechs->count() - 3 }}
                                        </span>
                                    @endif
                                </div>

                                @if($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank"
                                        class="inline-flex items-center gap-1 text-[10px] font-medium text-brand-600 mt-1">
                                        <i data-lucide="external-link" class="w-3 h-3"></i> Tautan Demo Web
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-end gap-2 pt-3 border-t border-slate-100">
                            <a href="{{ route('admin.projects.members.index', $project->project_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-lg text-sm font-medium text-brand-700 bg-brand-50 border border-brand-200 hover:text-white hover:bg-brand-600 active:bg-brand-700 transition-colors">
                                <i data-lucide="users" class="w-4 h-4"></i> Tim
                            </a>
                            
                            <a href="{{ route('admin.projects.edit', $project->project_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-200 hover:text-amber-600 hover:bg-amber-50 active:bg-amber-100 transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                            </a>

                            <form action="{{ route('admin.projects.destroy', $project->project_id) }}" method="POST"
                                class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-200 hover:text-red-600 hover:bg-red-50 active:bg-red-100 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                <i data-lucide="folder-code" class="w-8 h-8 text-slate-300"></i>
                            </div>
                            <p class="font-medium text-slate-600">Belum ada project</p>
                            <p class="text-xs text-slate-400 mt-1">Mulai tambahkan daftar project kelas Anda.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Controls -->
            @if($projects->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $projects->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
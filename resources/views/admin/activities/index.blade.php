@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i> Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Kegiatan</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="activity" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Kegiatan</h2>
                        <p class="text-sm text-slate-500">Kelola dokumentasi acara dan kegiatan seputar kelas TRPL A Pagi.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.activities.create') }}" class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                <i data-lucide="plus" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Kegiatan</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <!-- Table Header Info -->
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total {{ $activities->total() }} Kegiatan</span>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Informasi Kegiatan</th>
                            <th class="px-6 py-4 text-center">Status Galeri</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($activities as $activity)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-14 flex-shrink-0 rounded-xl overflow-hidden border border-slate-200/80 shadow-xs bg-slate-50 relative group-hover:shadow-sm transition-all">
                                            @if ($activity->activity_image)
                                                <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                                                    <i data-lucide="image" class="w-6 h-6"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-slate-800 text-base leading-snug group-hover:text-purple-600 transition-colors">{{ $activity->activity_name }}</h3>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-1 max-w-md" title="{{ $activity->activity_description }}">
                                                {{ $activity->activity_description }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/80 shadow-2xs">
                                        <i data-lucide="images" class="w-3.5 h-3.5 text-indigo-500"></i>
                                        <span>{{ $activity->activityMedia->count() }} Foto</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.activities.media.index', $activity->activity_id) }}" 
                                            class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-brand-700 bg-brand-50 border border-brand-200 hover:bg-brand-600 hover:text-white transition-all shadow-2xs" title="Kelola Galeri Foto">
                                            <i data-lucide="images" class="w-4 h-4"></i> Galeri
                                        </a>

                                        <a href="{{ route('admin.activities.edit', $activity->activity_id) }}" 
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-amber-600 bg-amber-50 border border-amber-200 hover:bg-amber-500 hover:text-white transition-all shadow-2xs" title="Edit Kegiatan">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.activities.destroy', $activity->activity_id) }}" method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-all shadow-2xs" title="Hapus Kegiatan">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-16 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto space-y-3">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 border border-slate-200 shadow-inner">
                                            <i data-lucide="activity" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="font-bold text-slate-700 text-base">Belum Ada Kegiatan</h3>
                                        <p class="text-xs text-slate-400">Mulai tambahkan dokumentasi kegiatan kelas Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse ($activities as $activity)
                    <div class="p-5 space-y-4 bg-white hover:bg-slate-50/50 transition-colors">
                        <div class="flex gap-4">
                            <div class="w-20 h-16 rounded-xl overflow-hidden border border-slate-200 shadow-xs flex-shrink-0 bg-slate-50">
                                @if ($activity->activity_image)
                                    <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400"><i data-lucide="image" class="w-6 h-6"></i></div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 text-base leading-snug truncate">{{ $activity->activity_name }}</h3>
                                <p class="text-xs text-slate-500 line-clamp-2 mt-0.5">
                                    {{ Str::limit($activity->activity_description, 80) }}
                                </p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        <i data-lucide="image" class="w-3 h-3"></i> {{ $activity->activityMedia->count() }} Foto
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-2 pt-3 border-t border-slate-100">
                            <a href="{{ route('admin.activities.media.index', $activity->activity_id) }}" class="col-span-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-xl text-xs font-bold text-brand-700 bg-brand-50 border border-brand-200 hover:bg-brand-600 hover:text-white transition-colors">
                                <i data-lucide="images" class="w-3.5 h-3.5"></i> Galeri
                            </a>
                            <a href="{{ route('admin.activities.edit', $activity->activity_id) }}" class="col-span-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-xl text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 hover:bg-amber-600 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Edit
                            </a>
                            <form action="{{ route('admin.activities.destroy', $activity->activity_id) }}" method="POST" class="col-span-1 delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl text-xs font-bold text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-colors">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">
                        <p class="font-medium text-slate-600">Belum ada kegiatan</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($activities->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection


@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-4 sm:mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 sm:mr-2"></i> Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Kegiatan</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4 mt-6 sm:mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Kegiatan</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola data informasi dan dokumentasi kegiatan kelas Anda.</p>
            </div>
            <a href="{{ route('admin.activities.create') }}" class="w-full sm:w-auto group inline-flex justify-center items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm hover:shadow-brand-200">
                <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Kegiatan</span>
            </a>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Info Kegiatan</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status Galeri</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($activities as $activity)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-4">
                                        <div class="w-20 h-16 flex-shrink-0 rounded-lg overflow-hidden border border-slate-200 bg-slate-50">
                                            @if ($activity->activity_image)
                                                <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i data-lucide="image" class="w-5 h-5 text-slate-300"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0 py-1">
                                            <p class="font-bold text-slate-800 text-base mb-1 truncate">{{ $activity->activity_name }}</p>
                                            <p class="text-xs text-slate-500 line-clamp-2 w-72" title="{{ $activity->activity_description }}">
                                                {{ $activity->activity_description }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                            {{ $activity->activityMedia->count() }} Foto
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.activities.media.index', $activity->activity_id) }}" 
                                            class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg text-xs font-medium text-brand-700 bg-brand-50 border border-brand-200 hover:text-white hover:bg-brand-600 transition-all shadow-sm tooltip" title="Kelola Galeri">
                                            <i data-lucide="images" class="w-4 h-4"></i> Galeri
                                        </a>

                                        <a href="{{ route('admin.activities.edit', $activity->activity_id) }}" 
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm tooltip" title="Edit Data">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.activities.destroy', $activity->activity_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Menghapus kegiatan ini juga akan menghapus semua foto di galerinya. Anda yakin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-red-600 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm tooltip" title="Hapus Kegiatan">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                            <i data-lucide="activity" class="w-8 h-8 text-slate-300"></i>
                                        </div>
                                        <p class="font-medium text-slate-600">Belum ada kegiatan</p>
                                        <p class="text-xs text-slate-400 mt-1">Mulai tambahkan dokumentasi kegiatan kelas Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Stacked View -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse ($activities as $activity)
                    <div class="p-4 space-y-4 bg-white">
                        <div class="flex gap-4">
                            <div class="w-24 h-20 rounded-lg overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 bg-slate-50">
                                @if ($activity->activity_image)
                                    <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"><i data-lucide="image" class="w-6 h-6 text-slate-400"></i></div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 text-sm mb-1 leading-tight">{{ $activity->activity_name }}</h3>
                                <p class="text-xs text-slate-500 line-clamp-2 mb-2">
                                    {{ Str::limit($activity->activity_description, 80) }}
                                </p>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-indigo-50 text-indigo-700">
                                    <i data-lucide="image" class="w-3 h-3"></i> {{ $activity->activityMedia->count() }} Foto
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-slate-50">
                            <a href="{{ route('admin.activities.media.index', $activity->activity_id) }}" class="col-span-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold text-brand-700 bg-brand-50 border border-brand-200 hover:bg-brand-600 hover:text-white transition-colors">
                                <i data-lucide="images" class="w-3.5 h-3.5"></i> Galeri
                            </a>
                            <a href="{{ route('admin.activities.edit', $activity->activity_id) }}" class="col-span-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold text-slate-600 bg-white border border-slate-200 hover:text-amber-600 hover:bg-amber-50 transition-colors">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Edit
                            </a>
                            <form action="{{ route('admin.activities.destroy', $activity->activity_id) }}" method="POST" class="col-span-1" onsubmit="return confirm('Yakin ingin menghapus ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold text-slate-600 bg-white border border-slate-200 hover:text-red-600 hover:bg-red-50 transition-colors">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                <i data-lucide="activity" class="w-8 h-8 text-slate-300"></i>
                            </div>
                            <p class="font-medium text-slate-600">Belum ada kegiatan</p>
                            <p class="text-xs text-slate-400 mt-1">Mulai tambahkan kegiatan kelas Anda.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Controls -->
            @if($activities->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

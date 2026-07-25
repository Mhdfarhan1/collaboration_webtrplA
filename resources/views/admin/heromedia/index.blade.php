@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i> Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Hero Banners</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="layout-template" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Hero Banners</h2>
                        <p class="text-sm text-slate-500">Kelola gambar spanduk utama yang tampil di beranda aplikasi.</p>
                    </div>
                </div>
            </div>
            @if(!$hasBanner)
                <a href="{{ route('admin.heromedia.create') }}"
                    class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                    <i data-lucide="plus" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                    <span>Tambah Banner Baru</span>
                </a>
            @else
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-amber-50 text-amber-800 text-xs font-extrabold border border-amber-200/80 shadow-2xs">
                        <i data-lucide="shield-check" class="w-4 h-4 text-amber-600"></i>
                        <span>Banner Sudah Diatur (Hanya Bisa Update)</span>
                    </span>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <!-- Table Header Info -->
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total {{ $heroMedias->total() }} Banner</span>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">#ID</th>
                            <th class="px-6 py-4">Visual Banner</th>
                            <th class="px-6 py-4">Judul & Tanggal</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($heroMedias as $hm)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/60">
                                        #{{ str_pad($hm->hero_media_id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="relative w-40 h-24 rounded-xl overflow-hidden shadow-xs border border-slate-200/80 group-hover:border-blue-300 transition-all bg-slate-100">
                                        <img src="{{ asset($hm->image_url) }}" alt="{{ $hm->hero_title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col space-y-1">
                                        <h3 class="text-base font-bold text-slate-800 group-hover:text-brand-600 transition-colors line-clamp-2 max-w-md">{{ $hm->hero_title }}</h3>
                                        <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                            <i data-lucide="calendar" class="w-3 h-3 text-slate-400"></i>
                                            Dibuat: {{ $hm->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.heromedia.edit', $hm->hero_media_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-amber-600 bg-amber-50 border border-amber-200 hover:bg-amber-500 hover:text-white transition-all shadow-2xs"
                                            title="Edit Banner">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.heromedia.destroy', $hm->hero_media_id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-all shadow-2xs"
                                                title="Hapus Banner">
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
                                            <i data-lucide="image-off" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="font-bold text-slate-700 text-base">Belum Ada Banner</h3>
                                        <p class="text-xs text-slate-400">Tambahkan banner utama untuk mempercantik beranda web kelas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse ($heroMedias as $hm)
                    <div class="p-5 space-y-4 hover:bg-slate-50/50 transition-colors">
                        <div class="flex gap-4">
                            <div class="w-24 h-18 shrink-0 rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-100">
                                <img src="{{ asset($hm->image_url) }}" alt="{{ $hm->hero_title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-bold text-slate-800 line-clamp-2 leading-snug">{{ $hm->hero_title }}</h3>
                                <p class="text-xs text-slate-400 mt-1 font-mono">#{{ str_pad($hm->hero_media_id, 3, '0', STR_PAD_LEFT) }} &bull; {{ $hm->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                            <a href="{{ route('admin.heromedia.edit', $hm->hero_media_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-xl text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 hover:bg-amber-600 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                            </a>

                            <form action="{{ route('admin.heromedia.destroy', $hm->hero_media_id) }}" method="POST" class="flex-1 delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 py-2 rounded-xl text-xs font-bold text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">
                        <p class="font-medium text-slate-600">Belum Ada Banner</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($heroMedias->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $heroMedias->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

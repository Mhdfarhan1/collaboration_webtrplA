@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Galeri Kelas</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="images" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Koleksi Album Foto</h2>
                        <p class="text-sm text-slate-500">Kelola album foto momen kebersamaan dan kenangan kelas TRPL A Pagi.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.albums.create') }}"
                class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                <i data-lucide="plus" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Album Baru</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <!-- Table Header Info -->
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total {{ $albums->count() }} Album Foto</span>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Informasi Album</th>
                            <th class="px-6 py-4 text-center">Jumlah Dokumentasi</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($albums as $album)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-14 rounded-xl overflow-hidden border border-slate-200/80 shadow-xs flex-shrink-0 bg-slate-100 relative group-hover:shadow-sm transition-all">
                                            @if ($album->album_cover)
                                                <img src="{{ asset($album->album_cover) }}" alt="{{ $album->album_name }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                                                    <i data-lucide="image" class="w-6 h-6"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-base leading-snug group-hover:text-brand-600 transition-colors">{{ $album->album_name }}</h3>
                                            <p class="text-xs text-slate-400 mt-1 font-medium flex items-center gap-1">
                                                <i data-lucide="calendar" class="w-3 h-3 text-slate-400"></i>
                                                <span>{{ $album->created_at->format('d M Y') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200/80 shadow-2xs">
                                        <i data-lucide="camera" class="w-3.5 h-3.5 text-blue-500"></i>
                                        <span>{{ $album->images->count() }} Foto</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.albums.images.index', $album->album_id) }}"
                                            class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl text-brand-700 bg-brand-50 border border-brand-200 hover:bg-brand-600 hover:text-white transition-all text-xs font-bold shadow-2xs"
                                            title="Kelola Foto Album">
                                            <i data-lucide="images" class="w-4 h-4"></i>
                                            <span>Kelola Foto</span>
                                        </a>

                                        <a href="{{ route('admin.albums.edit', $album->album_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-amber-600 bg-amber-50 border border-amber-200 hover:bg-amber-500 hover:text-white transition-all shadow-2xs"
                                            title="Edit Nama/Deskripsi Album">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.albums.destroy', $album->album_id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-all shadow-2xs"
                                                title="Hapus Album">
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
                                            <i data-lucide="images" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="font-bold text-slate-700 text-base">Belum Ada Album Foto</h3>
                                        <p class="text-xs text-slate-400">Buat album baru untuk menyimpan dokumentasi kenangan kelas Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


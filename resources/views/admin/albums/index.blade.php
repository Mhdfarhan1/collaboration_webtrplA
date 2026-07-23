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
                        <span class="text-slate-700 font-semibold">Galeri Kelas</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4 mt-6 sm:mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Koleksi Album</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola album foto kegiatan dan momen kelas TRPL A Pagi.</p>
            </div>
            <a href="{{ route('admin.albums.create') }}"
                class="w-full sm:w-auto group inline-flex justify-center items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm hover:shadow-brand-200 hover:-translate-y-0.5">
                <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Album</span>
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
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Album</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Jumlah Foto</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($albums as $album)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-12 rounded-lg overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 bg-slate-100">
                                            @if ($album->album_cover)
                                                <img src="{{ asset($album->album_cover) }}" alt="{{ $album->album_name }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <i data-lucide="image" class="w-6 h-6"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $album->album_name }}</p>
                                            <p class="text-xs text-slate-500 line-clamp-1 italic">{{ $album->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $album->images->count() }} Foto
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.albums.images.index', $album->album_id) }}"
                                            class="inline-flex items-center justify-center gap-2 px-3 py-1.5 rounded-lg text-brand-600 bg-brand-50 border border-brand-100 hover:bg-brand-100 transition-all text-xs font-bold"
                                            title="Kelola Gallery">
                                            <i data-lucide="images" class="w-4 h-4"></i>
                                            Kelola Foto
                                        </a>

                                        <a href="{{ route('admin.albums.edit', $album->album_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-brand-600 hover:bg-brand-50 transition-all shadow-sm"
                                            title="Edit Album">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.albums.destroy', $album->album_id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini beserta seluruh fotonya?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-red-600 hover:bg-red-50 transition-all shadow-sm"
                                                title="Hapus Album">
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
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3 text-slate-300">
                                            <i data-lucide="images" class="w-8 h-8"></i>
                                        </div>
                                        <p class="font-medium">Belum ada album foto</p>
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

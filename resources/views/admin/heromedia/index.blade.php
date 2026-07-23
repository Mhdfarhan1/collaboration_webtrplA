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
                        <span class="text-slate-700 font-semibold">Hero Banners</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4 mt-6 sm:mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Hero Banners</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola gambar utama yang tampil di beranda aplikasi Anda.</p>
            </div>
            <a href="{{ route('admin.heromedia.create') }}"
                class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm hover:shadow-brand-200 sm:hover:-translate-y-0.5">
                <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Banner Baru</span>
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div
                class="mb-6 px-4 py-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl flex items-center gap-3 animate-fade-in-down">
                <div class="bg-emerald-100 p-1.5 rounded-lg text-emerald-600 flex-shrink-0">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                </div>
                <p class="font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Data Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden transition-all hover:shadow-md">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">#ID</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Visual</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Informasi Banner
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">
                                Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($heroMedias as $hm)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-5 text-sm font-semibold text-slate-500">
                                    #{{ str_pad($hm->hero_media_id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-5">
                                    <div
                                        class="relative w-40 h-24 rounded-xl overflow-hidden shadow-sm border border-slate-200 group-hover:shadow-md transition-all">
                                        <img src="{{ asset($hm->image_url) }}" alt="{{ $hm->hero_title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-base font-bold text-slate-800 break-words whitespace-normal line-clamp-2 max-w-sm">{{ $hm->hero_title }}</span>
                                        <span class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                            <i data-lucide="calendar" class="w-3 h-3"></i>
                                            Dibuat: {{ $hm->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.heromedia.edit', $hm->hero_media_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-brand-600 hover:bg-brand-50 hover:border-brand-200 transition-all shadow-sm tooltip"
                                            title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.heromedia.destroy', $hm->hero_media_id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus banner ini?');">
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
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center">
                                            <i data-lucide="image-off" class="w-8 h-8 text-slate-300"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-600">Belum Ada Banner</p>
                                        <p class="text-xs text-slate-400 max-w-sm whitespace-normal">Mulai dengan menambahkan
                                            hero banner pertama Anda untuk ditampilkan di halaman beranda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Stacked View -->
            <div class="block md:hidden divide-y divide-slate-100">
                @forelse ($heroMedias as $hm)
                    <div class="p-4 space-y-4 hover:bg-slate-50/50 transition-colors">
                        <div class="flex justify-between items-start gap-4">
                            <div
                                class="relative w-24 h-16 sm:w-32 sm:h-20 shrink-0 rounded-lg overflow-hidden border border-slate-200 shadow-sm">
                                <img src="{{ asset($hm->image_url) }}" alt="{{ $hm->hero_title }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold text-slate-800 line-clamp-2 leading-snug">{{ $hm->hero_title }}
                                </h3>
                                <div class="mt-1 flex items-center gap-2 text-xs text-slate-500">
                                    <span
                                        class="font-semibold text-slate-600">#{{ str_pad($hm->hero_media_id, 3, '0', STR_PAD_LEFT) }}</span>
                                    <span>&bull;</span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="calendar" class="w-3 h-3"></i>
                                        {{ $hm->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-50">
                            <a href="{{ route('admin.heromedia.edit', $hm->hero_media_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-200 hover:text-brand-600 hover:bg-brand-50 active:bg-brand-100 transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                            </a>

                            <form action="{{ route('admin.heromedia.destroy', $hm->hero_media_id) }}" method="POST"
                                class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?');">
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
                    <div class="px-4 py-10 text-center text-slate-500">
                        <div class="inline-flex w-12 h-12 bg-slate-50 rounded-full items-center justify-center mb-3">
                            <i data-lucide="image-off" class="w-6 h-6 text-slate-300"></i>
                        </div>
                        <p class="text-sm font-medium text-slate-600">Belum Ada Banner</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($heroMedias->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $heroMedias->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Add subtle fade in animation */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out;
        }
    </style>
@endsection
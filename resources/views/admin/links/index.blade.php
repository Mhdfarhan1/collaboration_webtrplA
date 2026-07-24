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
                        <span class="text-slate-800 font-bold">Tautan Penting</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="link" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Tautan Penting</h2>
                        <p class="text-sm text-slate-500">Kelola tautan jalan pintas penting seperti Notion, Instagram, atau Jadwal Kuliah.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.links.create') }}" class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                <i data-lucide="plus" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Tautan</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <!-- Table Header Info -->
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total {{ $links->total() }} Tautan Aktif</span>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Tipe Tautan</th>
                            <th class="px-6 py-4">URL Tautan</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($links as $link)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4 text-center font-mono text-xs font-bold text-slate-400">
                                    {{ $loop->iteration + $links->firstItem() - 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($link->link_type == 'notion')
                                            <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-800 flex items-center justify-center border border-slate-200 shadow-2xs">
                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                            </div>
                                            <span class="font-bold text-slate-800">Notion Kelas</span>
                                        @elseif($link->link_type == 'instagram')
                                            <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center border border-pink-100 shadow-2xs">
                                                <i class="fa-brands fa-instagram fa-lg"></i>
                                            </div>
                                            <span class="font-bold text-slate-800">Instagram</span>
                                        @elseif($link->link_type == 'schedule')
                                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 shadow-2xs">
                                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                            </div>
                                            <span class="font-bold text-slate-800">Jadwal Kuliah</span>
                                        @else
                                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 shadow-2xs">
                                                <i data-lucide="link" class="w-4 h-4"></i>
                                            </div>
                                            <span class="font-bold text-slate-800 capitalize">{{ $link->link_type }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ $link->link_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 hover:text-brand-700 bg-brand-50/50 hover:bg-brand-100/60 px-3 py-1.5 rounded-lg border border-brand-200/60 transition-all break-all shadow-2xs">
                                        <span>{{ $link->link_url }}</span>
                                        <i data-lucide="external-link" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.links.edit', $link->link_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-amber-600 bg-amber-50 border border-amber-200 hover:bg-amber-500 hover:text-white transition-all shadow-2xs"
                                            title="Edit Tautan">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.links.destroy', $link->link_id) }}" method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-all shadow-2xs"
                                                title="Hapus Tautan">
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
                                            <i data-lucide="link" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="font-bold text-slate-700 text-base">Belum Ada Tautan</h3>
                                        <p class="text-xs text-slate-400">Tambahkan tautan cepat untuk membantu mahasiswa mengakses resource kelas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($links->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $links->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection


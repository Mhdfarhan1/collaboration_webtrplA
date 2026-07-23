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
                        <span class="text-slate-700 font-semibold">Tautan Penting</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4 mt-6 sm:mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Tautan</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola tautan penting seperti Notion kelas, Instagram, atau Jadwal.</p>
            </div>
            <a href="{{ route('admin.links.create') }}" class="w-full sm:w-auto group inline-flex justify-center items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm hover:shadow-brand-200 hover:-translate-y-0.5">
                <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Tautan</span>
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-12 text-center">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tipe Tautan</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">URL Tautan</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($links as $link)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 text-center text-slate-500">{{ $loop->iteration + $links->firstItem() - 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($link->link_type == 'notion')
                                            <div class="p-2 rounded-md bg-slate-100 text-slate-600"><i data-lucide="file-text" class="w-4 h-4"></i></div>
                                            <span class="font-bold text-slate-800 capitalize">Notion Kelas</span>
                                        @elseif($link->link_type == 'instagram')
                                            <div class="p-2 rounded-md bg-pink-50 text-pink-500"><i data-lucide="instagram" class="w-4 h-4"></i></div>
                                            <span class="font-bold text-slate-800 capitalize">Instagram</span>
                                        @elseif($link->link_type == 'schedule')
                                            <div class="p-2 rounded-md bg-blue-50 text-blue-500"><i data-lucide="calendar" class="w-4 h-4"></i></div>
                                            <span class="font-bold text-slate-800 capitalize">Jadwal Matkul</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ $link->link_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-medium text-brand-600 hover:text-brand-700 hover:underline break-all">
                                        {{ $link->link_url }}
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.links.edit', $link->link_id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all tooltip" title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.links.destroy', $link->link_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus tautan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all tooltip" title="Hapus">
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
                                            <i data-lucide="link" class="w-8 h-8 text-slate-300"></i>
                                        </div>
                                        <p class="font-medium text-slate-600">Belum ada tautan</p>
                                        <p class="text-xs text-slate-400 mt-1">Tambahkan tautan penting kelas di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($links->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $links->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

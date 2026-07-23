@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
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
                        <span class="text-slate-800 font-bold">Mahasiswa</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section Card -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Mahasiswa</h2>
                        <p class="text-sm text-slate-500">Kelola data anggota kelas dan status keanggotaan (Core Team / Member).</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.members.create') }}"
                class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                <i data-lucide="plus" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Mahasiswa</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <!-- Table Info Bar -->
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total {{ $members->total() }} Mahasiswa Terdaftar</span>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Mahasiswa</th>
                            <th class="px-6 py-4">NIM</th>
                            <th class="px-6 py-4">Status Keanggotaan</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($members as $member)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-slate-100 shadow-xs flex-shrink-0 bg-slate-100 flex items-center justify-center group-hover:border-brand-300 transition-all">
                                            @if ($member->member_image)
                                                <img src="{{ asset($member->member_image) }}" alt="{{ $member->member_name }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 font-bold text-sm">
                                                    {{ substr($member->member_name, 0, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-base leading-snug group-hover:text-brand-600 transition-colors">{{ $member->member_name }}</p>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                @if($member->instagram_url)
                                                    <a href="{{ $member->instagram_url }}" target="_blank" class="text-slate-400 hover:text-pink-600 transition-colors" title="Instagram"><i data-lucide="instagram" class="w-3.5 h-3.5"></i></a>
                                                @endif
                                                @if($member->github_url)
                                                    <a href="{{ $member->github_url }}" target="_blank" class="text-slate-400 hover:text-slate-900 transition-colors" title="GitHub"><i data-lucide="github" class="w-3.5 h-3.5"></i></a>
                                                @endif
                                                @if($member->linkedin_url)
                                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="text-slate-400 hover:text-blue-600 transition-colors" title="LinkedIn"><i data-lucide="linkedin" class="w-3.5 h-3.5"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-bold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/60 shadow-2xs">
                                        {{ $member->member_nim }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($member->member_is_core)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                            Core Team
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200/80">
                                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                            Member
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.members.edit', $member->member_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-amber-600 bg-amber-50 border border-amber-200 hover:bg-amber-500 hover:text-white transition-all shadow-2xs"
                                            title="Edit Data Mahasiswa">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.members.destroy', $member->member_id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-all shadow-2xs"
                                                title="Hapus Mahasiswa">
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
                                            <i data-lucide="users" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="font-bold text-slate-700 text-base">Belum Ada Mahasiswa</h3>
                                        <p class="text-xs text-slate-400">Mulai tambahkan daftar mahasiswa kelas Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse ($members as $member)
                    <div class="p-5 space-y-4 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-full overflow-hidden border border-slate-200 shadow-xs flex-shrink-0 bg-slate-100 flex items-center justify-center">
                                @if ($member->member_image)
                                    <img src="{{ asset($member->member_image) }}" alt="{{ $member->member_name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="font-bold text-slate-500 text-sm">{{ substr($member->member_name, 0, 2) }}</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 text-base leading-snug truncate">{{ $member->member_name }}</h3>
                                <p class="text-xs font-mono text-slate-500 mt-0.5">{{ $member->member_nim }}</p>

                                <div class="mt-2">
                                    @if($member->member_is_core)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            Core Team
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                            Member
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                            <a href="{{ route('admin.members.edit', $member->member_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-xl text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 hover:bg-amber-600 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                            </a>

                            <form action="{{ route('admin.members.destroy', $member->member_id) }}" method="POST" class="flex-1 delete-form">
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
                        <p class="font-medium text-slate-600">Belum ada mahasiswa</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($members->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $members->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
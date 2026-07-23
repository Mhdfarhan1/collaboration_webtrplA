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
                        <span class="text-slate-700 font-semibold">Mahasiswa</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4 mt-6 sm:mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Mahasiswa</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola data anggota kelas dan status keanggotaan (Core Team).</p>
            </div>
            <a href="{{ route('admin.members.create') }}"
                class="w-full sm:w-auto group inline-flex justify-center items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm hover:shadow-brand-200 hover:-translate-y-0.5">
                <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Mahasiswa</span>
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
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Mahasiswa</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($members as $member)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-full overflow-hidden border-2 border-slate-100 shadow-sm flex-shrink-0 bg-slate-50 flex items-center justify-center">
                                            @if ($member->member_image)
                                                <img src="{{ asset($member->member_image) }}" alt="{{ $member->member_name }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <i data-lucide="user" class="w-6 h-6 text-slate-400"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $member->member_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-600">
                                    {{ $member->member_nim }}
                                </td>
                                <td class="px-6 py-5">
                                    @if($member->member_is_core)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-brand-50 text-brand-700 border border-brand-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span>
                                            Core Team
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            Member
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.members.edit', $member->member_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-brand-600 hover:bg-brand-50 hover:border-brand-200 transition-all shadow-sm tooltip"
                                            title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.members.destroy', $member->member_id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus mahasiswa ini?');">
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
                                            <i data-lucide="users" class="w-8 h-8 text-slate-300"></i>
                                        </div>
                                        <p class="font-medium text-slate-600">Belum ada mahasiswa</p>
                                        <p class="text-xs text-slate-400 mt-1">Mulai tambahkan daftar mahasiswa ke kelas ini.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Stacked View (Hidden on desktop) -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse ($members as $member)
                    <div class="p-4 space-y-4">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-14 h-14 rounded-full overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 bg-slate-50 flex items-center justify-center">
                                @if ($member->member_image)
                                    <img src="{{ asset($member->member_image) }}" alt="{{ $member->member_name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="user" class="w-6 h-6 text-slate-400"></i>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 truncate">{{ $member->member_name }}</h3>
                                <p class="text-sm font-medium text-slate-500 mt-0.5 mb-2">{{ $member->member_nim }}</p>

                                @if($member->member_is_core)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                                        Core Team
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200">
                                        Member
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-50">
                            <a href="{{ route('admin.members.edit', $member->member_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-200 hover:text-brand-600 hover:bg-brand-50 active:bg-brand-100 transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                            </a>

                            <form action="{{ route('admin.members.destroy', $member->member_id) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?');">
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
                                <i data-lucide="users" class="w-8 h-8 text-slate-300"></i>
                            </div>
                            <p class="font-medium text-slate-600">Belum ada mahasiswa</p>
                            <p class="text-xs text-slate-400 mt-1">Mulai tambahkan daftar mahasiswa ke kelas ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination Controls -->
            @if($members->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $members->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
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
                        <span class="text-slate-800 font-bold">Kelola Akun Admin</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold flex items-center justify-between shadow-2xs">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-bold flex items-center justify-between shadow-2xs">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- Header Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Kelola Akun Admin</h2>
                        <p class="text-sm text-slate-500">Kelola daftar akun administrator & pengurus yang memiliki akses ke dashboard.</p>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('admin.users.create') }}"
                class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                <i data-lucide="user-plus" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span>+ Tambah Admin Baru</span>
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total {{ $users->total() }} Pengguna Admin</span>
                </div>
            </div>

            <!-- Desktop View Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Alamat Email</th>
                            <th class="px-6 py-4">Role Akses</th>
                            <th class="px-6 py-4">Tanggal Dibuat</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($users as $u)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}&background=2563eb&color=fff" 
                                             class="w-9 h-9 rounded-full border border-slate-200 shadow-2xs object-cover">
                                        <div>
                                            <p class="font-extrabold text-slate-800 leading-snug flex items-center gap-1.5">
                                                <span>{{ $u->name }}</span>
                                                @if($u->user_id === Auth::id())
                                                    <span class="px-1.5 py-0.5 rounded bg-blue-100 text-blue-700 text-[9px] font-extrabold">Anda</span>
                                                @endif
                                            </p>
                                            <p class="text-[11px] text-slate-400 font-medium">ID #{{ $u->user_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-600">
                                    {{ $u->email }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($u->role === 'super_admin')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-extrabold border border-blue-200/80 shadow-2xs">
                                            <i data-lucide="crown" class="w-3.5 h-3.5 text-blue-600"></i>
                                            <span>Super Admin</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-extrabold border border-slate-200/80 shadow-2xs">
                                            <i data-lucide="shield" class="w-3.5 h-3.5 text-slate-500"></i>
                                            <span>Admin Pengurus</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-500 font-medium">
                                    {{ $u->created_at ? $u->created_at->translatedFormat('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Edit / Reset Password -->
                                        <a href="{{ route('admin.users.edit', $u->user_id) }}" 
                                           class="p-2 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white transition-all shadow-2xs border border-blue-200/80"
                                           title="Edit & Reset Password">
                                            <i data-lucide="key-round" class="w-4 h-4"></i>
                                        </a>

                                        <!-- Hapus (Jika bukan user sendiri) -->
                                        @if($u->user_id !== Auth::id())
                                            <form action="{{ route('admin.users.destroy', $u->user_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin {{ $u->name }}?')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all shadow-2xs border border-rose-200/80" title="Hapus Akun">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400 italic">Belum ada akun admin terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

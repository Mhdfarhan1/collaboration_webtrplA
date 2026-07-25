@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i> Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-brand-600 transition-colors">Kelola Admin</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Tambah Admin Baru</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 shadow-2xs">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">Tambah Admin Pengurus Baru</h2>
                    <p class="text-xs text-slate-400 font-medium">Buatkan akun login baru untuk pengurus atau panitia kelas.</p>
                </div>
            </div>

            @if($errors->any())
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium space-y-1 shadow-2xs">
                    <div class="font-bold flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                        <span>Terdapat kesalahan input:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 pl-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama Lengkap -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-bold text-slate-700">Nama Lengkap Pengurus <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-slate-700">Alamat Email Login <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: pengurus@trpl.com" required
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>

                <!-- Role -->
                <div class="space-y-1.5">
                    <label for="role" class="block text-xs font-bold text-slate-700">Role & Hak Akses <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select id="role" name="role" required
                                class="w-full px-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin Pengurus (Dapat kelola konten web)</option>
                            <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin (Akses Penuh & Kelola Admin)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-bold text-slate-700">Kata Sandi Awal <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="lock" class="w-4 h-4"></i>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700">Konfirmasi Kata Sandi <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="check-check" class="w-4 h-4"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Submit Button Bar -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all shadow-2xs">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-md hover:shadow-lg active:scale-95">
                        <i data-lucide="user-check" class="w-4 h-4"></i>
                        <span>Simpan Akun Admin</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

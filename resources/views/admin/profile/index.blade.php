@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-5xl mx-auto space-y-6">
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
                        <span class="text-slate-800 font-bold">Pengaturan Profil</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Flash Notification -->
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

        @if(session('info'))
            <div class="p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-bold flex items-center justify-between shadow-2xs">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="info" class="w-5 h-5 text-blue-600 shrink-0"></i>
                    <span>{{ session('info') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-blue-500 hover:text-blue-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if($errors->any() && !session('show_profile_otp_modal'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium space-y-1.5 shadow-2xs">
                <div class="flex items-center gap-2 font-bold text-rose-900">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600"></i>
                    <span>Terdapat beberapa kesalahan input:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 pl-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Profile Header Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs relative overflow-hidden">
            <div class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-bl from-blue-500/10 via-cyan-400/5 to-transparent rounded-full blur-2xl -mr-16 -mt-16 pointer-events-none"></div>
            
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 relative z-10">
                <div class="relative group">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=128"
                         alt="{{ $user->name }}"
                         class="w-24 h-24 sm:w-28 sm:h-28 rounded-full border-4 border-white shadow-md object-cover">
                    <span class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-emerald-500 border-2 border-white" title="Aktif"></span>
                </div>

                <div class="flex-1 text-center sm:text-left space-y-2">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $user->name }}</h1>
                            <p class="text-xs sm:text-sm text-slate-500 font-medium">{{ $user->email }}</p>
                        </div>
                        
                        <span class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 rounded-full bg-blue-50 text-blue-700 text-xs font-extrabold border border-blue-100/80 shadow-2xs self-center sm:self-start">
                            <i data-lucide="shield-check" class="w-4 h-4 text-blue-600"></i>
                            <span>{{ $user->role === 'super_admin' ? 'Super Admin' : 'Admin Pengurus' }}</span>
                        </span>
                    </div>

                    <div class="pt-2 flex flex-wrap justify-center sm:justify-start items-center gap-4 text-xs font-medium text-slate-500 border-t border-slate-100">
                        <span class="inline-flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span>Terdaftar: {{ $user->created_at ? $user->created_at->translatedFormat('d M Y') : '16 Jan 2026' }}</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <i data-lucide="lock" class="w-3.5 h-3.5 text-blue-600"></i>
                            <span>Proteksi OTP Ganti Password: Aktif</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column: Edit Informasi Akun -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
                <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100 shadow-2xs">
                        <i data-lucide="user" class="w-4.5 h-4.5"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Informasi Profil</h3>
                        <p class="text-xs text-slate-400 font-medium">Perbarui nama lengkap dan email akun Anda.</p>
                    </div>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Nama Lengkap -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-bold text-slate-700">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="user" class="w-4 h-4"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-700">Alamat Email <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                    </div>

                    <!-- Role Badge Info -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 text-slate-600 text-xs space-y-1">
                        <span class="font-bold text-slate-800">Status Hak Akses:</span>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            {{ $user->role === 'super_admin' ? 'Akun ini memegang hak akses Super Admin (Pemilik Utama).' : 'Akun ini memegang hak akses Admin Pengurus.' }}
                        </p>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-md active:scale-95">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Informasi Profil</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Keamanan & Ganti Password (Challenge-First) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 border border-amber-100 shadow-2xs">
                            <i data-lucide="key-round" class="w-4.5 h-4.5"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">Ubah Kata Sandi Profil</h3>
                            <p class="text-xs text-slate-400 font-medium">Penggantian password akun pribadi Super Admin.</p>
                        </div>
                    </div>

                    @if(session('profile_password_unlocked'))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-extrabold border border-emerald-200 shadow-2xs">
                            <i data-lucide="unlock" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Akses Terbuka</span>
                        </span>
                    @endif
                </div>

                @if(session('profile_password_unlocked'))
                    <!-- Unlocked Form Input New Password -->
                    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <!-- Password Saat Ini -->
                        <div class="space-y-1.5">
                            <label for="current_password" class="block text-xs font-bold text-slate-700">Kata Sandi Saat Ini <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                </div>
                                <input type="password" id="current_password" name="current_password" required placeholder="••••••••"
                                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div class="space-y-1.5">
                            <label for="new_password" class="block text-xs font-bold text-slate-700">Kata Sandi Baru <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i data-lucide="key" class="w-4 h-4"></i>
                                </div>
                                <input type="password" id="new_password" name="new_password" required placeholder="Minimal 8 karakter"
                                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="space-y-1.5">
                            <label for="new_password_confirmation" class="block text-xs font-bold text-slate-700">Konfirmasi Kata Sandi Baru <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i data-lucide="check-check" class="w-4 h-4"></i>
                                </div>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" required placeholder="Ulangi kata sandi baru"
                                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-md active:scale-95">
                                <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                                <span>Simpan Kata Sandi Baru</span>
                            </button>
                        </div>
                    </form>
                @else
                    <!-- Locked Step: Challenge Request Button -->
                    <div class="space-y-4">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs text-slate-600 leading-relaxed space-y-1">
                            <span class="font-bold text-slate-800 flex items-center gap-1.5">
                                <i data-lucide="shield" class="w-4 h-4 text-amber-600"></i>
                                <span>Keamanan Akun Super Admin:</span>
                            </span>
                            <p class="text-slate-500">
                                Untuk keamanan akun Anda, verifikasi Kode OTP 6-Digit akan dikirimkan ke email pribadi Anda saat Anda mengeklik tombol <strong>Ubah Kata Sandi</strong> di bawah ini untuk membuka form pengubahan kata sandi.
                            </p>
                        </div>

                        <form action="{{ route('admin.profile.request_otp') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-extrabold transition-all shadow-md hover:shadow-lg active:scale-95">
                                <i data-lucide="key-round" class="w-4 h-4"></i>
                                <span>Ubah Kata Sandi</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- OTP Modal for Profile Password Change -->
        @if(session('show_profile_otp_modal'))
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-in fade-in duration-200">
                <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-200 space-y-5">
                    <div class="text-center space-y-2">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto border border-blue-100 shadow-2xs">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-lg font-black text-slate-900">Verifikasi OTP Ganti Password</h3>
                        <p class="text-xs text-slate-500">Masukkan kode OTP 6-Digit yang telah dikirimkan ke email Anda untuk membuka form pengisian kata sandi baru.</p>
                    </div>

                    @if($errors->has('otp_code'))
                        <div class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                            <span>{{ $errors->first('otp_code') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.verify_otp') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-1.5">
                            <label for="modal_profile_otp_input" class="block text-xs font-bold text-slate-700 text-center">Masukkan Kode OTP 6-Digit</label>
                            <input type="text" id="modal_profile_otp_input" name="otp_code" maxlength="6" autofocus required
                                   placeholder="------"
                                   class="w-full text-center text-2xl font-black tracking-[10px] py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:bg-white text-blue-700 font-mono">
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="location.reload()" class="w-1/2 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">
                                Batal
                            </button>
                            <button type="submit" class="w-1/2 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-all shadow-md">
                                Verifikasi & Buka Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection

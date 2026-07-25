@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i> Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-brand-600 transition-colors">Kelola
                            Admin</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Edit / Reset Password Admin</span>
                    </div>
                </li>
            </ol>
        </nav>


        @if(session('success'))
            <div
                class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold flex items-center justify-between shadow-2xs">
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
            <div
                class="p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-bold flex items-center justify-between shadow-2xs">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="info" class="w-5 h-5 text-blue-600 shrink-0"></i>
                    <span>{{ session('info') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-blue-500 hover:text-blue-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- Form Card for Profile Info -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div
                    class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 shadow-2xs">
                    <i data-lucide="user-cog" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">Edit Akun Admin: {{ $user->name }}</h2>
                    <p class="text-xs text-slate-400 font-medium">Perbarui nama lengkap, alamat email, atau role pengurus
                        ini.</p>
                </div>
            </div>

            @if($errors->any() && !session('show_reset_otp_modal'))
                <div
                    class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium space-y-1 shadow-2xs">
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

            <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-bold text-slate-700">Nama Lengkap Pengurus <span
                            class="text-rose-500">*</span></label>
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
                    <label for="email" class="block text-xs font-bold text-slate-700">Alamat Email Login <span
                            class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>

                <!-- Role -->
                <div class="space-y-1.5">
                    <label for="role" class="block text-xs font-bold text-slate-700">Role & Hak Akses <span
                            class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select id="role" name="role" required
                            class="w-full px-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin Pengurus
                                (Dapat kelola konten web)</option>
                            <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>
                                Super Admin (Akses Penuh & Kelola Admin)</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Profile Button -->
                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all shadow-2xs">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-md hover:shadow-lg active:scale-95">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Perubahan Informasi</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Reset Password Section Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 shadow-2xs">
                        <i data-lucide="key-round" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Reset Kata Sandi Akun Admin</h3>
                        <p class="text-xs text-slate-400 font-medium">Fitur khusus Super Admin untuk mereset kata sandi akun
                            pengurus ini.</p>
                    </div>
                </div>

                @if(session('reset_password_unlocked_' . $user->user_id))
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-extrabold border border-emerald-200 shadow-2xs">
                        <i data-lucide="unlock" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span>Akses Terbuka (Unlocked)</span>
                    </span>
                @endif
            </div>

            @if(session('reset_password_unlocked_' . $user->user_id))
                <!-- Unlocked Form Input New Password -->
                <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input type="hidden" name="role" value="{{ $user->role }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Password Baru -->
                        <div class="space-y-1.5">
                            <label for="password" class="block text-xs font-bold text-slate-700">Kata Sandi Baru <span
                                    class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                </div>
                                <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter"
                                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="space-y-1.5">
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700">Konfirmasi Kata
                                Sandi Baru <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i data-lucide="check-check" class="w-4 h-4"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    placeholder="Ulangi kata sandi baru"
                                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50/80 hover:bg-white focus:bg-white text-slate-800 text-xs font-bold rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-md hover:shadow-lg active:scale-95">
                            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                            <span>Simpan Kata Sandi Baru</span>
                        </button>
                    </div>
                </form>
            @else
                <!-- Locked Challenge Step: Clean Reset Password Button with Description Below -->
                <div class="space-y-4">
                    <div
                        class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs text-slate-600 leading-relaxed space-y-1">
                        <span class="font-bold text-slate-800 flex items-center gap-1.5">
                            <i data-lucide="shield" class="w-4 h-4 text-blue-600"></i>
                            <span>Prosedur Keamanan Reset Kata Sandi Super Admin:</span>
                        </span>
                        <p class="text-slate-500">
                            Sebagai Super Admin, verifikasi Kode OTP 6-Digit akan dikirimkan secara rahasia ke email pribadi
                            Anda saat Anda mengeklik tombol Reset Password di bawah ini untuk membuka akses form kata sandi
                            baru.
                        </p>
                    </div>

                    <form action="{{ route('admin.users.request_reset_otp', $user->user_id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-extrabold transition-all shadow-md hover:shadow-lg active:scale-95">
                            <i data-lucide="key-round" class="w-4 h-4"></i>
                            <span>Reset Password</span>
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Step-Up Challenge OTP Modal -->
        @if(session('show_reset_otp_modal'))
            <div
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-in fade-in duration-200">
                <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-200 space-y-5">
                    <div class="text-center space-y-2">
                        <div
                            class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto border border-blue-100 shadow-2xs">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-lg font-black text-slate-900">Verifikasi OTP Super Admin</h3>
                        <p class="text-xs text-slate-500">Masukkan kode OTP 6-Digit yang dikirim ke email pribadi Anda untuk
                            membuka form reset kata sandi akun <strong>{{ $user->name }}</strong>.</p>
                    </div>



                    @if($errors->has('otp_code'))
                        <div
                            class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                            <span>{{ $errors->first('otp_code') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.verify_reset_otp', $user->user_id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-1.5">
                            <label for="modal_user_otp_input" class="block text-xs font-bold text-slate-700 text-center">Kode
                                OTP 6-Digit</label>
                            <input type="text" id="modal_user_otp_input" name="otp_code" maxlength="6" autofocus required
                                placeholder="------"
                                class="w-full text-center text-2xl font-black tracking-[10px] py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:bg-white text-blue-700 font-mono">
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="location.reload()"
                                class="w-1/2 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="w-1/2 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-all shadow-md">
                                Verifikasi & Buka Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Verifikasi OTP Perangkat')

@section('content')
    <section class="min-h-[calc(100vh-80px)] pt-36 sm:pt-40 pb-20 flex items-center justify-center px-4 relative">

        <!-- Background Orbs -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-[20%] left-[20%] w-72 h-72 bg-blue-400/20 rounded-full blur-[100px] animate-blob">
            </div>
            <div class="absolute bottom-[20%] right-[20%] w-72 h-72 bg-cyan-400/20 rounded-full blur-[100px] animate-blob"
                style="animation-delay: 2s"></div>
        </div>

        <div
            class="w-full max-w-md bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-200/80 shadow-2xl relative overflow-hidden z-10 space-y-6">

            <!-- Logo & Header -->
            <div class="text-center space-y-2">
                <div
                    class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-500/30 mb-2">
                    <i data-lucide="shield-check" class="w-7 h-7"></i>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Verifikasi Perangkat Baru</h1>
                <p class="text-xs text-slate-500 font-medium">Sistem mendeteksi Anda mencoba login dari perangkat atau
                    browser baru.</p>
            </div>



            @if(session('info'))
                <div
                    class="p-3.5 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-xs font-bold flex items-center gap-2 shadow-2xs">
                    <i data-lucide="info" class="w-4 h-4 text-blue-600 shrink-0"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div
                    class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2 shadow-2xs">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Card Section -->
            <div class="space-y-6">
                <div class="text-center space-y-1">
                    <p class="text-xs font-bold text-slate-500">Kode OTP 6-Digit dikirim ke email:</p>
                    <p
                        class="text-sm font-black text-blue-600 bg-blue-50 px-3.5 py-1 rounded-full inline-block border border-blue-100">
                        {{ substr($user->email, 0, 3) . '***' . strrchr($user->email, '@') }}
                    </p>
                </div>

                @if($errors->any())
                    <div
                        class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold space-y-1 shadow-2xs">
                        <div class="flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.otp.verify') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- OTP Input Field -->
                    <div class="space-y-2">
                        <label for="otp_code" class="block text-xs font-bold text-slate-700 text-center">Masukkan Kode OTP
                            6-Digit</label>
                        <input type="text" id="otp_code" name="otp_code" maxlength="6" autocomplete="one-time-code"
                            autofocus required placeholder="------"
                            class="w-full text-center text-2xl font-black tracking-[12px] py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white text-blue-700 font-mono transition-all">
                    </div>

                    <!-- Remember Device Checkbox -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-3 cursor-pointer hover:bg-slate-100/80 transition-colors"
                        onclick="document.getElementById('remember_device').click()">
                        <input type="checkbox" id="remember_device" name="remember_device" value="1" checked
                            onclick="event.stopPropagation()"
                            class="mt-0.5 w-4 h-4 rounded text-blue-600 border-slate-300 focus:ring-blue-500 cursor-pointer">
                        <div>
                            <label for="remember_device"
                                class="text-xs font-extrabold text-slate-800 cursor-pointer block leading-tight">
                                Ingat Perangkat Ini Selama 30 Hari
                            </label>
                            <p class="text-[10.5px] text-slate-500 font-medium mt-0.5">
                                Bebas verifikasi OTP untuk login di browser laptop ini selama 30 hari ke depan.
                            </p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl shadow-md hover:shadow-lg transition-all active:scale-98 flex items-center justify-center gap-2">
                        <span>Verifikasi & Masuk Dashboard</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </form>

                <!-- Resend OTP Form -->
                <div class="pt-2 text-center border-t border-slate-100">
                    <form action="{{ route('login.otp.resend') }}" method="POST">
                        @csrf
                        <p class="text-xs text-slate-500 font-medium">
                            Tidak menerima kode?
                            <button type="submit"
                                class="font-bold text-blue-600 hover:underline inline-flex items-center gap-1">
                                <span>Kirim Ulang OTP</span>
                                <i data-lucide="refresh-cw" class="w-3 h-3"></i>
                            </button>
                        </p>
                    </form>
                </div>
            </div>

            <div class="text-center pt-2">
                <a href="{{ route('login') }}"
                    class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors inline-flex items-center gap-1">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Kembali ke Halaman Login</span>
                </a>
            </div>
        </div>
    </section>
@endsection
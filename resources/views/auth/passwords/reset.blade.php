@extends('layouts.app')

@section('title', 'Buat Kata Sandi Baru')

@section('content')
<section class="min-h-[calc(100vh-80px)] pt-36 sm:pt-40 pb-20 flex items-center justify-center px-4 relative">
    
    <!-- Background Animated Orbs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[20%] left-[20%] w-72 h-72 bg-blue-400/20 rounded-full blur-[100px] animate-blob"></div>
        <div class="absolute bottom-[20%] right-[20%] w-72 h-72 bg-cyan-400/20 rounded-full blur-[100px] animate-blob" style="animation-delay: 2s"></div>
    </div>

    <div class="w-full max-w-md bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-200/80 shadow-2xl relative overflow-hidden z-10 space-y-6">
        
        <!-- Header -->
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-500/30 mb-2">
                <i data-lucide="lock" class="w-7 h-7"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Kata Sandi Baru</h1>
            <p class="text-xs text-slate-500 font-medium">Masukkan kata sandi baru yang kuat untuk akun {{ $user->email }}.</p>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold space-y-1 shadow-2xs">
                <div class="flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            
            <!-- Password Baru Input -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold text-slate-700">Kata Sandi Baru</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="key" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password" id="password" required autofocus placeholder="Minimal 8 karakter"
                           class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-800 text-xs font-bold rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Konfirmasi Password Input -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-xs font-bold text-slate-700">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="check-check" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi kata sandi baru"
                           class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-800 text-xs font-bold rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl shadow-md hover:shadow-lg transition-all active:scale-98 flex items-center justify-center gap-2">
                <span>Simpan Kata Sandi Baru</span>
                <i data-lucide="check-circle-2" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<section class="min-h-screen pt-24 pb-12 flex items-center justify-center px-4 relative">
    
    <!-- Background Animated Orbs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[20%] left-[20%] w-72 h-72 bg-purple-400/30 rounded-full blur-[100px] animate-blob"></div>
        <div class="absolute bottom-[20%] right-[20%] w-72 h-72 bg-cyan-400/30 rounded-full blur-[100px] animate-blob" style="animation-delay: 2s"></div>
        <div class="absolute top-[40%] right-[30%] w-64 h-64 bg-blue-400/30 rounded-full blur-[100px] animate-blob" style="animation-delay: 4s"></div>
    </div>

    <div class="w-full max-w-md glass-card rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden reveal z-10">
        
        <!-- Decorative Elements -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/20 blur-[50px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-cyan-500/20 blur-[50px] rounded-full pointer-events-none"></div>

        <div class="relative z-10">
            <div class="text-center mb-8">
                <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-100 text-[10px] font-bold uppercase tracking-wider mb-3">
                    Recovery
                </span>
                <h1 class="text-3xl font-black text-slate-800 mb-2">Forgot Password</h1>
                <p class="text-slate-500 text-sm">Masukkan email untuk menerima kode OTP.</p>
            </div>

            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- Email Input --}}
                <div class="group">
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 group-focus-within:text-brand-600 transition-colors">
                        Email Address
                    </label>
                    <div class="relative">
                        <input type="email" name="email" id="email" 
                            class="w-full px-4 py-3 rounded-xl bg-white/50 border border-slate-200 text-slate-800 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all placeholder:text-slate-400"
                            placeholder="nama@email.com" required>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-brand-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <button type="submit" class="group relative w-full inline-flex items-center justify-center px-6 py-3.5 text-sm font-bold uppercase tracking-widest text-white rounded-xl bg-brand-600 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-brand-500 overflow-hidden shadow-lg shadow-brand-500/30">
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-500 via-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="relative z-10 flex items-center gap-2">
                        Send OTP Code
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-slate-500 text-sm font-bold hover:text-brand-600 transition-colors uppercase text-[10px] tracking-widest">
                        Back to Login
                    </a>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection

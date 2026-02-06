@extends('layouts.app')

@section('title', 'Reset Password')

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
                    New Security
                </span>
                <h1 class="text-3xl font-black text-slate-800 mb-2">Reset Password</h1>
                <p class="text-slate-500 text-sm">Buat password baru yang kuat.</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ request('email') }}">
                <input type="hidden" name="token" value="{{ request('token') }}">
                
                {{-- New Password Input --}}
                <div class="group">
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 group-focus-within:text-brand-600 transition-colors">
                        New Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" 
                            class="w-full px-4 py-3 rounded-xl bg-white/50 border border-slate-200 text-slate-800 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all placeholder:text-slate-400"
                            placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword('password', 'icon-eye-1', 'icon-eye-off-1')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-600 focus:text-brand-600 transition-colors focus:outline-none">
                            <svg id="icon-eye-1" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="icon-eye-off-1" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password Input --}}
                <div class="group">
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 group-focus-within:text-brand-600 transition-colors">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="w-full px-4 py-3 rounded-xl bg-white/50 border border-slate-200 text-slate-800 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all placeholder:text-slate-400"
                            placeholder="••••••••" required>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <button type="submit" class="group relative w-full inline-flex items-center justify-center px-6 py-3.5 text-sm font-bold uppercase tracking-widest text-white rounded-xl bg-brand-600 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-brand-500 overflow-hidden shadow-lg shadow-brand-500/30">
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-500 via-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="relative z-10 flex items-center gap-2">
                        Reset Password
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                </button>

            </form>
        </div>
    </div>
</section>
@endsection

<script>
    function togglePassword(inputId, eyeId, eyeOffId) {
        const passwordInput = document.getElementById(inputId);
        const iconEye = document.getElementById(eyeId);
        const iconEyeOff = document.getElementById(eyeOffId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            iconEye.classList.add('hidden');
            iconEyeOff.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            iconEye.classList.remove('hidden');
            iconEyeOff.classList.add('hidden');
        }
    }
</script>

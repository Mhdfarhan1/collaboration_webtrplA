@extends('layouts.app')

@section('title', 'Verify OTP')

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
                    Verification
                </span>
                <h1 class="text-3xl font-black text-slate-800 mb-2">Enter OTP Code</h1>
                <p class="text-slate-500 text-sm">Kode OTP telah dikirim ke email Anda.</p>
            </div>

            <form action="{{ route('password.verify') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ request('email') }}">
                
                {{-- OTP Input --}}
                <div class="group text-center">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">
                        6-Digit Code
                    </label>
                    <div class="flex justify-center gap-2 sm:gap-4" id="otp-container">
                        @for($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1"
                            class="otp-input w-10 h-12 sm:w-12 sm:h-14 rounded-xl bg-white/50 border border-slate-200 text-slate-800 text-xl font-bold text-center focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all placeholder:text-slate-300"
                            required>
                        @endfor
                        {{-- Hidden Input for actual submission --}}
                        <input type="hidden" name="otp" id="otp-hidden">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <button type="submit" class="group relative w-full inline-flex items-center justify-center px-6 py-3.5 text-sm font-bold uppercase tracking-widest text-white rounded-xl bg-brand-600 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-brand-500 overflow-hidden shadow-lg shadow-brand-500/30">
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-500 via-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="relative z-10 flex items-center gap-2">
                        Verify Code
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </button>

                <div class="text-center">
                    <button type="button" class="text-slate-500 text-sm font-medium hover:text-brand-600 transition-colors">
                        Tidak menerima kode? <span class="font-bold underline">Kirim Ulang</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('otp-container');
        const inputs = container.querySelectorAll('.otp-input');
        const hiddenInput = document.getElementById('otp-hidden');

        // Update hidden input every time
        const updateHiddenInput = () => {
            let otp = '';
            inputs.forEach(input => otp += input.value);
            hiddenInput.value = otp;
        };

        inputs.forEach((input, index) => {
            // Handle Type (Move to next)
            input.addEventListener('input', (e) => {
                if (input.value.length === 1) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                }
                updateHiddenInput();
            });

            // Handle Backspace (Move to prev)
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value.length === 0) {
                    if (index > 0) {
                        inputs[index - 1].focus();
                    }
                }
                setTimeout(updateHiddenInput, 0);
            });

            // Handle Paste (Fill all)
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text').replace(/\D/g, '').split(''); // Only digits
                
                if (pasteData.length > 0) {
                    inputs.forEach((inp, i) => {
                        if (pasteData[i]) {
                            inp.value = pasteData[i];
                        }
                    });
                    updateHiddenInput();
                    
                    // Focus logic after paste
                    const focusIndex = Math.min(pasteData.length, inputs.length) - 1;
                    if (focusIndex >= 0 && focusIndex < inputs.length) {
                        inputs[focusIndex].focus();
                    } else if (pasteData.length >= inputs.length) {
                         inputs[inputs.length - 1].focus();
                    }
                }
            });
        });
    });
</script>

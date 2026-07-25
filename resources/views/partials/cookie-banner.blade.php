<div id="cookie-consent-banner" 
     class="fixed bottom-6 right-6 z-50 max-w-md w-[calc(100%-3rem)] bg-white/95 backdrop-blur-md rounded-2xl p-5 shadow-2xl border border-slate-100/80 transition-all duration-500 transform translate-y-20 opacity-0 pointer-events-none"
     role="dialog" 
     aria-live="polite" 
     aria-label="Persetujuan Cookie">
    <div class="flex items-start gap-4">
        <!-- Cookie Icon Container -->
        <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center text-slate-800 shadow-inner">
            <i data-lucide="cookie" class="w-5 h-5"></i>
        </div>

        <!-- Content -->
        <div class="flex-1 text-slate-600 text-[13px] leading-relaxed pt-0.5">
            <p>
                Kami menggunakan cookie untuk mengoptimalkan pengalaman Anda di situs web kami. Dengan melanjutkan, Anda menyetujui kebijakan cookie kami.
            </p>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-2.5 mt-4">
                <button type="button" 
                        id="btn-cookie-reject"
                        class="px-4 py-2 text-xs font-semibold text-slate-800 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 transition-all duration-200 shadow-sm active:scale-95">
                    Tolak
                </button>
                <button type="button" 
                        id="btn-cookie-accept"
                        class="px-4 py-2 text-xs font-semibold text-white bg-[#172554] rounded-xl hover:bg-[#1e3a8a] focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 transition-all duration-200 shadow-md active:scale-95">
                    Setuju
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict';
        
        const COOKIE_KEY = 'webkelas_cookie_consent_v1';
        
        function getStorageConsent() {
            try {
                // Check localStorage
                if (typeof window.localStorage !== 'undefined') {
                    const val = window.localStorage.getItem(COOKIE_KEY);
                    if (val === 'accepted' || val === 'rejected') return val;
                }
                
                // Check document.cookie fallback
                const match = document.cookie.match(new RegExp('(^| )' + COOKIE_KEY + '=([^;]+)'));
                if (match && (match[2] === 'accepted' || match[2] === 'rejected')) {
                    return match[2];
                }
                return null;
            } catch (e) {
                return null;
            }
        }
        
        function setStorageConsent(value) {
            if (value !== 'accepted' && value !== 'rejected') return;
            try {
                // Store in localStorage
                if (typeof window.localStorage !== 'undefined') {
                    window.localStorage.setItem(COOKIE_KEY, value);
                }
                // Store in Browser HTTP Cookie (valid 1 year)
                const maxAge = 365 * 24 * 60 * 60;
                document.cookie = COOKIE_KEY + '=' + value + '; max-age=' + maxAge + '; path=/; SameSite=Lax';
            } catch (e) {
                console.warn('Penyimpanan preferensi cookie dibatasi oleh browser.');
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const banner = document.getElementById('cookie-consent-banner');
            const btnAccept = document.getElementById('btn-cookie-accept');
            const btnReject = document.getElementById('btn-cookie-reject');

            if (!banner) return;

            const existingConsent = getStorageConsent();

            // Tampilkan banner hanya jika pengguna belum memberikan persetujuan
            if (!existingConsent) {
                setTimeout(() => {
                    banner.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
                    banner.classList.add('translate-y-0', 'opacity-100');
                    if (typeof lucide !== 'undefined' && lucide.createIcons) {
                        lucide.createIcons();
                    }
                }, 500);
            }

            function hideBanner() {
                banner.classList.remove('translate-y-0', 'opacity-100');
                banner.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
            }

            if (btnAccept) {
                btnAccept.addEventListener('click', (e) => {
                    e.preventDefault();
                    setStorageConsent('accepted');
                    hideBanner();
                });
            }

            if (btnReject) {
                btnReject.addEventListener('click', (e) => {
                    e.preventDefault();
                    setStorageConsent('rejected');
                    hideBanner();
                });
            }
        });
    })();
</script>

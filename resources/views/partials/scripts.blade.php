<script>
    // --- LOGIC NAVBAR TRANSITION ---
    const navPanel = document.getElementById('nav-panel');
    const navbarContainer = document.getElementById('navbar-container');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            // Saat scroll ke bawah: Muncul Background Putih/Kaca & Shadow
            navPanel.classList.remove('bg-transparent', 'border-transparent', 'shadow-none', 'py-4');
            navPanel.classList.add('bg-white/80', 'backdrop-blur-xl', 'border-white/50', 'shadow-lg', 'py-3');

            navbarContainer.classList.remove('pt-6');
            navbarContainer.classList.add('pt-2');
        } else {
            // Saat di paling atas: Transparan & Lebih Renggang
            navPanel.classList.add('bg-transparent', 'border-transparent', 'shadow-none', 'py-4');
            navPanel.classList.remove('bg-white/80', 'backdrop-blur-xl', 'border-white/50', 'shadow-lg', 'py-3');

            navbarContainer.classList.add('pt-6');
            navbarContainer.classList.remove('pt-2');
        }
    });

    // --- MOBILE MENU ---
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerBtn.addEventListener('click', () => {
        hamburgerBtn.classList.toggle('active');
        if (mobileMenu.classList.contains('invisible')) {
            mobileMenu.classList.remove('invisible', 'scale-95', 'opacity-0');
        } else {
            mobileMenu.classList.add('invisible', 'scale-95', 'opacity-0');
        }
    });

    // --- SCROLL REVEAL ---
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");
        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            if (elementTop < windowHeight - 100) reveals[i].classList.add("active");
        }
    }
    window.addEventListener("scroll", reveal);
    reveal();

    document.addEventListener("DOMContentLoaded", () => {
        const loader = document.getElementById("page-loader");

        // Saat klik link internal
        document.querySelectorAll("a[href]").forEach(link => {
            const url = link.getAttribute("href");

            if (
                url &&
                !url.startsWith("#") &&
                !url.startsWith("http") &&
                !link.hasAttribute("target")
            ) {
                link.addEventListener("click", e => {
                    e.preventDefault();
                    loader.classList.add("active");

                    setTimeout(() => {
                        window.location.href = url;
                    }, 400);
                });
            }
        });

        // Saat halaman selesai load
        window.addEventListener("load", () => {
            loader.classList.add("finish");
            setTimeout(() => loader.remove(), 600);
        });

        // --- GLOBAL FORM SUBMIT PROCESSING ALERTS FOR PUBLIC FORMS ---
        document.addEventListener('submit', function (e) {
            const form = e.target;
            if (form.hasAttribute('data-no-alert')) return;

            const isDeleteMethod = form.querySelector('input[name="_method"][value="DELETE"]') || form.classList.contains('delete-form');

            if (isDeleteMethod && !form.dataset.confirmed) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl border border-slate-100'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.dataset.confirmed = 'true';
                        Swal.fire({
                            title: 'Menghapus Data...',
                            html: '<div class="w-10 h-10 border-4 border-red-500 border-t-transparent rounded-full animate-spin mx-auto my-3"></div><p class="text-sm text-slate-600">Mohon tunggu...</p>',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        form.submit();
                    }
                });
                return;
            }

            const fileInputs = form.querySelectorAll('input[type="file"]');
            let hasSelectedFile = false;
            fileInputs.forEach(input => {
                if (input.files && input.files.length > 0) hasSelectedFile = true;
            });

            let alertTitle = 'Memproses Data...';
            let alertMessage = 'Mohon tunggu sebentar...';

            if (hasSelectedFile) {
                alertTitle = 'Mengunggah File...';
                alertMessage = 'Mohon tunggu, file sedang diunggah.';
            } else if (form.action.includes('login')) {
                alertTitle = 'Memverifikasi Login...';
                alertMessage = 'Sedang mengecek email dan kata sandi Anda.';
            }

            Swal.fire({
                title: alertTitle,
                html: `
                    <div class="flex flex-col items-center gap-3 py-3">
                        <div class="w-12 h-12 border-4 border-brand-500 border-t-transparent rounded-full animate-spin"></div>
                        <p class="text-sm text-slate-600 font-medium">${alertMessage}</p>
                    </div>
                `,
                showConfirmButton: false,
                allowOutsideClick: false,
                customClass: {
                    popup: 'rounded-2xl shadow-2xl border border-slate-100 p-6'
                }
            });

            const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }
        });

        // Flash message session alerts
        @if(session('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                customClass: { popup: 'rounded-2xl shadow-2xl' }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                customClass: { popup: 'rounded-2xl shadow-2xl' }
            });
        @endif

        @if($errors->any())
            Swal.fire({
                title: "Periksa kembali inputan Anda",
                html: `<ul class="text-left text-sm text-red-600 mt-2 space-y-1">@foreach($errors->all() as $error)<li>• {{ $error }}</li>@endforeach</ul>`,
                icon: "warning",
                customClass: { popup: 'rounded-2xl shadow-2xl' }
            });
        @endif
    });
</script>
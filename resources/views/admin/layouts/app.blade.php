<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TRPL Class</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicon/devicon@latest/devicon.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 900: '#1e3a8a' }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-600 antialiased">

    <div class="flex h-screen overflow-hidden">

        @include('admin.partials.sidebar')

        <div class="flex-1 flex flex-col h-full relative">

            @include('admin.partials.navbar')

            <main class="flex-1 overflow-y-auto p-3 sm:p-6 md:p-8 bg-slate-50 min-w-0 w-full">
                @yield('content')
            </main>

        </div>
    </div>

    <div id="mobileOverlay"
        class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300 backdrop-blur-sm"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // --- 1. DEFINISI ELEMEN ---
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleBtn');
            const toggleIcon = document.getElementById('toggleIcon');

            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileCloseBtn = document.getElementById('mobileCloseBtn'); // Tombol baru
            const mobileOverlay = document.getElementById('mobileOverlay');

            const menuTexts = document.querySelectorAll('.menu-text');
            const logoText = document.querySelector('.logo-text');
            const sectionTitles = document.querySelectorAll('.section-title');
            const tooltips = document.querySelectorAll('.sidebar-tooltip');

            let isExpanded = true;

            // --- 2. LOGIKA DESKTOP (COLLAPSE/EXPAND) ---
            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    isExpanded = !isExpanded;

                    if (isExpanded) {
                        // EXPAND
                        sidebar.classList.remove('w-20');
                        sidebar.classList.add('w-64');
                        toggleIcon.style.transform = 'rotate(0deg)';

                        sectionTitles.forEach(t => { t.classList.remove('opacity-0', 'hidden'); t.style.display = 'block'; });

                        setTimeout(() => {
                            menuTexts.forEach(text => {
                                text.style.display = 'block';
                                requestAnimationFrame(() => {
                                    text.classList.remove('opacity-0', 'w-0', 'translate-x-[-10px]');
                                    text.classList.add('opacity-100');
                                });
                            });
                            logoText.style.display = 'block';
                            requestAnimationFrame(() => {
                                logoText.classList.remove('opacity-0', 'w-0');
                                logoText.classList.add('opacity-100');
                            });
                        }, 150);
                        tooltips.forEach(t => t.classList.add('hidden'));

                    } else {
                        // COLLAPSE
                        sidebar.classList.remove('w-64');
                        sidebar.classList.add('w-20');
                        toggleIcon.style.transform = 'rotate(180deg)';

                        sectionTitles.forEach(t => { t.classList.add('opacity-0'); setTimeout(() => t.style.display = 'none', 200); });
                        menuTexts.forEach(text => {
                            text.classList.remove('opacity-100');
                            text.classList.add('opacity-0', 'w-0', 'translate-x-[-10px]');
                            setTimeout(() => text.style.display = 'none', 300);
                        });
                        logoText.classList.remove('opacity-100');
                        logoText.classList.add('opacity-0', 'w-0');
                        setTimeout(() => logoText.style.display = 'none', 300);
                        tooltips.forEach(t => t.classList.remove('hidden'));
                    }
                });
            }

            // --- 3. LOGIKA MOBILE (ANIMASI SLIDE) ---

            function openMobileSidebar() {
                // 1. Persiapan Awal
                sidebar.classList.remove('hidden');
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');

                // 2. Tambahkan class dasar untuk animasi (Posisi off-screen dulu)
                sidebar.classList.add('fixed', 'inset-y-0', 'left-0', 'h-full', 'z-[100]', 'shadow-2xl', 'transition-transform', 'duration-300', 'transform', '-translate-x-full');

                // 3. Tampilkan isi konten
                menuTexts.forEach(t => { t.style.display = 'block'; t.classList.add('opacity-100'); });
                logoText.style.display = 'block'; logoText.classList.add('opacity-100');
                sectionTitles.forEach(t => { t.style.display = 'block'; t.classList.remove('opacity-0'); });

                // 4. Trigger Animasi Slide-In (sedikit delay agar browser merender posisi awal)
                setTimeout(() => {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                }, 10);

                // 5. Overlay Fade In
                mobileOverlay.classList.remove('hidden');
                setTimeout(() => {
                    mobileOverlay.classList.remove('opacity-0');
                    mobileOverlay.classList.add('opacity-100');
                }, 10);
            }

            function closeMobileSidebar() {
                // 1. Animasi Slide-Out
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');

                // 2. Overlay Fade Out
                mobileOverlay.classList.remove('opacity-100');
                mobileOverlay.classList.add('opacity-0');

                // 3. Tunggu animasi selesai (300ms) baru sembunyikan elemen
                setTimeout(() => {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('fixed', 'inset-y-0', 'left-0', 'h-full', 'z-[100]', 'shadow-2xl', 'transition-transform', 'duration-300', 'transform', '-translate-x-full', 'translate-x-0');
                    mobileOverlay.classList.add('hidden');
                }, 300);
            }

            // --- EVENT LISTENERS ---

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    openMobileSidebar();
                });
            }

            if (mobileCloseBtn) {
                mobileCloseBtn.addEventListener('click', closeMobileSidebar);
            }

            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', closeMobileSidebar);
            }

            // INIT
            if (isExpanded) {
                tooltips.forEach(t => t.classList.add('hidden'));
            }
            // Pastikan overlay punya class transition
            if (mobileOverlay) {
                mobileOverlay.classList.add('transition-opacity', 'duration-300', 'opacity-0');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // --- 1. GLOBAL FORM SUBMIT & PROCESSING ALERT LOGIC ---
            document.addEventListener('submit', function (e) {
                const form = e.target;

                // Skip if form has attribute data-no-alert
                if (form.hasAttribute('data-no-alert')) return;

                const isDeleteMethod = form.querySelector('input[name="_method"][value="DELETE"]') || form.classList.contains('delete-form');

                // Delete Confirmation Alert
                if (isDeleteMethod && !form.dataset.confirmed) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: 'Data yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-2xl shadow-2xl border border-slate-100',
                            confirmButton: 'px-5 py-2.5 rounded-xl text-white font-medium bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 transition-all shadow-md',
                            cancelButton: 'px-5 py-2.5 rounded-xl text-slate-700 font-medium bg-slate-100 hover:bg-slate-200 focus:ring-4 focus:ring-slate-200 transition-all me-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.dataset.confirmed = 'true';

                            Swal.fire({
                                title: 'Menghapus Data...',
                                html: `
                                    <div class="flex flex-col items-center gap-3 py-3">
                                        <div class="w-12 h-12 border-4 border-red-500 border-t-transparent rounded-full animate-spin"></div>
                                        <p class="text-sm text-slate-600 font-medium">Mohon tunggu sebentar, data sedang dihapus dari sistem.</p>
                                    </div>
                                `,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                customClass: {
                                    popup: 'rounded-2xl shadow-2xl border border-slate-100 p-6'
                                }
                            });

                            form.submit();
                        }
                    });
                    return;
                }

                // Check for File Input with selected file
                const fileInputs = form.querySelectorAll('input[type="file"]');
                let hasSelectedFile = false;
                fileInputs.forEach(input => {
                    if (input.files && input.files.length > 0) {
                        hasSelectedFile = true;
                    }
                });

                let alertTitle = 'Memproses Data...';
                let alertMessage = 'Mohon tunggu sebentar, data Anda sedang disimpan.';

                if (hasSelectedFile) {
                    alertTitle = 'Mengunggah & Memproses Data...';
                    alertMessage = 'Mohon tunggu sebentar, file sedang diunggah dan disimpan ke server.';
                }

                // Display Processing Alert Modal
                Swal.fire({
                    title: alertTitle,
                    html: `
                        <div class="flex flex-col items-center gap-4 py-4">
                            <div class="relative flex items-center justify-center">
                                <div class="w-14 h-14 border-4 border-brand-500/20 border-t-brand-600 rounded-full animate-spin"></div>
                                <i class="fa-solid fa-cloud-arrow-up text-brand-600 absolute text-lg animate-pulse"></i>
                            </div>
                            <p class="text-sm text-slate-600 font-medium text-center">${alertMessage}</p>
                        </div>
                    `,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl border border-slate-100 p-6'
                    }
                });

                // Update Submit Button State
                const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    if (submitBtn.tagName === 'BUTTON') {
                        submitBtn.innerHTML = `
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memproses Data...
                        `;
                    }
                }
            });

            // --- 2. FLASH SESSION ALERTS ---
            @if(session('success'))
                @php
                    $msg = strtolower(session('success'));
                    $title = 'Berhasil!';
                    if (str_contains($msg, 'tambah')) {
                        $title = 'Berhasil Ditambahkan!';
                    } elseif (str_contains($msg, 'perbarui') || str_contains($msg, 'ubah') || str_contains($msg, 'edit')) {
                        $title = 'Berhasil Diperbarui!';
                    } elseif (str_contains($msg, 'hapus')) {
                        $title = 'Berhasil Dihapus!';
                    }
                @endphp
                Swal.fire({
                    title: "{{ $title }}",
                    text: "{{ session('success') }}",
                    icon: "success",
                    timer: 3500,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl border border-slate-100'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: "Terjadi Kesalahan!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl border border-slate-100'
                    }
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    title: "Periksa Inputan Anda!",
                    html: `
                            <div class="text-left text-sm text-slate-600 bg-red-50 p-4 rounded-xl border border-red-100 mt-2 space-y-1">
                                @foreach($errors->all() as $error)
                                    <div class="flex items-start gap-2 text-red-600">
                                        <i class="fa-solid fa-circle-exclamation text-xs mt-1"></i>
                                        <span>{{ $error }}</span>
                                    </div>
                                @endforeach
                            </div>
                        `,
                    icon: "warning",
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl border border-slate-100'
                    }
                });
            @endif

            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TRPL Class</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
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

            <main class="flex-1 overflow-y-auto p-6 md:p-8 bg-slate-50">
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
                draggable: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                draggable: true
            });
        @endif
    </script>
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>

</html>
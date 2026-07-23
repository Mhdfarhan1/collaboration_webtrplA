<aside id="sidebar"
    class="hidden md:flex flex-col w-64 bg-white border-r border-slate-200 shadow-xl z-50 transition-all duration-300 ease-in-out relative h-screen">

    <div class="h-16 flex items-center justify-between px-4 border-b border-slate-100 overflow-visible relative z-20">

        <div class="flex items-center gap-3 whitespace-nowrap overflow-hidden">
            <div class="flex-shrink-0 flex items-center justify-center w-8 h-8">
                <img src="{{ asset('assets/img/logo_trpl.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div class="logo-text transition-all duration-300 opacity-100 overflow-hidden">
                <span class="text-lg font-bold tracking-tight text-brand-700 block">
                    TRPL <span class="text-slate-400 font-normal">Admin</span>
                </span>
            </div>
        </div>

        <button id="toggleBtn"
            class="hidden md:flex absolute -right-3 top-5 bg-white border border-slate-200 text-slate-400 hover:text-brand-600 rounded-full p-1 shadow-md transition-transform duration-300 hover:scale-110 z-50">
            <i data-lucide="chevron-left" class="w-4 h-4 transition-transform duration-300" id="toggleIcon"></i>
        </button>

        <button id="mobileCloseBtn"
            class="md:hidden text-slate-400 hover:text-red-500 transition-colors p-1 absolute right-4">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

    </div>

    <nav class="flex-1 px-3 py-5 space-y-1.5 overflow-y-auto overflow-x-hidden scrollbar-hide z-10">

        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-2 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            Menu Utama
        </p>

        <a href="{{ route('dashboard') }}"
            class="group relative flex items-center gap-3 px-3 py-3 {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }} rounded-xl transition-all text-sm font-semibold overflow-hidden hover:shadow-sm">
            <i data-lucide="layout-grid" class="w-5 h-5 flex-shrink-0 transition-colors"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Dashboard</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Dashboard
            </div>
        </a>

        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-5 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            Data Kelas
        </p>

        <!-- Dropdown Mahasiswa -->
        <a href="{{ route('admin.members.index') }}"
            class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all cursor-pointer overflow-hidden mt-1 
           {{ request()->routeIs('admin.members.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
            <i data-lucide="users"
                class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.members.*') ? 'text-brand-600' : '' }}"></i>
            <span
                class="text-sm font-medium whitespace-nowrap menu-text transition-all duration-300 opacity-100 {{ request()->routeIs('admin.members.*') ? 'font-semibold' : '' }}">Mahasiswa</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Mahasiswa
            </div>
        </a>

        <!-- Lecturers (Dosen) -->
        <a href="{{ route('admin.lecturers.index') }}"
            class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all cursor-pointer overflow-hidden mt-1 
           {{ request()->routeIs('admin.lecturers.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
            <i data-lucide="graduation-cap"
                class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.lecturers.*') ? 'text-brand-600' : '' }}"></i>
            <span
                class="text-sm font-medium whitespace-nowrap menu-text transition-all duration-300 opacity-100 {{ request()->routeIs('admin.lecturers.*') ? 'font-semibold' : '' }}">Dosen</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Dosen
            </div>
        </a>

        <!-- Projects -->
        <a href="{{ route('admin.projects.index') }}"
            class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all cursor-pointer overflow-hidden mt-1 
           {{ request()->routeIs('admin.projects.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
            <i data-lucide="folder-code"
                class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.projects.*') ? 'text-brand-600' : '' }}"></i>
            <span
                class="text-sm font-medium whitespace-nowrap menu-text transition-all duration-300 opacity-100 {{ request()->routeIs('admin.projects.*') ? 'font-semibold' : '' }}">Projects</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Projects
            </div>
        </a>



        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-5 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            Manajemen Konten
        </p>

        <!-- Logo Kelas -->
        <a href="{{ route('admin.logos.index') }}"
            class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all cursor-pointer overflow-hidden mt-1 
           {{ request()->routeIs('admin.logos.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
            <i data-lucide="aperture"
                class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.logos.*') ? 'text-brand-600' : '' }}"></i>
            <span
                class="text-sm font-medium whitespace-nowrap menu-text transition-all duration-300 opacity-100 {{ request()->routeIs('admin.logos.*') ? 'font-semibold' : '' }}">Logo
                Kelas</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Logo Kelas
            </div>
        </a>



        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-5 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            Informasi & Kegiatan
        </p>

        <!-- Dropdown Activities -->
        <div class="nav-item-group">
            <button
                class="dropdown-btn w-full group relative flex items-center justify-between px-3 py-3 text-slate-500 hover:text-brand-600 hover:bg-slate-50 rounded-xl transition-all text-sm font-medium overflow-hidden">
                <div class="flex items-center gap-3">
                    <i data-lucide="activity" class="w-5 h-5 flex-shrink-0 transition-colors"></i>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Kegiatan</span>
                </div>
                <i data-lucide="chevron-down"
                    class="dropdown-icon w-4 h-4 transition-transform duration-300 menu-text opacity-100"></i>
                <div
                    class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                    Acara & Galeri
                </div>
            </button>
            <div
                class="dropdown-menu {{ (request()->routeIs('admin.activities.*') || request()->routeIs('admin.albums.*')) ? 'flex' : 'hidden' }} flex-col gap-1 mt-1 px-2">
                <a href="{{ route('admin.activities.index') }}"
                    class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('admin.activities.*') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }} rounded-lg transition-all text-sm font-medium pl-10">
                    <div
                        class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.activities.*') ? 'bg-brand-600' : 'bg-slate-400' }} transition-colors">
                    </div>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Daftar
                        Kegiatan</span>
                </a>
                
                <a href="{{ route('admin.albums.index') }}"
                    class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('admin.albums.*') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }} rounded-lg transition-all text-sm font-medium pl-10">
                    <div
                        class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.albums.*') ? 'bg-brand-600' : 'bg-slate-400' }} transition-colors">
                    </div>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Galeri
                        Kelas</span>
                </a>

            </div>
        </div>

        <!-- Links -->
        <a href="{{ route('admin.links.index') }}"
            class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all cursor-pointer overflow-hidden mt-1 
           {{ request()->routeIs('admin.links.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
            <i data-lucide="link" class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.links.*') ? 'text-brand-600' : '' }}"></i>
            <span class="text-sm font-medium whitespace-nowrap menu-text transition-all duration-300 opacity-100 {{ request()->routeIs('admin.links.*') ? 'font-semibold' : '' }}">Tautan Penting</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Daftar Links
            </div>
        </a>

        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-5 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            Pengaturan Web
        </p>

        <!-- Dropdown Pengaturan UI -->
        <div class="nav-item-group">
            <button
                class="dropdown-btn w-full group relative flex items-center justify-between px-3 py-3 rounded-xl transition-all text-sm font-medium overflow-hidden {{ request()->routeIs('admin.heromedia.*') ? 'bg-brand-50 text-brand-600' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
                <div class="flex items-center gap-3">
                    <i data-lucide="monitor" class="w-5 h-5 flex-shrink-0 transition-colors"></i>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Tampilan</span>
                </div>
                <i data-lucide="chevron-down"
                    class="dropdown-icon w-4 h-4 transition-transform duration-300 menu-text opacity-100 {{ request()->routeIs('admin.heromedia.*') ? 'rotate-180' : '' }}"></i>
                <div
                    class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                    Media & Logo
                </div>
            </button>
            <div
                class="dropdown-menu flex-col gap-1 mt-1 px-2 {{ request()->routeIs('admin.heromedia.*') ? 'flex' : 'hidden' }}">
                <a href="{{ route('admin.heromedia.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all text-sm pl-10 {{ request()->routeIs('admin.heromedia.*') ? 'bg-slate-50 text-brand-600 font-semibold' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50 font-medium' }}">
                    <div
                        class="w-1.5 h-1.5 rounded-full transition-colors {{ request()->routeIs('admin.heromedia.*') ? 'bg-brand-600' : 'bg-slate-400' }}">
                    </div>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Hero
                        Banners</span>
                </a>

            </div>
        </div>

        {{-- Pengaturan Halaman --}}
        <a href="{{ route('admin.settings.index') }}"
            class="group relative flex items-center gap-3 px-3 py-3 rounded-xl transition-all cursor-pointer overflow-hidden mt-1
           {{ request()->routeIs('admin.settings.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
            <i data-lucide="sliders-horizontal"
                class="w-5 h-5 flex-shrink-0 transition-colors {{ request()->routeIs('admin.settings.*') ? 'text-brand-600' : '' }}"></i>
            <span class="text-sm font-medium whitespace-nowrap menu-text transition-all duration-300 opacity-100 {{ request()->routeIs('admin.settings.*') ? 'font-semibold' : '' }}">Pengaturan
                Halaman</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Pengaturan Halaman
            </div>
        </a>

    </nav>

    <div class="p-3 border-t border-slate-100 z-20">
        <button
            class="group relative flex items-center w-full px-3 py-3 text-sm text-red-500 hover:bg-red-50 rounded-xl transition-colors font-medium overflow-hidden">
            <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0"></i>
            <span class="menu-text ml-3 whitespace-nowrap transition-all duration-300 opacity-100">Keluar</span>
            <div
                class="sidebar-tooltip absolute left-14 bg-red-600 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Logout
            </div>
        </button>
    </div>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtns = document.querySelectorAll('.dropdown-btn');

        dropdownBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                // Close other dropdowns
                dropdownBtns.forEach(otherBtn => {
                    if (otherBtn !== btn) {
                        otherBtn.nextElementSibling.classList.add('hidden');
                        otherBtn.nextElementSibling.classList.remove('flex');
                        otherBtn.querySelector('.dropdown-icon').classList.remove('rotate-180');
                        otherBtn.classList.remove('bg-brand-50', 'text-brand-600');
                    }
                });

                // Toggle current dropdown
                const menu = this.nextElementSibling;
                const icon = this.querySelector('.dropdown-icon');

                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    menu.classList.add('flex');
                    icon.classList.add('rotate-180');
                    this.classList.add('bg-brand-50', 'text-brand-600');
                } else {
                    menu.classList.add('hidden');
                    menu.classList.remove('flex');
                    icon.classList.remove('rotate-180');
                    this.classList.remove('bg-brand-50', 'text-brand-600');
                }
            });

            // Hover logic for tooltip only when not expanded and sidebar is collapsed (if applicable in your main script)
            btn.addEventListener('mouseenter', function () {
                if (document.getElementById('sidebar').classList.contains('w-20')) {
                    const tooltip = this.querySelector('.sidebar-tooltip');
                    tooltip.classList.remove('invisible', 'opacity-0');
                    tooltip.classList.add('opacity-100', 'visible', 'translate-x-0');
                }
            });

            btn.addEventListener('mouseleave', function () {
                const tooltip = this.querySelector('.sidebar-tooltip');
                tooltip.classList.add('invisible', 'opacity-0');
                tooltip.classList.remove('opacity-100', 'visible', 'translate-x-0');
            });
        });
    });
</script>
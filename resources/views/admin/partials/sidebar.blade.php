<aside id="sidebar"
    class="hidden md:flex flex-col w-64 bg-white border-r border-slate-200/80 shadow-xl z-50 transition-all duration-300 ease-in-out relative h-screen select-none">

    <!-- Sidebar Brand Header -->
    <div class="h-16 flex items-center justify-between px-5 border-b border-slate-100/80 overflow-visible relative z-20 bg-white/90 backdrop-blur-md">
        <div class="flex items-center gap-3 whitespace-nowrap overflow-hidden">
            <div class="flex-shrink-0 flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-brand-50 to-blue-100 border border-brand-200/60 shadow-xs">
                <img src="{{ asset('assets/img/logo_trpl.png') }}" alt="Logo TRPL" class="w-6 h-6 object-contain">
            </div>
            <div class="logo-text transition-all duration-300 opacity-100 overflow-hidden">
                <span class="text-base font-extrabold tracking-tight text-slate-800 block">
                    TRPL <span class="text-brand-600 font-extrabold">Admin</span>
                </span>
            </div>
        </div>

        <button id="toggleBtn"
            class="hidden md:flex absolute -right-3 top-5 bg-white border border-slate-200/80 text-slate-400 hover:text-brand-600 rounded-full p-1 shadow-md transition-transform duration-300 hover:scale-110 z-50">
            <i data-lucide="chevron-left" class="w-4 h-4 transition-transform duration-300" id="toggleIcon"></i>
        </button>

        <button id="mobileCloseBtn"
            class="md:hidden text-slate-400 hover:text-red-500 transition-colors p-1 absolute right-4">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    
    <nav class="flex-1 px-3.5 py-5 space-y-2 overflow-y-auto overflow-x-hidden scrollbar-hide z-10">

        <!-- Section: Menu Utama -->
        <div class="section-title px-3 text-[10.5px] font-extrabold text-slate-400 uppercase tracking-widest mb-2.5 mt-2 flex items-center gap-2 whitespace-nowrap overflow-hidden opacity-100">
            <span>Menu Utama</span>
        </div>

        <a href="{{ route('admin.dashboard') }}"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm overflow-hidden 
            {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 font-semibold hover:text-brand-600 hover:bg-slate-50/80' }}">
            <i data-lucide="layout-grid" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('dashboard') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Dashboard</span>
            <div class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Dashboard
            </div>
        </a>

        <!-- Section: Data Kelas -->
        <div class="section-title px-3 text-[10.5px] font-extrabold text-slate-400 uppercase tracking-widest mb-2.5 mt-7 flex items-center gap-2 whitespace-nowrap overflow-hidden opacity-100">
            <span>Data Kelas</span>
        </div>

        <!-- Mahasiswa -->
        <a href="{{ route('admin.members.index') }}"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all cursor-pointer overflow-hidden 
            {{ request()->routeIs('admin.members.*') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 font-semibold hover:text-brand-600 hover:bg-slate-50/80' }}">
            <i data-lucide="users" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('admin.members.*') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Mahasiswa</span>
            <div class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Mahasiswa
            </div>
        </a>

        <!-- Dosen -->
        <a href="{{ route('admin.lecturers.index') }}"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all cursor-pointer overflow-hidden 
            {{ request()->routeIs('admin.lecturers.*') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 font-semibold hover:text-brand-600 hover:bg-slate-50/80' }}">
            <i data-lucide="graduation-cap" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('admin.lecturers.*') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Dosen</span>
            <div class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Dosen
            </div>
        </a>

        <!-- Projects -->
        <a href="{{ route('admin.projects.index') }}"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all cursor-pointer overflow-hidden 
            {{ request()->routeIs('admin.projects.*') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 font-semibold hover:text-brand-600 hover:bg-slate-50/80' }}">
            <i data-lucide="folder-code" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('admin.projects.*') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Projects</span>
            <div class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Projects
            </div>
        </a>

        <!-- Section: Manajemen Konten -->
        <div class="section-title px-3 text-[10.5px] font-extrabold text-slate-400 uppercase tracking-widest mb-2.5 mt-7 flex items-center gap-2 whitespace-nowrap overflow-hidden opacity-100">
            <span>Manajemen Konten</span>
        </div>

        <!-- Logo Kelas -->
        <a href="{{ route('admin.logos.index') }}"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all cursor-pointer overflow-hidden 
            {{ request()->routeIs('admin.logos.*') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 font-semibold hover:text-brand-600 hover:bg-slate-50/80' }}">
            <i data-lucide="aperture" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('admin.logos.*') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Logo Kelas</span>
            <div class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible transition-all duration-200 translate-x-2 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Logo Kelas
            </div>
        </a>

        <!-- Section: Informasi & Kegiatan -->
        <div class="section-title px-3 text-[10.5px] font-extrabold text-slate-400 uppercase tracking-widest mb-2.5 mt-7 flex items-center gap-2 whitespace-nowrap overflow-hidden opacity-100">
            <span>Informasi & Kegiatan</span>
        </div>

        <!-- Dropdown Activities -->
        <div class="nav-item-group">
            <button
                class="dropdown-btn w-full group relative flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-semibold overflow-hidden
                {{ (request()->routeIs('admin.activities.*') || request()->routeIs('admin.albums.*')) ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 hover:text-brand-600 hover:bg-slate-50/80' }}">
                <div class="flex items-center gap-3">
                    <i data-lucide="activity" class="w-5 h-5 flex-shrink-0 transition-all {{ (request()->routeIs('admin.activities.*') || request()->routeIs('admin.albums.*')) ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Kegiatan</span>
                </div>
                <i data-lucide="chevron-down"
                    class="dropdown-icon w-4 h-4 transition-transform duration-300 menu-text opacity-100 {{ (request()->routeIs('admin.activities.*') || request()->routeIs('admin.albums.*')) ? 'rotate-180 text-brand-600' : 'text-slate-400' }}"></i>
            </button>
            <div class="dropdown-menu {{ (request()->routeIs('admin.activities.*') || request()->routeIs('admin.albums.*')) ? 'flex' : 'hidden' }} flex-col gap-1.5 mt-2 ml-4 pl-4 border-l-2 border-slate-100/90">
                <a href="{{ route('admin.activities.index') }}"
                    class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-lg transition-all text-xs font-semibold {{ request()->routeIs('admin.activities.*') ? 'text-brand-600 font-bold bg-brand-50/80 shadow-2xs' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
                    <div class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.activities.*') ? 'bg-brand-600' : 'bg-slate-300' }}"></div>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Daftar Kegiatan</span>
                </a>
                
                <a href="{{ route('admin.albums.index') }}"
                    class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-lg transition-all text-xs font-semibold {{ request()->routeIs('admin.albums.*') ? 'text-brand-600 font-bold bg-brand-50/80 shadow-2xs' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
                    <div class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.albums.*') ? 'bg-brand-600' : 'bg-slate-300' }}"></div>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Galeri Kelas</span>
                </a>
            </div>
        </div>

        <!-- Links -->
        <a href="{{ route('admin.links.index') }}"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all cursor-pointer overflow-hidden 
            {{ request()->routeIs('admin.links.*') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 font-semibold hover:text-brand-600 hover:bg-slate-50/80' }}">
            <i data-lucide="link" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('admin.links.*') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Tautan Penting</span>
            <div class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Tautan Penting
            </div>
        </a>

        <!-- Section: Pengaturan Web -->
        <div class="section-title px-3 text-[10.5px] font-extrabold text-slate-400 uppercase tracking-widest mb-2.5 mt-7 flex items-center gap-2 whitespace-nowrap overflow-hidden opacity-100">
            <span>Pengaturan Web</span>
        </div>

        <!-- Dropdown Tampilan UI -->
        <div class="nav-item-group">
            <button
                class="dropdown-btn w-full group relative flex items-center justify-between px-4 py-3 rounded-xl transition-all text-sm font-semibold overflow-hidden 
                {{ request()->routeIs('admin.heromedia.*') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 hover:text-brand-600 hover:bg-slate-50/80' }}">
                <div class="flex items-center gap-3">
                    <i data-lucide="monitor" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('admin.heromedia.*') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Tampilan</span>
                </div>
                <i data-lucide="chevron-down"
                    class="dropdown-icon w-4 h-4 transition-transform duration-300 menu-text opacity-100 {{ request()->routeIs('admin.heromedia.*') ? 'rotate-180 text-brand-600' : 'text-slate-400' }}"></i>
            </button>
            <div class="dropdown-menu {{ request()->routeIs('admin.heromedia.*') ? 'flex' : 'hidden' }} flex-col gap-1.5 mt-2 ml-4 pl-4 border-l-2 border-slate-100/90">
                <a href="{{ route('admin.heromedia.index') }}"
                    class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-lg transition-all text-xs font-semibold {{ request()->routeIs('admin.heromedia.*') ? 'text-brand-600 font-bold bg-brand-50/80 shadow-2xs' : 'text-slate-500 hover:text-brand-600 hover:bg-slate-50' }}">
                    <div class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.heromedia.*') ? 'bg-brand-600' : 'bg-slate-300' }}"></div>
                    <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Hero Banners</span>
                </a>
            </div>
        </div>

        <!-- Pengaturan Halaman -->
        <a href="{{ route('admin.settings.index') }}"
            class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all cursor-pointer overflow-hidden 
            {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-blue-50/90 via-blue-50/40 to-transparent text-brand-700 font-extrabold border-l-4 border-brand-600 rounded-r-xl shadow-2xs' : 'text-slate-600 font-semibold hover:text-brand-600 hover:bg-slate-50/80' }}">
            <i data-lucide="sliders-horizontal" class="w-5 h-5 flex-shrink-0 transition-all {{ request()->routeIs('admin.settings.*') ? 'text-brand-600' : 'text-slate-400 group-hover:text-brand-600' }}"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Pengaturan Halaman</span>
            <div class="sidebar-tooltip absolute left-14 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Pengaturan Halaman
            </div>
        </a>

    </nav>

    <!-- Sidebar Bottom Logout -->
    <div class="p-4 border-t border-slate-100/80 z-20 bg-slate-50/30">
        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit"
                class="w-full group relative flex items-center justify-start gap-3 px-4 py-3 text-sm font-bold text-rose-600 bg-rose-50/80 hover:bg-rose-100 border border-rose-200/60 rounded-xl transition-all shadow-2xs active:scale-98 cursor-pointer">
                <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0 transition-transform group-hover:-translate-x-0.5"></i>
                <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtns = document.querySelectorAll('.dropdown-btn');

        dropdownBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                dropdownBtns.forEach(otherBtn => {
                    if (otherBtn !== btn) {
                        otherBtn.nextElementSibling.classList.add('hidden');
                        otherBtn.nextElementSibling.classList.remove('flex');
                        otherBtn.querySelector('.dropdown-icon')?.classList.remove('rotate-180', 'text-brand-600');
                    }
                });

                const menu = this.nextElementSibling;
                const icon = this.querySelector('.dropdown-icon');

                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    menu.classList.add('flex');
                    icon?.classList.add('rotate-180', 'text-brand-600');
                } else {
                    menu.classList.add('hidden');
                    menu.classList.remove('flex');
                    icon?.classList.remove('rotate-180', 'text-brand-600');
                }
            });
        });
    });
</script>




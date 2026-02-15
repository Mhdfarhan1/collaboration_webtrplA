<aside id="sidebar"
    class="hidden md:flex flex-col w-64 bg-white border-r border-slate-200 shadow-xl z-50 transition-all duration-300 ease-in-out relative h-screen">

    <div class="h-20 flex items-center justify-between px-4 border-b border-slate-100 overflow-visible relative">

        <div class="flex items-center gap-3 whitespace-nowrap overflow-hidden">
            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10">
                <img src="{{ asset('assets/img/logo_trpl.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div class="logo-text transition-all duration-300 opacity-100 overflow-hidden">
                <span class="text-xl font-bold tracking-tight text-brand-700 block">
                    TRPL <span class="text-slate-400 font-normal">Admin</span>
                </span>
            </div>
        </div>

        <button id="toggleBtn"
            class="hidden md:flex absolute -right-3 top-7 bg-white border border-slate-200 text-slate-400 hover:text-brand-600 rounded-full p-1.5 shadow-md transition-transform duration-300 hover:scale-110 z-50">
            <i data-lucide="chevron-left" class="w-4 h-4 transition-transform duration-300" id="toggleIcon"></i>
        </button>

        <button id="mobileCloseBtn"
            class="md:hidden text-slate-400 hover:text-red-500 transition-colors p-1 absolute right-4">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>

    </div>

    <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto overflow-x-hidden scrollbar-hide">

        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            Menu Utama
        </p>

        <a href="#"
            class="group relative flex items-center gap-3 px-3 py-3 bg-brand-50 text-brand-700 rounded-xl transition-all font-semibold overflow-hidden hover:shadow-sm">
            <i data-lucide="layout-grid" class="w-6 h-6 flex-shrink-0 transition-colors"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Dashboard</span>
            <div
                class="sidebar-tooltip absolute left-16 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Dashboard
            </div>
        </a>

        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            Data Kelas
        </p>

        <a href="#"
            class="group relative flex items-center gap-3 px-3 py-3 text-slate-500 hover:text-brand-600 hover:bg-slate-50 rounded-xl transition-all font-medium overflow-hidden">
            <i data-lucide="users" class="w-6 h-6 flex-shrink-0 transition-colors"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Mahasiswa</span>
            <div
                class="sidebar-tooltip absolute left-16 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Data Mahasiswa
            </div>
        </a>

        <a href="#"
            class="group relative flex items-center gap-3 px-3 py-3 text-slate-500 hover:text-brand-600 hover:bg-slate-50 rounded-xl transition-all font-medium overflow-hidden">
            <i data-lucide="calendar-days" class="w-6 h-6 flex-shrink-0 transition-colors"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Jadwal Kuliah</span>
            <div
                class="sidebar-tooltip absolute left-16 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Jadwal Kuliah
            </div>
        </a>

        <a href="#"
            class="group relative flex items-center gap-3 px-3 py-3 text-slate-500 hover:text-brand-600 hover:bg-slate-50 rounded-xl transition-all font-medium overflow-hidden">
            <i data-lucide="wallet" class="w-6 h-6 flex-shrink-0 transition-colors"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Kas Kelas</span>
            <div
                class="sidebar-tooltip absolute left-16 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Kas & Keuangan
            </div>
        </a>

        <p
            class="section-title px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 transition-all duration-300 whitespace-nowrap overflow-hidden opacity-100">
            List Tim
        </p>

        <a href="#"
            class="group relative flex items-center gap-3 px-3 py-3 text-slate-500 hover:text-brand-600 hover:bg-slate-50 rounded-xl transition-all font-medium overflow-hidden">
            <i data-lucide="file-text" class="w-6 h-6 flex-shrink-0 transition-colors"></i>
            <span class="menu-text whitespace-nowrap transition-all duration-300 opacity-100">Tugas</span>
            <div
                class="sidebar-tooltip absolute left-16 bg-slate-800 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Tugas & Project
            </div>
        </a>

    </nav>

    <div class="p-3 border-t border-slate-100">
        <button
            class="group relative flex items-center w-full px-3 py-2 text-sm text-red-500 hover:bg-red-50 rounded-lg transition-colors font-medium overflow-hidden">
            <i data-lucide="log-out" class="w-6 h-6 flex-shrink-0"></i>
            <span class="menu-text ml-3 whitespace-nowrap transition-all duration-300 opacity-100">Keluar</span>
            <div
                class="sidebar-tooltip absolute left-16 bg-red-600 text-white text-xs px-3 py-2 rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-x-2 group-hover:translate-x-0 z-[60] shadow-lg pointer-events-none whitespace-nowrap hidden">
                Logout
            </div>
        </button>
    </div>
</aside>
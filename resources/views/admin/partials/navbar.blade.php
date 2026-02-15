<header
    class="h-20 bg-white/80 backdrop-blur-lg border-b border-slate-200/60 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40 transition-all duration-300">

    <div class="flex items-center gap-4 relative z-50">

        <button id="mobileMenuBtn"
            class="md:hidden p-2 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors active:bg-slate-200">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <div
            class="hidden md:flex items-center bg-slate-50/50 border border-slate-200 px-4 py-2.5 rounded-full w-96 transition-all duration-300 focus-within:bg-white focus-within:border-brand-300 focus-within:ring-4 focus-within:ring-brand-100 focus-within:shadow-sm group">
            <i data-lucide="search"
                class="w-4 h-4 text-slate-400 group-focus-within:text-brand-500 transition-colors"></i>
            <input type="text" placeholder="Cari mahasiswa, tugas, atau menu..."
                class="bg-transparent border-none outline-none text-sm ml-3 w-full text-slate-700 placeholder-slate-400">
        </div>
    </div>

    <div class="md:hidden absolute left-1/2 transform -translate-x-1/2 pointer-events-none z-10">
        <span
            class="text-lg font-bold bg-gradient-to-r from-brand-700 to-brand-500 bg-clip-text text-transparent whitespace-nowrap">
            TRPL Admin
        </span>
    </div>

    <div class="flex items-center gap-2 md:gap-4 relative z-50">

        <button
            class="relative p-2.5 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all duration-200">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span class="absolute top-2.5 right-2.5 flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white"></span>
            </span>
        </button>

        <div class="h-8 w-[1px] bg-slate-200 mx-1 hidden md:block"></div>

        <button
            class="flex items-center gap-3 p-1.5 pr-3 rounded-full hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all duration-200 group">
            <img src="https://ui-avatars.com/api/?name=Farhan&background=2563eb&color=fff"
                class="w-9 h-9 rounded-full border-2 border-white shadow-sm group-hover:scale-105 transition-transform">

            <div class="text-right hidden md:block">
                <p class="text-sm font-bold text-slate-700 group-hover:text-brand-700 transition-colors leading-tight">
                    Farhan</p>
                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">Ketua Kelas</p>
            </div>

            <i data-lucide="chevron-down"
                class="w-4 h-4 text-slate-300 group-hover:text-slate-500 transition-colors hidden md:block"></i>
        </button>
    </div>

</header>
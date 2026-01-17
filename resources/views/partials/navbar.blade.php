<nav id="navbar-container" class="fixed top-0 left-0 w-full z-50 pt-4 md:pt-6 transition-all duration-300">

    <div class="w-[92%] max-w-7xl mx-auto relative">

        <div id="nav-panel" class="rounded-full px-5 py-3 md:px-8 md:py-4 flex items-center justify-between
                                   bg-white/80 backdrop-blur-xl border border-white/60 
                                   shadow-xl shadow-slate-200/60
                                   transition-all duration-500 ease-in-out relative z-50">

            <div class="flex items-center gap-3 md:gap-8 shrink-0">
                <img src="{{ asset('assets/img/logo_apgi.png') }}" alt="Logo APGI"
                    class="h-10 md:h-14 w-auto object-contain hover:scale-105 transition-transform duration-300">
            </div>

            <ul class="hidden lg:flex items-center gap-1">
                <li><a href="{{ url('/') }}"
                        class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                               hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Home</a>
                </li>
                <li><a href="{{ route('members') }}" class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                         hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Members</a>
                </li>
                <li><a href="#"
                        class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                               hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Albums</a>
                </li>
                <li><a href="#"
                        class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                               hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Projects</a>
                </li>
                <li><a href="#"
                        class="px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 
                               hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300">Activities</a>
                </li>
            </ul>

            <div class="flex items-center gap-3">
                <a href="https://notion.so" target="_blank"
                    class="hidden md:flex items-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-full 
                           text-xs font-bold hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/45/Notion_app_logo.png"
                        class="w-4 h-4 brightness-0 invert" alt="Notion">
                    Notion
                </a>

                <button id="hamburger-btn" onclick="toggleMenu()" class="lg:hidden w-10 h-10 flex flex-col justify-center items-center gap-1.5 p-2 rounded-full 
                               hover:bg-slate-100 transition active:scale-95">
                    <span id="line1" class="w-5 h-0.5 bg-slate-800 rounded-full transition-all duration-300"></span>
                    <span id="line2" class="w-5 h-0.5 bg-slate-800 rounded-full transition-all duration-300"></span>
                    <span id="line3"
                        class="w-3 ml-auto h-0.5 bg-slate-800 rounded-full transition-all duration-300"></span>
                </button>
            </div>
        </div>

        <div id="mobile-menu"
            class="absolute top-full left-0 w-full mt-3
                   origin-top scale-95 opacity-0 invisible transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] z-40">
            <div
                class="bg-white/90 backdrop-blur-2xl border border-white/60 rounded-3xl p-4 shadow-2xl shadow-slate-300/50 flex flex-col gap-1">
                <a href="{{ url('/') }}"
                    class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Home</a>
                <a href="{{ route('members') }}"
                    class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Members</a>
                <a href="#"
                    class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Albums</a>
                <a href="#"
                    class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Projects</a>
                <a href="#"
                    class="text-sm font-bold text-slate-700 py-3 px-5 rounded-2xl hover:bg-slate-100 transition-colors">Activities</a>

                <div class="mt-2 pt-2 border-t border-slate-200">
                    <a href="https://notion.so" target="_blank"
                        class="flex items-center justify-center gap-2 bg-slate-900 text-white py-3 rounded-2xl text-xs font-bold">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/45/Notion_app_logo.png"
                            class="w-3 h-3 brightness-0 invert" alt="">
                        Open Notion
                    </a>
                </div>
            </div>
        </div>

    </div>
</nav>
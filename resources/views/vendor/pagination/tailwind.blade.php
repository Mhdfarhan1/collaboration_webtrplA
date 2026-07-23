@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center my-8">
        <div class="flex items-center gap-1.5 sm:gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 rounded-xl bg-slate-50 text-slate-300 border border-slate-200/60 flex items-center justify-center cursor-not-allowed select-none">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-10 h-10 rounded-xl bg-white text-slate-600 border border-slate-200/80 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 flex items-center justify-center shadow-2xs transition-all active:scale-95">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 border border-slate-200/50 font-bold text-xs flex items-center justify-center select-none">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 rounded-xl bg-blue-600 text-white font-bold text-sm flex items-center justify-center shadow-md shadow-blue-500/30 scale-105 select-none transition-all">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 rounded-xl bg-white text-slate-600 border border-slate-200/80 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 font-bold text-sm flex items-center justify-center shadow-2xs transition-all active:scale-95">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-10 h-10 rounded-xl bg-white text-slate-600 border border-slate-200/80 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 flex items-center justify-center shadow-2xs transition-all active:scale-95">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="w-10 h-10 rounded-xl bg-slate-50 text-slate-300 border border-slate-200/60 flex items-center justify-center cursor-not-allowed select-none">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </span>
            @endif
        </div>
    </nav>
@endif

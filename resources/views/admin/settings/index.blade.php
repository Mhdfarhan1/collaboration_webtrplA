@extends('admin.layouts.app')

@section('title', 'Pengaturan Halaman')

@section('content')
<div class="p-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Pengaturan Halaman</h1>
            <p class="text-sm text-slate-400 mt-1">Kelola teks dan konten yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank"
            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold rounded-xl transition-colors">
            <i data-lucide="external-link" class="w-4 h-4"></i>
            Lihat Halaman
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @php
            $groupLabels = [
                'siapa_kami' => ['label' => 'Siapa Kami?', 'icon' => 'info', 'color' => 'amber'],
                'hero'       => ['label' => 'Hero Section', 'icon' => 'layout', 'color' => 'blue'],
            ];
        @endphp

        @forelse($settings as $group => $items)
        @php
            $meta = $groupLabels[$group] ?? ['label' => ucfirst($group), 'icon' => 'settings', 'color' => 'slate'];
            $color = $meta['color'];
        @endphp

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            {{-- Card Header --}}
            <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100 bg-{{ $color }}-50/50">
                <div class="w-8 h-8 rounded-lg bg-{{ $color }}-100 text-{{ $color }}-600 flex items-center justify-center">
                    <i data-lucide="{{ $meta['icon'] }}" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">{{ $meta['label'] }}</h2>
                    <p class="text-xs text-slate-400">{{ $items->count() }} pengaturan</p>
                </div>
            </div>

            {{-- Fields --}}
            <div class="p-6 space-y-5">
                @foreach($items as $setting)
                <div>
                    <label for="{{ $setting->key }}"
                        class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                        {{ $setting->label }}
                    </label>

                    @if($setting->type === 'textarea')
                    <textarea
                        id="{{ $setting->key }}"
                        name="{{ $setting->key }}"
                        rows="3"
                        class="w-full px-4 py-2.5 text-sm text-slate-700 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition resize-none bg-slate-50 focus:bg-white"
                        placeholder="Masukkan {{ $setting->label }}...">{{ old($setting->key, $setting->value) }}</textarea>
                    @else
                    <input
                        type="text"
                        id="{{ $setting->key }}"
                        name="{{ $setting->key }}"
                        value="{{ old($setting->key, $setting->value) }}"
                        placeholder="Masukkan {{ $setting->label }}..."
                        class="w-full px-4 py-2.5 text-sm text-slate-700 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition bg-slate-50 focus:bg-white">
                    @endif

                    <p class="text-[10px] text-slate-400 mt-1">Key: <code class="font-mono bg-slate-100 px-1 py-0.5 rounded">{{ $setting->key }}</code></p>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-8 text-center">
            <i data-lucide="alert-triangle" class="w-10 h-10 text-amber-400 mx-auto mb-3"></i>
            <p class="text-sm font-semibold text-amber-700">Belum ada pengaturan.</p>
            <p class="text-xs text-amber-500 mt-1">Jalankan <code class="font-mono bg-amber-100 px-1 py-0.5 rounded">php artisan db:seed --class=SettingSeeder</code></p>
        </div>
        @endforelse

        @if($settings->count() > 0)
        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white text-sm font-bold rounded-xl transition-all shadow hover:shadow-md active:scale-95">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Semua Pengaturan
            </button>
        </div>
        @endif

    </form>

</div>
@endsection

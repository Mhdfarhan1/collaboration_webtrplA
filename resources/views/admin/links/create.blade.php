@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-4 sm:mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 sm:mr-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <a href="{{ route('admin.links.index') }}" class="hover:text-brand-600 transition-colors">Tautan Penting</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Tambah</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6 sm:mb-8 mt-6 sm:mt-10 flex items-center justify-between">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Tambah Tautan</h2>
                <p class="text-sm text-slate-500 mt-1">Masukkan data tautan baru yang ingin ditampilkan.</p>
            </div>
            <a href="{{ route('admin.links.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 hover:text-slate-800 transition-all shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden max-w-3xl">
            <form action="{{ route('admin.links.store') }}" method="POST" class="p-6 sm:p-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="link_type" class="block text-sm font-semibold text-slate-700 mb-2">Tipe Tautan <span class="text-red-500">*</span></label>
                        <select id="link_type" name="link_type" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-800 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all sm:text-sm">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="notion" {{ old('link_type') == 'notion' ? 'selected' : '' }}>Notion Kelas</option>
                            <option value="instagram" {{ old('link_type') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="schedule" {{ old('link_type') == 'schedule' ? 'selected' : '' }}>Jadwal Matkul</option>
                        </select>
                        @error('link_type')
                            <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1.5"><i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="link_url" class="block text-sm font-semibold text-slate-700 mb-2">URL Tautan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="link" class="w-5 h-5"></i>
                            </div>
                            <input type="url" id="link_url" name="link_url" value="{{ old('link_url') }}" required placeholder="https://..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-800 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all sm:text-sm">
                        </div>
                        @error('link_url')
                            <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1.5"><i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all shadow-sm">
                        <i data-lucide="save" class="w-4 h-4"></i> Simpan Tautan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

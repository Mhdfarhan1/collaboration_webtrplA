@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-4 sm:mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 sm:mr-2"></i> Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Logo Kelas</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-6 sm:mb-8 mt-6 sm:mt-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Logo Kelas</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola logo-logo kelas yang akan ditampilkan di landing page atau
                komponen web lainnya.</p>
        </div>

        <!-- Alert Success/Error -->
        @if (session('success'))
            <div
                class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div
                class="mb-6 px-4 py-4 bg-red-50 text-red-700 border border-red-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif
        @error('logo_url')
            <div
                class="mb-6 px-4 py-4 bg-red-50 text-red-700 border border-red-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ $message }}</span>
            </div>
        @enderror

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Form Upload (Col 1) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-6">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="upload-cloud" class="w-5 h-5 text-brand-600"></i> Unggah Logo Baru
                        </h3>
                    </div>

                    <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="p-5">
                        @csrf

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">File Gambar Logo <span
                                    class="text-red-500">*</span></label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:bg-slate-50 transition-colors bg-white relative group"
                                id="drop-zone">
                                <div class="space-y-2 text-center">
                                    <div
                                        class="w-12 h-12 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                        <i data-lucide="image-plus" class="w-6 h-6"></i>
                                    </div>
                                    <div class="flex text-sm text-slate-600 justify-center">
                                        <label for="logo_url"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-brand-600 hover:text-brand-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-500">
                                            <span>Pilih file</span>
                                            <input id="logo_url" name="logo_url" type="file" class="sr-only"
                                                accept="image/jpeg,image/png,image/jpg,image/svg+xml,image/webp" required
                                                onchange="previewUpload(event)">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-slate-500">PNG, JPG, SVG, WEBP up to 2MB</p>
                                </div>
                                <img id="preview-image" src="#" alt="Preview"
                                    class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white rounded-xl">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full justify-center inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm">
                            <i data-lucide="upload" class="w-4 h-4"></i> Unggah Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <!-- Galeri Logo (Col 2 & 3) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="image" class="w-5 h-5 text-slate-500"></i> Galeri Logo Eksternal
                        </h3>
                        <span
                            class="bg-brand-100 text-brand-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $logos->count() }}
                            Terunggah</span>
                    </div>

                    <div class="p-5">
                        @if ($logos->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach ($logos as $logo)
                                    <div
                                        class="group relative bg-slate-50 border border-slate-200 rounded-xl overflow-hidden aspect-square flex flex-col items-center justify-center p-4 hover:shadow-md hover:border-brand-300 transition-all">
                                        <!-- Image Display -->
                                        <img src="{{ asset($logo->logo_url) }}" alt="Class Logo"
                                            class="w-full h-full object-contain filter drop-shadow-sm group-hover:scale-110 transition-transform duration-500">

                                        <!-- Overlay with Delete Action -->
                                        <div
                                            class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                            <form action="{{ route('admin.logos.destroy', $logo->logo_id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus logo ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-10 h-10 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 hover:scale-110 shadow-lg transition-all"
                                                    title="Hapus Logo">
                                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="px-6 py-12 text-center text-slate-500 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm border border-slate-100">
                                        <i data-lucide="aperture" class="w-8 h-8 text-slate-300"></i>
                                    </div>
                                    <p class="font-medium text-slate-600">Belum ada logo terunggah</p>
                                    <p class="text-xs text-slate-400 mt-1">Unggah logo pertama Anda melalui form di samping.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewUpload(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('preview-image');

                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                } else {
                    preview.src = '#';
                    preview.classList.add('hidden');
                }
            }
        </script>
    @endpush
@endsection
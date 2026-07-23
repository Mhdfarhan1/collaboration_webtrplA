@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i> Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Logo Kelas</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Card -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="aperture" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Logo Kelas</h2>
                        <p class="text-sm text-slate-500">Kelola identitas visual dan logo mitra/sponsor kelas TRPL A Pagi.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Form Upload -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden sticky top-24">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="cloud-upload" class="w-5 h-5 text-brand-600"></i> Unggah Logo Baru
                        </h3>
                    </div>

                    <form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">File Gambar Logo <span class="text-red-500">*</span></label>

                            <div class="mt-1 flex justify-center px-6 pt-6 pb-6 border-2 border-slate-300 border-dashed rounded-2xl hover:border-brand-500 hover:bg-brand-50/30 transition-all bg-slate-50/50 relative group cursor-pointer"
                                onclick="document.getElementById('logo_url').click()">
                                <div class="space-y-2 text-center pointer-events-none">
                                    <div class="w-12 h-12 bg-white text-brand-600 rounded-2xl flex items-center justify-center mx-auto shadow-xs border border-slate-200/80 group-hover:scale-110 transition-transform">
                                        <i data-lucide="image-plus" class="w-6 h-6"></i>
                                    </div>
                                    <div class="text-sm text-slate-600">
                                        <span class="font-bold text-brand-600">Pilih file logo</span>
                                        <span>atau drag & drop</span>
                                    </div>
                                    <p class="text-[11px] text-slate-400">PNG, SVG, WEBP (Max 2MB)</p>
                                </div>
                                <input id="logo_url" name="logo_url" type="file" class="hidden"
                                    accept="image/jpeg,image/png,image/jpg,image/svg+xml,image/webp" required
                                    onchange="previewUpload(event)">
                                <img id="preview-image" src="#" alt="Preview"
                                    class="absolute inset-0 w-full h-full object-contain p-3 hidden bg-white rounded-2xl shadow-inner">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full justify-center inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                            <i data-lucide="upload" class="w-4 h-4"></i> Unggah Logo
                        </button>
                    </form>
                </div>
            </div>

            <!-- Galeri Logo -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="images" class="w-5 h-5 text-slate-500"></i> Galeri Logo Terunggah
                        </h3>
                        <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200/80 shadow-2xs">{{ $logos->count() }} Logo</span>
                    </div>

                    <div class="p-6">
                        @if ($logos->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach ($logos as $logo)
                                    <div class="group relative bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden aspect-square flex flex-col items-center justify-center p-4 hover:shadow-md hover:border-brand-300 transition-all">
                                        <img src="{{ asset($logo->logo_url) }}" alt="Class Logo"
                                            class="w-full h-full object-contain filter drop-shadow-xs group-hover:scale-110 transition-transform duration-500">

                                        <!-- Overlay with Delete Action -->
                                        <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-xs">
                                            <form action="{{ route('admin.logos.destroy', $logo->logo_id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-11 h-11 rounded-xl bg-red-600 text-white flex items-center justify-center hover:bg-red-700 hover:scale-110 shadow-lg transition-all"
                                                    title="Hapus Logo">
                                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="px-6 py-16 text-center text-slate-500 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-xs border border-slate-200 text-slate-400">
                                    <i data-lucide="aperture" class="w-8 h-8"></i>
                                </div>
                                <h3 class="font-bold text-slate-700 text-base">Belum Ada Logo Terunggah</h3>
                                <p class="text-xs text-slate-400 mt-1">Unggah logo pertama Anda menggunakan formulir di samping.</p>
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
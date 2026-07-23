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
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <a href="{{ route('admin.activities.index') }}"
                            class="hover:text-brand-600 transition-colors">Kegiatan</a>
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

        <!-- Header -->
        <div class="mb-6 sm:mb-8 mt-6 sm:mt-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Tambah Kegiatan Baru</h2>
            <p class="text-slate-500 text-sm mt-1">Buat dokumentasi kegiatan baru untuk ditampilkan di website.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 px-5 py-6 sm:p-8 max-w-3xl">
            <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 sm:space-y-8">
                @csrf

                <!-- Nama Kegiatan -->
                <div>
                    <label for="activity_name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Kegiatan/Event
                        <span class="text-red-500">*</span></label>
                    <input type="text" id="activity_name" name="activity_name" value="{{ old('activity_name') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400 font-medium"
                        placeholder="Contoh: Makrab Mahasiswa 2026">
                    @error('activity_name')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="activity_description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi
                        Kegiatan <span class="text-red-500">*</span></label>
                    <textarea id="activity_description" name="activity_description" rows="4" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Ceritakan detail kegiatan ini secara singkat...">{{ old('activity_description') }}</textarea>
                    @error('activity_description')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar Sampul -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Sampul Utama <span
                            class="text-red-500">*</span></label>
                    <p class="text-xs text-slate-500 mb-3">Pilih satu foto terbaik sebagai thumbnail kegiatan ini. Galeri
                        detail bisa ditambahkan nanti di menu Galeri.</p>

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:bg-slate-50 transition-colors bg-white relative group min-h-[200px]"
                        id="drop-zone">
                        <div class="space-y-2 text-center relative z-10" id="upload-content">
                            <div
                                class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <i data-lucide="image-plus" class="w-8 h-8"></i>
                            </div>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="activity_image"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-brand-600 hover:text-brand-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-500 px-1">
                                    <span>Pilih File</span>
                                    <input id="activity_image" name="activity_image" type="file" class="sr-only"
                                        accept="image/jpeg,image/png,image/jpg,image/webp" required
                                        onchange="previewImage(event)">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP maksimal 2MB</p>
                        </div>
                        <img id="preview" src="#" alt="Preview"
                            class="absolute inset-0 w-full h-full object-cover rounded-xl hidden z-20">
                    </div>
                    @error('activity_image')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                    <a href="{{ route('admin.activities.index') }}"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 transition-colors focus:ring-4 focus:ring-brand-100 shadow-sm">
                        <i data-lucide="save" class="w-4 h-4"></i> Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('preview');
                const uploadContent = document.getElementById('upload-content');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        uploadContent.classList.add('opacity-0');
                        setTimeout(() => uploadContent.classList.add('hidden'), 300);
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '#';
                    preview.classList.add('hidden');
                    uploadContent.classList.remove('hidden', 'opacity-0');
                }
            }
        </script>
    @endpush
@endsection
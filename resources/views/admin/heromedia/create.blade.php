@extends('admin.layouts.app')

@section('content')
    <div class="p-6">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-400"></i>
                        <a href="{{ route('admin.heromedia.index') }}" class="hover:text-brand-600 transition-colors">Hero
                            Banners</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Tambah Banner</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Hero Banner</h2>
            <p class="text-slate-500 text-sm mt-1">Upload gambar dan berikan judul untuk hero banner baru.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
            <form action="{{ route('admin.heromedia.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Hero Title -->
                <div>
                    <label for="hero_title" class="block text-sm font-medium text-slate-700 mb-2">Judul Banner <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title') }}" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Masukkan judul banner...">
                    @error('hero_title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image File -->
                <div>
                    <label for="image_file" class="block text-sm font-medium text-slate-700 mb-2">Gambar Banner <span
                            class="text-red-500">*</span></label>
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-brand-500 hover:bg-slate-50 transition relative">
                        <div class="space-y-1 text-center">
                            <i data-lucide="image" class="mx-auto h-10 w-10 text-slate-400"></i>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="image_file"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-brand-600 hover:text-brand-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-500">
                                    <span>Upload file</span>
                                    <input id="image_file" name="image_file" type="file" class="sr-only" required
                                        accept="image/*">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, GIF hingga 2MB</p>
                        </div>
                    </div>
                    <!-- Preview Image -->
                    <div id="image-preview" class="mt-4 hidden">
                        <p class="text-sm font-medium text-slate-700 mb-2">Preview Gambar:</p>
                        <img id="preview-img" src="#" alt="Preview"
                            class="max-w-xs object-cover rounded-lg border border-slate-200">
                    </div>
                    @error('image_file')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.heromedia.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm">
                        Simpan Banner
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('image_file').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
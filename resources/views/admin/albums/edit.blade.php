@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-5xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 sm:mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <a href="{{ route('admin.albums.index') }}" class="hover:text-brand-600 transition-colors">Galeri</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold truncate">{{ $album->album_name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4 mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Edit Album</h2>
                <p class="text-sm text-slate-500 mt-1">Perbarui informasi album kegiatan kelas.</p>
            </div>
            <a href="{{ route('admin.albums.index') }}"
                class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-700 font-semibold text-sm transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.albums.update', $album->album_id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-8">
                    
                    <div class="space-y-6">
                        <!-- Nama Album -->
                        <div>
                            <label for="album_name" class="block text-sm font-bold text-slate-700 mb-2">Nama Album</label>
                            <input type="text" name="album_name" id="album_name" value="{{ old('album_name', $album->album_name) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-50 focus:border-brand-300 transition-all placeholder:text-slate-400"
                                placeholder="Contoh: Makrab TRPL 2024" required>
                            @error('album_name')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="album_description" class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Singkat</label>
                            <textarea name="album_description" id="album_description" rows="4"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-50 focus:border-brand-300 transition-all placeholder:text-slate-400"
                                placeholder="Berikan sedikit cerita atau konteks tentang album ini..." required>{{ old('album_description', $album->album_description) }}</textarea>
                            @error('album_description')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cover Image -->
                        <div>
                            <label for="album_cover" class="block text-sm font-bold text-slate-700 mb-2">Foto Sampul (Cover)</label>
                            <div class="mt-2 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-2xl hover:border-brand-400 hover:bg-slate-50 transition-all cursor-pointer group relative min-h-[200px]">
                                <div class="space-y-1 text-center">
                                    <i data-lucide="image-plus" class="mx-auto h-12 w-12 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                                    <div class="flex text-sm text-slate-600">
                                        <label for="album_cover" class="relative cursor-pointer bg-white rounded-md font-bold text-brand-600 hover:text-brand-500 focus-within:outline-none">
                                            <span>Upload file baru</span>
                                            <input id="album_cover" name="album_cover" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                        </label>
                                        <p class="pl-1">atau ganti cover</p>
                                    </div>
                                    <p class="text-xs text-slate-500 uppercase font-semibold">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                @if ($album->album_cover)
                                    <img id="preview" src="{{ asset($album->album_cover) }}" class="absolute inset-0 w-full h-full object-cover rounded-2xl">
                                @else
                                    <img id="preview" class="absolute inset-0 w-full h-full object-cover hidden rounded-2xl">
                                @endif
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                                    <p class="text-white text-xs font-bold">Klik untuk ganti foto</p>
                                </div>
                            </div>
                            @error('album_cover')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="button" onclick="window.history.back()" class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</button>
                        <button type="submit" class="px-8 py-2.5 bg-brand-600 text-white text-sm font-bold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all shadow-sm">Simpan Perubahan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
                output.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

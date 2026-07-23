@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-4 sm:mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 sm:mr-2"></i> Dashboard
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
                        <span class="text-slate-700 font-semibold truncate max-w-[150px] sm:max-w-xs">{{ $album->album_name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4 mt-8">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-md border-2 border-white flex-shrink-0">
                    <img src="{{ asset($album->album_cover) }}" alt="" class="w-full h-full object-cover">
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">{{ $album->album_name }}</h2>
                    <p class="text-sm text-slate-500 mt-1 flex items-center gap-2">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        Kelola koleksi foto untuk album ini
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.albums.index') }}"
                class="inline-flex items-center gap-2 text-slate-500 hover:text-brand-600 font-bold text-sm transition-all group">
                <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Upload Box -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 sticky top-24">
                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">
                        <i data-lucide="upload-cloud" class="w-5 h-5 text-brand-600"></i>
                        Upload Foto Baru
                    </h3>
                    
                    <form action="{{ route('admin.albums.images.store', $album->album_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <div class="flex flex-col items-center justify-center w-full min-h-[200px] border-2 border-slate-200 border-dashed rounded-2xl hover:bg-slate-50 hover:border-brand-300 transition-all cursor-pointer relative group">
                                <div class="flex flex-col items-center justify-center p-6 text-center">
                                    <i data-lucide="plus-circle" class="w-10 h-10 text-slate-300 group-hover:text-brand-500 transition-colors mb-4"></i>
                                    <p class="text-sm font-bold text-slate-600">Klik untuk pilih foto</p>
                                    <p class="text-[10px] text-slate-400 mt-1 uppercase font-black tracking-widest">Maksimal 10 foto sekaligus</p>
                                </div>
                                <input type="file" name="images[]" multiple class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" required onchange="showSelectedFiles(this)">
                            </div>
                            
                            <div id="fileList" class="hidden space-y-2 mt-4">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Files Selected:</p>
                                <div id="fileItems" class="text-xs text-slate-600 space-y-1"></div>
                            </div>

                            <button type="submit" class="w-full py-4 bg-brand-600 text-white rounded-2xl font-black text-sm shadow-xl shadow-brand-500/20 hover:bg-brand-700 hover:shadow-brand-500/40 transition-all">
                                Mulai Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Photos Grid -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-200/40 border border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-black text-slate-800 flex items-center gap-2">
                            <i data-lucide="layout-grid" class="w-5 h-5 text-slate-400"></i>
                            Koleksi Foto
                        </h3>
                        <span class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                            {{ count($images) }} Item
                        </span>
                    </div>

                    @if (count($images) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach ($images as $image)
                                <div class="group relative aspect-square rounded-2xl overflow-hidden border border-slate-100 shadow-sm bg-slate-50 transition-all duration-300 hover:shadow-xl hover:shadow-brand-500/10">
                                    <img src="{{ asset($image->image_url) }}" alt="" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    
                                    <!-- Badges -->
                                    <div class="absolute top-2 left-2 flex gap-1">
                                        @if ($image->image_url == $album->album_cover)
                                            <span class="px-2 py-1 rounded-md bg-emerald-500 text-[8px] font-black text-white uppercase tracking-wider shadow-lg">Cover</span>
                                        @endif
                                    </div>

                                    <!-- Overlay Actions -->
                                    <div class="absolute inset-x-0 bottom-0 p-3 bg-linear-to-t from-slate-900/80 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Set as Cover -->
                                            @if ($image->image_url != $album->album_cover)
                                                <form action="{{ route('admin.albums.images.update', [$album->album_id, $image->album_image_id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="p-2 bg-white/90 backdrop-blur-md rounded-lg text-slate-800 hover:bg-brand-600 hover:text-white transition-all tooltip" title="Jadikan Cover">
                                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Delete -->
                                            <form action="{{ route('admin.albums.images.destroy', [$album->album_id, $image->album_image_id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-500/90 backdrop-blur-md rounded-lg text-white hover:bg-red-600 transition-all tooltip" title="Hapus Foto" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-20 text-center bg-slate-50/50 rounded-3xl border-2 border-dashed border-slate-200">
                            <i data-lucide="image-off" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Belum ada foto di galeri ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSelectedFiles(input) {
            const list = document.getElementById('fileList');
            const items = document.getElementById('fileItems');
            items.innerHTML = '';
            
            if(input.files.length > 0) {
                list.classList.remove('hidden');
                for(let i=0; i<input.files.length; i++) {
                    items.innerHTML += `<div>• ${input.files[i].name}</div>`;
                }
            } else {
                list.classList.add('hidden');
            }
        }
    </script>
@endsection

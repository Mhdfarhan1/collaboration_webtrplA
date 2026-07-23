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
                        <a href="{{ route('admin.activities.index') }}" class="hover:text-brand-600 transition-colors">Kegiatan</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Galeri Foto</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 mt-6 sm:mt-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6 bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="w-full sm:w-32 h-32 sm:h-24 rounded-xl overflow-hidden flex-shrink-0 border border-slate-100 bg-slate-50 relative group">
                    @if ($activity->activity_image)
                        <img src="{{ asset($activity->activity_image) }}" alt="{{ $activity->activity_name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center"><i data-lucide="image" class="w-8 h-8 text-slate-300"></i></div>
                    @endif
                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 transition-opacity flex items-center justify-center">
                        <span class="text-white text-[10px] font-bold px-2 py-1 bg-slate-900/60 rounded-lg">Sampul Utama</span>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight">{{ $activity->activity_name }}</h2>
                    <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $activity->activity_description }}</p>
                    <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-brand-50 text-brand-700 border border-brand-200">
                        <i data-lucide="images" class="w-3.5 h-3.5"></i> {{ $media->count() }} Foto Galeri
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Success/Error -->
        @if (session('success'))
            <div class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 px-4 py-4 bg-red-50 text-red-700 border border-red-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 px-4 py-4 bg-red-50 text-red-700 border border-red-200 rounded-xl flex items-start gap-3 animate-fade-in shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5"></i>
                <div>
                    <span class="font-bold text-sm block mb-1">Gagal mengunggah beberapa file:</span>
                    <ul class="text-sm list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- Upload Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-6">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="upload-cloud" class="w-5 h-5 text-brand-600"></i> Tambah Foto
                        </h3>
                    </div>
                    
                    <form action="{{ route('admin.activities.media.store', $activity->activity_id) }}" method="POST" enctype="multipart/form-data" class="p-5">
                        @csrf
                        
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-slate-700 mb-2 border-b border-slate-100 pb-2">Pilih Foto (Bisa lebih dari 1) <span class="text-red-500">*</span></label>
                            
                            <div class="mt-3 flex justify-center px-4 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:bg-slate-50 transition-colors bg-white hover:border-brand-400 group cursor-pointer" onclick="document.getElementById('images').click()">
                                <div class="space-y-2 text-center pointer-events-none">
                                    <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 group-hover:bg-brand-50 group-hover:text-brand-500 transition-all">
                                        <i data-lucide="images" class="w-5 h-5"></i>
                                    </div>
                                    <div class="flex text-sm text-slate-600 justify-center">
                                        <span class="font-medium text-brand-600 group-hover:text-brand-700">Pilih file gambar</span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 px-2 mt-1">Maksimal 10 foto sekaligus. PNG, JPG, WEBP hingga 3MB per foto.</p>
                                </div>
                                <input id="images" name="images[]" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg,image/webp" multiple required onchange="updateFileList(this)">
                            </div>
                            
                            <!-- Preview List -->
                            <div id="file-list" class="mt-4 space-y-2 hidden">
                                <p class="text-xs font-semibold text-slate-600 mb-2">File Terpilih:</p>
                                <ul id="file-names" class="text-xs text-slate-500 space-y-1 bg-slate-50 p-3 rounded-lg border border-slate-100 max-h-32 overflow-y-auto"></ul>
                            </div>
                        </div>

                        <button type="submit" id="submit-btn" class="w-full justify-center inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm opacity-50 cursor-not-allowed" disabled>
                            <i data-lucide="upload" class="w-4 h-4"></i> Unggah Ke Galeri
                        </button>
                    </form>
                </div>
            </div>

            <!-- Galeri Grid -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden min-h-[400px]">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="image" class="w-5 h-5 text-slate-500"></i> Semua Dokumentasi
                        </h3>
                    </div>

                    <div class="p-5">
                        @if ($media->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach ($media as $item)
                                    <div class="group relative rounded-xl overflow-hidden aspect-video sm:aspect-square bg-slate-100 border-2 {{ $activity->activity_image === $item->activity_media_url ? 'border-brand-500 shadow-md ring-2 ring-brand-100' : 'border-transparent border-slate-200' }}">
                                        
                                        <img src="{{ asset($item->activity_media_url) }}" alt="Gallery Item" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        
                                        @if($activity->activity_image === $item->activity_media_url)
                                            <div class="absolute top-2 left-2 bg-brand-600 text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-sm z-20 flex items-center gap-1">
                                                <i data-lucide="star" class="w-3 h-3 fill-white"></i> Sampul
                                            </div>
                                        @endif

                                        <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-sm z-10">
                                            
                                            <!-- Action: Jadikan Sampul -->
                                            @if($activity->activity_image !== $item->activity_media_url)
                                                <form action="{{ route('admin.activities.media.update', [$activity->activity_id, $item->activity_media_id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="px-3 py-1.5 bg-white text-slate-800 text-xs font-bold rounded-lg shadow-lg hover:scale-105 transition-transform flex items-center gap-1.5">
                                                        <i data-lucide="image" class="w-3.5 h-3.5 text-brand-600"></i> Jadikan Sampul
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Action: Hapus -->
                                            <form action="{{ route('admin.activities.media.destroy', [$activity->activity_id, $item->activity_media_id]) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri kegiatan?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-9 h-9 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 hover:scale-110 shadow-lg transition-all mx-auto" title="Hapus Foto">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="px-6 py-12 text-center text-slate-500 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm border border-slate-100">
                                        <i data-lucide="images" class="w-8 h-8 text-slate-300"></i>
                                    </div>
                                    <p class="font-medium text-slate-600">Galeri masih kosong</p>
                                    <p class="text-xs text-slate-400 mt-1 mb-4">Unggah foto-foto dokumentasi untuk meramaikan kegiatan ini.</p>
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
        function updateFileList(input) {
            const listContainer = document.getElementById('file-list');
            const fileNamesList = document.getElementById('file-names');
            const submitBtn = document.getElementById('submit-btn');
            
            fileNamesList.innerHTML = ''; // Reset list
            
            if (input.files.length > 0) {
                // If more than 10 files
                if(input.files.length > 10) {
                    alert('Maksimal 10 foto yang dapat diunggah sekaligus.');
                    input.value = ''; // Reset input
                    listContainer.classList.add('hidden');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    return;
                }

                Array.from(input.files).forEach(file => {
                    const li = document.createElement('li');
                    li.className = 'flex flex-col border-b border-slate-200/50 pb-1 last:border-0 last:pb-0';
                    
                    const nameSpan = document.createElement('span');
                    nameSpan.className = 'truncate font-medium text-slate-700';
                    nameSpan.textContent = file.name;
                    
                    const sizeSpan = document.createElement('span');
                    sizeSpan.className = 'text-[10px] text-slate-400';
                    sizeSpan.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                    
                    li.appendChild(nameSpan);
                    li.appendChild(sizeSpan);
                    fileNamesList.appendChild(li);
                });
                
                listContainer.classList.remove('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                listContainer.classList.add('hidden');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    </script>
    @endpush
@endsection

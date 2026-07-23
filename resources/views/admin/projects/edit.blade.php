@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-3xl mx-auto">
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
                        <a href="{{ route('admin.projects.index') }}"
                            class="hover:text-brand-600 transition-colors">Projects</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Edit Project</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Project</h2>
            <p class="text-slate-500 text-sm mt-1">Ubah detail atau perbarui gambar portofolio kelas.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.projects.update', $project->project_id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Project <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Project <span
                            class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Deskripsikan fitur atau tujuan project ini secara singkat...">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Technologies -->
                <div>
                    <label for="technologies" class="block text-sm font-semibold text-slate-700 mb-2">Teknologi yang
                        Digunakan <span class="text-red-500">*</span></label>
                    <input type="text" id="technologies" name="technologies"
                        value="{{ old('technologies', $techs_string) }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Pisahkan dengan koma (Contoh: Laravel, Tailwind CSS, MySQL)">
                    <p class="text-xs text-slate-500 mt-1.5 flex items-center gap-1.5">
                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                        Pemisahan teks menggunakan koma akan otomatis tersimpan sebagai label terpisah
                    </p>
                    @error('technologies')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <!-- Image -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Featured Image <span
                                class="text-slate-400 font-normal text-xs">(Biarkan kosong jika tidak ingin
                                mengubah)</span></label>
                        <div class="mt-1 flex flex-col md:flex-row items-center gap-6">

                            <!-- Current Image Preview -->
                            <div
                                class="shrink-0 relative w-full md:w-48 h-32 rounded-lg overflow-hidden border-4 border-slate-100 shadow-sm bg-slate-50 flex items-center justify-center">
                                @if ($project->image_url)
                                    <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="image" class="w-8 h-8 text-slate-300"></i>
                                @endif
                            </div>

                            <!-- Upload New Image Area -->
                            <div class="flex-1 w-full">
                                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl group hover:border-brand-500 hover:bg-brand-50 transition-all cursor-pointer relative"
                                    id="drop-zone" onclick="document.getElementById('image_url').click()">
                                    <div class="space-y-2 text-center pointer-events-none">
                                        <div class="flex justify-center" id="image-preview-container">
                                            <i data-lucide="image-plus"
                                                class="w-8 h-8 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                                        </div>
                                        <div class="text-xs text-slate-600">
                                            <span class="rounded-md font-medium text-brand-600">Klik untuk Ganti File</span>
                                        </div>
                                        <p class="text-[10px] text-slate-500">PNG, JPG, WEBP maksimal 2MB (Rekomendasi rasio
                                            16:9)</p>
                                    </div>
                                    <input id="image_url" name="image_url" type="file" class="hidden"
                                        accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImage(event)">
                                </div>
                            </div>

                        </div>
                        @error('image_url')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Manajer Proyek -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="project_manager_id" class="block text-sm font-semibold text-slate-700 mb-2">Manajer Proyek (Manpro)
                            <span class="text-slate-400 font-normal text-xs">(Opsional)</span></label>
                        <select id="project_manager_id" name="project_manager_id"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                            <option value="">Pilih Manpro...</option>
                            @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer->lecturer_id }}" {{ old('project_manager_id', $project->project_manager_id) == $lecturer->lecturer_id ? 'selected' : '' }}>
                                    {{ $lecturer->lecturer_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_manager_id')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Demo URL -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="demo_url" class="block text-sm font-semibold text-slate-700 mb-2">Tautan Demo / Link Web
                            <span class="text-slate-400 font-normal text-xs">(Opsional)</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="link" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <input type="url" id="demo_url" name="demo_url"
                                value="{{ old('demo_url', $project->demo_url) }}"
                                class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                                placeholder="https:// ...">
                        </div>
                        @error('demo_url')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-6 mt-6 flex items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('admin.projects.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 hover:text-slate-800 transition-colors focus:ring-4 focus:ring-slate-100">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-lg hover:bg-brand-700 transition-colors focus:ring-4 focus:ring-brand-200 shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const container = document.getElementById('image-preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    container.innerHTML = `
                            <div class="relative w-20 h-20 rounded-lg overflow-hidden border-2 border-white shadow-sm mx-auto">
                                <img src="${e.target.result}" class="w-full h-full object-cover" />
                            </div>
                        `;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
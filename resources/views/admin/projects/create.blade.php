@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-3xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}"
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
                        <span class="text-slate-700 font-semibold">Tambah Project</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Project Baru</h2>
            <p class="text-slate-500 text-sm mt-1">Masukkan detail project portofolio kelas.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" novalidate
                class="p-6 sm:p-8 space-y-6">
                @csrf

                <!-- Title & Semester Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Project <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="Contoh: Aplikasi Manajemen Keuangan">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="semester" class="block text-sm font-semibold text-slate-700 mb-2">Semester <span
                                class="text-red-500">*</span></label>
                        <select id="semester" name="semester" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester', 1) == $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error('semester')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Project <span
                            class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Deskripsikan fitur atau tujuan project ini secara singkat...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Technologies -->
                <div class="space-y-3">
                    <label for="technologies" class="block text-sm font-semibold text-slate-700">Teknologi yang Digunakan <span class="text-red-500">*</span></label>

                    <!-- Dropdown & Manual Input Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="sm:col-span-1">
                            <select id="tech-dropdown" onchange="addTechFromDropdown(this.value)"
                                class="w-full px-3 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none text-xs font-bold text-slate-700 transition-all cursor-pointer">
                                <option value="">+ Pilih dari Dropdown...</option>
                                @foreach(\App\Helpers\TechHelper::getAllTechs() as $techName => $iconClass)
                                    <option value="{{ $techName }}">{{ $techName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <input type="text" id="technologies" name="technologies" value="{{ old('technologies') }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all text-xs font-medium placeholder:text-slate-400"
                                placeholder="Atau ketik sendiri dipisah koma (Contoh: Laravel, Tailwind CSS, MySQL)">
                        </div>
                    </div>

                    <!-- Quick Preset Badges -->
                    <div class="bg-slate-50/80 p-3 rounded-xl border border-slate-200/80">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Klik untuk Pilih / Hapus Teknologi:</span>
                        <div class="flex flex-wrap gap-1.5 max-h-36 overflow-y-auto pr-1 custom-scrollbar">
                            @foreach(\App\Helpers\TechHelper::getAllTechs() as $techName => $iconUrl)
                                <button type="button" onclick="toggleTechChip('{{ $techName }}')"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white border border-slate-200 text-slate-600 text-xs font-semibold hover:border-brand-500 hover:text-brand-600 transition-all select-none cursor-pointer shadow-2xs">
                                    {!! \App\Helpers\TechHelper::renderIcon($techName) !!}
                                    <span>{{ $techName }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Selected Tech Badges Preview -->
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Teknologi Terpilih:</span>
                        <div id="tech-preview-container" class="flex flex-wrap gap-2 min-h-[36px] p-2 bg-slate-50 rounded-xl border border-dashed border-slate-300 items-center"></div>
                    </div>

                    @error('technologies')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <!-- Image -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="image_url" class="block text-sm font-semibold text-slate-700 mb-2">Featured Image <span
                                class="text-red-500">*</span></label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl group hover:border-brand-500 hover:bg-brand-50 transition-all cursor-pointer relative"
                            id="drop-zone" onclick="document.getElementById('image_url').click()">
                            <div class="space-y-2 text-center pointer-events-none">
                                <div class="flex justify-center" id="image-preview-container">
                                    <i data-lucide="image-plus"
                                        class="w-10 h-10 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                                </div>
                                <div class="text-sm text-slate-600">
                                    <span class="relative rounded-md font-medium text-brand-600">
                                        <span>Upload Thumbnail</span>
                                    </span>
                                    <span>or drag and drop</span>
                                </div>
                                <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB (Rekomendasi rasio 16:9)</p>
                            </div>
                            <input id="image_url" name="image_url" type="file" class="hidden"
                                accept="image/jpeg,image/png,image/jpg,image/webp" required onchange="previewImage(event)">
                        </div>
                        @error('image_url')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Manager -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="project_manager_id" class="block text-sm font-semibold text-slate-700 mb-2">Manajer Proyek (Manpro)
                            <span class="text-slate-400 font-normal text-xs">(Opsional)</span></label>
                        <select id="project_manager_id" name="project_manager_id"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                            <option value="">Pilih Manpro...</option>
                            @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer->lecturer_id }}" {{ old('project_manager_id') == $lecturer->lecturer_id ? 'selected' : '' }}>
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
                            <input type="url" id="demo_url" name="demo_url" value="{{ old('demo_url') }}"
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
                        Simpan Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addTechFromDropdown(value) {
            if (!value) return;
            toggleTechChip(value, true);
            document.getElementById('tech-dropdown').value = '';
        }

        function toggleTechChip(techName, forceAdd = false) {
            const input = document.getElementById('technologies');
            if (!input) return;

            let current = input.value.split(',').map(t => t.trim()).filter(t => t.length > 0);
            const index = current.findIndex(t => t.toLowerCase() === techName.toLowerCase());

            if (index >= 0) {
                if (!forceAdd) {
                    current.splice(index, 1);
                }
            } else {
                current.push(techName);
            }

            input.value = current.join(', ');
            updateTechPreview();
        }

        const TECH_ICON_MAP = {
            'laravel': 'fa-brands fa-laravel text-red-500',
            'tailwind': 'fa-solid fa-wind text-cyan-400',
            'bootstrap': 'fa-brands fa-bootstrap text-purple-600',
            'php': 'fa-brands fa-php text-indigo-500',
            'mysql': 'fa-solid fa-database text-blue-600',
            'postgre': 'fa-solid fa-database text-blue-500',
            'react': 'fa-brands fa-react text-sky-400',
            'vue': 'fa-brands fa-vuejs text-emerald-500',
            'javascript': 'fa-brands fa-js text-yellow-500',
            'js': 'fa-brands fa-js text-yellow-500',
            'typescript': 'fa-brands fa-js text-blue-600',
            'ts': 'fa-brands fa-js text-blue-600',
            'python': 'fa-brands fa-python text-blue-500',
            'node': 'fa-brands fa-node-js text-green-600',
            'express': 'fa-solid fa-server text-emerald-600',
            'next': 'fa-brands fa-react text-slate-800',
            'flutter': 'fa-solid fa-mobile-screen-button text-sky-500',
            'golang': 'fa-solid fa-code text-cyan-600',
            'go': 'fa-solid fa-code text-cyan-600',
            'html': 'fa-brands fa-html5 text-orange-500',
            'css': 'fa-brands fa-css3-alt text-blue-500',
            'codeigniter': 'fa-solid fa-fire text-orange-600',
            'firebase': 'fa-solid fa-fire text-amber-500',
            'mongo': 'fa-solid fa-leaf text-emerald-600',
            'docker': 'fa-brands fa-docker text-sky-500',
            'git': 'fa-brands fa-git-alt text-orange-600',
            'figma': 'fa-brands fa-figma text-pink-500',
            'android': 'fa-brands fa-android text-emerald-500',
            'java': 'fa-brands fa-java text-orange-600'
        };

        function getTechIconHtml(tech) {
            const lower = tech.toLowerCase().trim();
            for (const [key, iconClass] of Object.entries(TECH_ICON_MAP)) {
                if (lower.includes(key)) {
                    return `<i class="${iconClass} text-sm"></i>`;
                }
            }
            return `<i class="fa-solid fa-code text-blue-500 text-sm"></i>`;
        }

        function updateTechPreview() {
            const input = document.getElementById('technologies');
            const container = document.getElementById('tech-preview-container');
            if (!input || !container) return;

            const techs = input.value.split(',').map(t => t.trim()).filter(t => t.length > 0);
            container.innerHTML = '';

            if (techs.length === 0) {
                container.innerHTML = '<span class="text-xs text-slate-400 italic">Belum ada teknologi terpilih</span>';
                return;
            }

            techs.forEach(tech => {
                const iconHtml = getTechIconHtml(tech);
                const badge = document.createElement('span');
                badge.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50/90 text-blue-800 text-xs font-bold uppercase border border-blue-200 shadow-2xs cursor-pointer hover:bg-red-50 hover:text-red-700 hover:border-red-200 transition-all';
                badge.title = 'Klik untuk hapus';
                badge.onclick = function() { toggleTechChip(tech); };
                badge.innerHTML = `${iconHtml} <span>${tech}</span> <i class="fa-solid fa-xmark text-[10px] opacity-60"></i>`;
                container.appendChild(badge);
            });
        }

        document.getElementById('technologies')?.addEventListener('input', updateTechPreview);
        document.addEventListener('DOMContentLoaded', updateTechPreview);

        function previewImage(event) {
            const input = event.target;
            const container = document.getElementById('image-preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    container.innerHTML = `
                            <div class="relative w-full max-w-sm h-48 rounded-lg overflow-hidden border-2 border-white shadow-md mx-auto">
                                <img src="${e.target.result}" class="w-full h-full object-cover" />
                            </div>
                        `;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto">
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
                        <a href="{{ route('admin.lecturers.index') }}"
                            class="hover:text-brand-600 transition-colors">Dosen</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Tambah Dosen</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6 flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Pendidik</h2>
                <p class="text-slate-500 text-sm mt-1" id="form-desc">Lengkapi detail profil profesional dosen pembimbing.</p>
            </div>
            <div id="manpro-status" class="hidden animate-bounce">
                <span class="px-4 py-2 bg-amber-100 text-amber-600 text-xs font-black uppercase tracking-widest rounded-full border border-amber-200 flex items-center gap-2">
                    <i data-lucide="briefcase" class="w-3 h-3"></i> Terdaftar di Manager Proyek
                </span>
            </div>
        </div>

        <form action="{{ route('admin.lecturers.store') }}" method="POST" enctype="multipart/form-data" novalidate class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Profile Image & Basic Info -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                        <label class="block text-sm font-bold text-slate-700 mb-4 text-center">Foto Profil</label>
                        <input id="lecturer_image" name="lecturer_image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)">
                        <div class="relative group mx-auto w-32 h-32 rounded-full overflow-hidden border-2 border-dashed border-slate-300 hover:border-brand-500 transition-all cursor-pointer bg-slate-50"
                            onclick="document.getElementById('lecturer_image').click()" id="image-preview-container">
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 group-hover:text-brand-500">
                                <i data-lucide="camera" class="w-8 h-8 mb-1"></i>
                                <span class="text-[10px] font-bold uppercase">Upload</span>
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-400 text-center mt-4 uppercase font-black tracking-widest">Minimal 1:1 • Max 2MB</p>
                        @error('lecturer_image')
                            <p class="text-red-500 text-[10px] mt-1 text-center font-bold">{{ $message }}</p>
                        @enderror

                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <label for="lecturer_type" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Tipe Pendidik <span class="text-red-500">*</span></label>
                            <select name="lecturer_type" id="lecturer_type" onchange="toggleForm(this.value)" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500 outline-none text-sm font-semibold transition-all">
                                <option value="dosen" {{ old('lecturer_type') == 'dosen' ? 'selected' : '' }}>Dosen Pengajar</option>
                                <option value="manpro" {{ old('lecturer_type') == 'manpro' ? 'selected' : '' }}>Manpro (Manager Proyek)</option>
                            </select>
                            @error('lecturer_type')
                                <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox Wali Dosen -->
                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <label class="relative flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-100 transition-all select-none">
                                <input type="checkbox" name="is_advisor" value="1" class="w-5 h-5 rounded-lg border-slate-300 text-brand-600 focus:ring-brand-500 transition-all cursor-pointer" {{ old('is_advisor') ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <p class="text-xs font-black text-slate-700 uppercase tracking-wide">Jadikan Wali Dosen</p>
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">Tandai pendidik ini sebagai Wali Dosen kelas TRPL A Pagi.</p>
                                </div>
                            </label>
                            @error('is_advisor')
                                <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right: Detailed Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Project Selection (Dynamic) -->
                    <div id="project-section" class="bg-white rounded-2xl shadow-sm border-2 border-amber-200 border-dashed p-6 md:p-8">
                        <h3 class="text-sm font-black text-amber-600 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <i data-lucide="briefcase" class="w-4 h-4"></i> Pilih Proyek yang Dikelola (Opsional)
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                            @forelse($projects as $project)
                                <label class="relative flex items-center p-3 bg-slate-50 rounded-xl border border-slate-200 cursor-pointer hover:bg-amber-50 hover:border-amber-200 transition-all group">
                                    <input type="checkbox" name="project_ids[]" value="{{ $project->project_id }}" class="w-5 h-5 rounded-lg border-slate-300 text-brand-600 focus:ring-brand-500">
                                    <div class="ml-3 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="{{ asset($project->image_url) }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-700 leading-tight">{{ $project->title }}</p>
                                            @if($project->projectManager)
                                                <p class="text-[9px] text-slate-400 mt-1 uppercase font-bold">Managed by: {{ $project->projectManager->lecturer_name }}</p>
                                            @else
                                                <p class="text-[9px] text-emerald-500 mt-1 uppercase font-bold">Available</p>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            @empty
                                <p class="col-span-2 text-xs text-slate-400 italic">Belum ada proyek yang tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Identity, Education, & Social Sections (Toggleable) -->
                    <div id="additional-details" class="space-y-6">
                        <!-- Identity & Professional -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
                            <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                                <i data-lucide="user" class="w-4 h-4"></i> Identitas
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="lecturer_name" class="block text-xs font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="lecturer_name" id="lecturer_name" value="{{ old('lecturer_name') }}"
                                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                        placeholder="Contoh: Supardianto">
                                    @error('lecturer_name')
                                        <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="lecturer_title" class="block text-xs font-bold text-slate-700 mb-2">Gelar Akademik <span class="text-red-500">*</span></label>
                                        <input type="text" name="lecturer_title" id="lecturer_title" value="{{ old('lecturer_title') }}"
                                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                            placeholder="Contoh: M.Eng.">
                                        @error('lecturer_title')
                                            <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="lecturer_nip" class="block text-xs font-bold text-slate-700 mb-2" id="label-nip">NIK / NIP <span class="text-red-500">*</span></label>
                                        <input type="text" name="lecturer_nip" id="lecturer_nip" value="{{ old('lecturer_nip') }}"
                                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                            placeholder="Contoh: 113105">
                                        @error('lecturer_nip')
                                            <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="lecturer_position" class="block text-xs font-bold text-slate-700 mb-2">Jabatan / Struktural <span class="text-slate-400 font-normal">(Opsional)</span></label>
                                        <input type="text" name="lecturer_position" id="lecturer_position" value="{{ old('lecturer_position') }}"
                                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                            placeholder="Contoh: Kepala Program Studi Teknologi Rekayasa Perangkat Lunak">
                                        @error('lecturer_position')
                                            <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="lecturer_email" class="block text-xs font-bold text-slate-700 mb-2">Email Institusi <span class="text-red-500">*</span></label>
                                        <input type="email" name="lecturer_email" id="lecturer_email" value="{{ old('lecturer_email') }}"
                                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                            placeholder="email@polibatam.ac.id">
                                        @error('lecturer_email')
                                            <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="lecturer_expertise" class="block text-xs font-bold text-slate-700 mb-2" id="label-expertise">Bidang Spesialis <span class="text-red-500">*</span></label>
                                        <input type="text" name="lecturer_expertise" id="lecturer_expertise" value="{{ old('lecturer_expertise') }}"
                                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                            placeholder="Contoh: Ilmu Komputer">
                                        @error('lecturer_expertise')
                                            <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Education Section -->
                        <div id="edu-section" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
                            <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                                <i data-lucide="graduation-cap" class="w-4 h-4"></i> Pendidikan Terakhir
                            </h3>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="last_education" class="block text-xs font-bold text-slate-700 mb-2">Pendidikan Tertinggi <span class="text-red-500">*</span></label>
                                    <input type="text" name="last_education" id="last_education" value="{{ old('last_education') }}"
                                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                        placeholder="Contoh: Magister Strata 2 (S2)">
                                    @error('last_education')
                                        <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="education_history" class="block text-xs font-bold text-slate-700 mb-2">Riwayat Pendidikan (Satu baris per entri) <span class="text-red-500">*</span></label>
                                    <textarea name="education_history" id="education_history" rows="4"
                                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 outline-none transition-all placeholder:text-slate-300 text-sm font-medium"
                                        placeholder="Contoh:&#10;Sarjana (S1) Institut Teknologi Bandung : Teknik Media Digital&#10;Magister (S2) Universitas Gadjah Mada : Teknologi Informasi">{{ old('education_history') }}</textarea>
                                    @error('education_history')
                                        <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Social / Professional Links -->
                        <div id="social-section" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
                            <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                                <i data-lucide="link" class="w-4 h-4"></i> Tautan Profesional
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none"><i class="fa-solid fa-graduation-cap text-indigo-600 text-sm"></i></span>
                                    <input type="url" name="scholar_url" value="{{ old('scholar_url') }}" placeholder="Google Scholar URL" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-brand-500">
                                </div>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none"><i class="fa-solid fa-book-bookmark text-cyan-600 text-sm"></i></span>
                                    <input type="url" name="scopus_url" value="{{ old('scopus_url') }}" placeholder="Scopus URL" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-brand-500">
                                </div>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none"><i class="fa-brands fa-linkedin text-blue-600 text-sm"></i></span>
                                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="LinkedIn URL" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-brand-500">
                                </div>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none"><i class="fa-brands fa-instagram text-pink-600 text-sm"></i></span>
                                    <input type="url" name="instagram_url" value="{{ old('instagram_url') }}" placeholder="Instagram URL" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-brand-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4">
                        <a href="{{ route('admin.lecturers.index') }}"
                            class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-2.5 bg-brand-600 text-white text-sm font-bold rounded-xl hover:bg-brand-700 shadow-xl shadow-brand-200 transition-all">
                            Simpan Profil
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleForm(val) {
            const manproStatus = document.getElementById('manpro-status');
            const formDesc = document.getElementById('form-desc');
            const additionalDetails = document.getElementById('additional-details');
            const projectSection = document.getElementById('project-section');

            if (val === 'manpro') {
                manproStatus.classList.remove('hidden');
                formDesc.innerText = 'Pilih proyek untuk dikelola oleh Manager Proyek ini.';
                additionalDetails.classList.add('hidden');
                projectSection.classList.remove('hidden');
            } else {
                manproStatus.classList.add('hidden');
                formDesc.innerText = 'Lengkapi detail profil profesional dosen pembimbing.';
                additionalDetails.classList.remove('hidden');
                projectSection.classList.add('hidden');
            }
        }

        // Initialize on load
        window.onload = () => {
            toggleForm(document.getElementById('lecturer_type').value);
        }

        function previewImage(event) {
            const input = event.target;
            const container = document.getElementById('image-preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    container.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                            <i data-lucide="camera" class="w-6 h-6 text-white"></i>
                        </div>
                    `;
                    lucide.createIcons();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection

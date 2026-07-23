@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-2xl mx-auto">
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
                        <a href="{{ route('admin.members.index') }}"
                            class="hover:text-brand-600 transition-colors">Mahasiswa</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Edit Mahasiswa</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Mahasiswa</h2>
            <p class="text-slate-500 text-sm mt-1">Ubah informasi anggota kelas atau perbarui fotonya.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.members.update', $member->member_id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="member_name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="member_name" name="member_name"
                        value="{{ old('member_name', $member->member_name) }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400">
                    @error('member_name')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIM -->
                <div>
                    <label for="member_nim" class="block text-sm font-semibold text-slate-700 mb-2">NIM <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="member_nim" name="member_nim"
                        value="{{ old('member_nim', $member->member_nim) }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all text-slate-700 placeholder:text-slate-400">
                    @error('member_nim')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Mahasiswa <span
                            class="text-slate-400 font-normal text-xs">(Biarkan kosong jika tidak ingin
                            mengubah)</span></label>
                    <div class="mt-1 flex items-center gap-6">
                        <!-- Current Image Preview -->
                        <div
                            class="shrink-0 relative w-24 h-24 rounded-full overflow-hidden border-4 border-slate-100 shadow-sm bg-slate-50 flex items-center justify-center">
                            @if ($member->member_image)
                                <img src="{{ asset($member->member_image) }}" alt="{{ $member->member_name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <i data-lucide="user" class="w-10 h-10 text-slate-300"></i>
                            @endif
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl group hover:border-brand-500 hover:bg-brand-50 transition-all cursor-pointer relative"
                                id="drop-zone" onclick="document.getElementById('member_image').click()">
                                <div class="space-y-2 text-center pointer-events-none">
                                    <div class="flex justify-center" id="image-preview-container">
                                        <i data-lucide="image-plus"
                                            class="w-8 h-8 text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                                    </div>
                                    <div class="text-xs text-slate-600">
                                        <span class="rounded-md font-medium text-brand-600">Klik untuk Ganti Foto</span>
                                    </div>
                                </div>
                                <input id="member_image" name="member_image" type="file" class="hidden"
                                    accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImage(event)">
                            </div>
                        </div>
                    </div>
                    @error('member_image')
                        <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Social Media URLs -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-700">Tautan Media Sosial (Opsional)</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Instagram -->
                        <div>
                            <label for="instagram_url" class="block text-xs font-medium text-slate-500 mb-1">Instagram
                                URL</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="instagram" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <input type="url" id="instagram_url" name="instagram_url"
                                    value="{{ old('instagram_url', $member->instagram_url) }}"
                                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400 text-sm"
                                    placeholder="https://instagram.com/...">
                            </div>
                            @error('instagram_url')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- LinkedIn -->
                        <div>
                            <label for="linkedin_url" class="block text-xs font-medium text-slate-500 mb-1">LinkedIn
                                URL</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="linkedin" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <input type="url" id="linkedin_url" name="linkedin_url"
                                    value="{{ old('linkedin_url', $member->linkedin_url) }}"
                                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400 text-sm"
                                    placeholder="https://linkedin.com/in/...">
                            </div>
                            @error('linkedin_url')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- GitHub -->
                        <div>
                            <label for="github_url" class="block text-xs font-medium text-slate-500 mb-1">GitHub URL</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="github" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <input type="url" id="github_url" name="github_url"
                                    value="{{ old('github_url', $member->github_url) }}"
                                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400 text-sm"
                                    placeholder="https://github.com/...">
                            </div>
                            @error('github_url')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Core Team Toggle -->
                <div class="pt-4 border-t border-slate-100">
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" name="member_is_core" value="1" class="sr-only peer" {{ old('member_is_core', $member->member_is_core) ? 'checked' : '' }}>
                        <div
                            class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 group-hover:bg-slate-300 peer-checked:group-hover:bg-brand-700">
                        </div>
                        <span class="ml-3 text-sm font-semibold text-slate-700">Jadikan Core Team?</span>
                    </label>
                    <p class="text-xs text-slate-500 mt-1 ml-14">Aktifkan ini jika mahasiswa ini adalah pengurus inti kelas
                        (ketua, bendahara, dll).</p>
                </div>

                <div class="pt-6 mt-6 flex items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('admin.members.index') }}"
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
                                <div class="relative w-20 h-20 rounded-full overflow-hidden border-2 border-white shadow-sm mx-auto">
                                    <img src="${e.target.result}" class="w-full h-full object-cover" />
                                </div>
                            `;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
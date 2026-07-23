@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-4 sm:mb-6 text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 sm:mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <a href="{{ route('admin.projects.index') }}"
                            class="hover:text-brand-600 transition-colors">Projects</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Kelola Tim</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 mt-6 sm:mt-10">
            <div class="flex items-center gap-4 sm:gap-6 bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="w-20 sm:w-28 h-20 sm:h-20 rounded-xl overflow-hidden flex-shrink-0 border border-slate-100 bg-slate-50 flex justify-center items-center">
                    @if ($project->image_url)
                        <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                    @else
                        <i data-lucide="image" class="w-8 h-8 text-slate-300"></i>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight">{{ $project->title }}</h2>
                    <p class="text-sm text-slate-500 mt-1 line-clamp-2">Kelola anggota tim mahasiswa yang berkontribusi pada project ini.</p>
                </div>
            </div>
        </div>

        <!-- Alert Success/Error -->
        @if (session('success'))
            <div
                class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div
                class="mb-6 px-4 py-4 bg-red-50 text-red-700 border border-red-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- Tambah Anggota Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-6">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="user-plus" class="w-5 h-5 text-brand-600"></i> Tambah Anggota
                        </h3>
                    </div>
                    
                    <form action="{{ route('admin.projects.members.store', $project->project_id) }}" method="POST" class="p-5 space-y-5">
                        @csrf
                        
                        <div>
                            <label for="member_id" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Mahasiswa <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select id="member_id" name="member_id" required
                                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all text-slate-700 appearance-none pr-10">
                                    <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                                    @foreach($availableMembers as $member)
                                        <option value="{{ $member->member_id }}" {{ old('member_id') == $member->member_id ? 'selected' : '' }}>
                                            {{ $member->member_name }} ({{ $member->member_nim }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-400">
                                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                </div>
                            </div>
                            @error('member_id')
                                <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                            @enderror
                            @if($availableMembers->isEmpty())
                                <p class="text-amber-600 text-[11px] mt-1.5 font-medium flex items-start gap-1">
                                    <i data-lucide="info" class="w-3.5 h-3.5 flex-shrink-0 mt-0.5"></i>
                                    Semua mahasiswa sudah terdaftar di project ini, atau tidak ada data mahasiswa.
                                </p>
                            @endif
                        </div>

                        <div>
                            <label for="project_member_role" class="block text-sm font-semibold text-slate-700 mb-2">Peran (Role) dalam Tim <span class="text-red-500">*</span></label>
                            <input type="text" id="project_member_role" name="project_member_role" value="{{ old('project_member_role') }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                                placeholder="Contoh: Frontend Developer">
                            @error('project_member_role')
                                <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" @if($availableMembers->isEmpty()) disabled @endif
                            class="w-full justify-center inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            Simpan Anggota
                        </button>
                    </form>
                </div>
            </div>

            <!-- Daftar Anggota Tim -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-lucide="users" class="w-5 h-5 text-slate-500"></i> Daftar Anggota Tim
                        </h3>
                        <span class="bg-brand-100 text-brand-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $teamMembers->count() }} Orang</span>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @forelse ($teamMembers as $projectMember)
                            <div class="p-4 sm:p-5 flex items-center justify-between hover:bg-slate-50/50 transition-colors group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 border border-slate-200 flex-shrink-0">
                                        @if($projectMember->member->member_image)
                                            <img src="{{ asset('storage/' . $projectMember->member->member_image) }}" alt="{{ $projectMember->member->member_name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-brand-100 text-brand-600 font-bold text-sm">
                                                {{ substr($projectMember->member->member_name, 0, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 text-sm">{{ $projectMember->member->member_name }}</h4>
                                        <div class="flex items-center gap-2 mt-0.5 whitespace-nowrap">
                                            <span class="text-xs text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded">{{ $projectMember->member->member_nim }}</span>
                                            <span class="text-[11px] font-medium text-brand-600 flex items-center gap-1">
                                                <i data-lucide="tag" class="w-3 h-3"></i> {{ $projectMember->project_member_role }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <form action="{{ route('admin.projects.members.destroy', [$project->project_id, $projectMember->project_member_id]) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors"
                                        title="Keluarkan dari Tim">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                        <i data-lucide="users" class="w-8 h-8 text-slate-300"></i>
                                    </div>
                                    <p class="font-medium text-slate-600">Belum ada tim yang ditugaskan</p>
                                    <p class="text-xs text-slate-400 mt-1">Tambahkan mahasiswa melalui form di samping.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

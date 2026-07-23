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
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-0.5 sm:mx-1 text-slate-400"></i>
                        <span class="text-slate-700 font-semibold">Dosen</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4 mt-6 sm:mt-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Dosen</h2>
                <p class="text-sm text-slate-500 mt-1">Kelola data dosen pembimbing atau pengajar kelas.</p>
            </div>
            <a href="{{ route('admin.lecturers.create') }}"
                class="w-full sm:w-auto group inline-flex justify-center items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 focus:ring-4 focus:ring-brand-100 transition-all duration-300 shadow-sm hover:shadow-brand-200 hover:-translate-y-0.5">
                <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Dosen</span>
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div
                class="mb-6 px-4 py-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Dosen</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Jabatan</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">NIP / NIDN</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Bidang Keahlian</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($lecturers as $lecturer)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-slate-100 shadow-sm flex-shrink-0 bg-slate-50 flex items-center justify-center">
                                            @if ($lecturer->lecturer_image)
                                                <img src="{{ asset($lecturer->lecturer_image) }}" alt="{{ $lecturer->lecturer_name }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <i data-lucide="user" class="w-6 h-6 text-slate-400"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $lecturer->lecturer_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-100 px-3 py-1.5 rounded-lg inline-block">
                                        {{ $lecturer->lecturer_position ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($lecturer->lecturer_type == 'manpro')
                                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-amber-50 text-amber-600 border border-amber-100">Manpro</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100">Dosen</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-600">
                                    {{ $lecturer->lecturer_nip ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-600 border border-slate-200 inline-block leading-relaxed">
                                        {{ $lecturer->lecturer_expertise ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.lecturers.edit', $lecturer->lecturer_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-brand-600 hover:bg-brand-50 hover:border-brand-200 transition-all shadow-sm tooltip"
                                            title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.lecturers.destroy', $lecturer->lecturer_id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-slate-400 bg-white border border-slate-200 hover:text-red-600 hover:bg-red-50 hover:border-red-200 transition-all shadow-sm tooltip"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                            <i data-lucide="users" class="w-8 h-8 text-slate-300"></i>
                                        </div>
                                        <p class="font-medium text-slate-600">Belum ada data dosen</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden divide-y divide-slate-100">
                @foreach ($lecturers as $lecturer)
                    <div class="p-4 space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-full overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 bg-slate-50 flex items-center justify-center">
                                @if ($lecturer->lecturer_image)
                                    <img src="{{ asset($lecturer->lecturer_image) }}" alt="{{ $lecturer->lecturer_name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="user" class="w-6 h-6 text-slate-400"></i>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 truncate">{{ $lecturer->lecturer_name }}</h3>
                                <p class="text-[10px] font-bold text-brand-600 uppercase tracking-tight">{{ $lecturer->lecturer_position ?? '-' }}</p>
                                <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $lecturer->lecturer_nip ?? '-' }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    @if($lecturer->lecturer_type == 'manpro')
                                        <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest bg-amber-50 text-amber-600 border border-amber-100">Manpro</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100">Dosen</span>
                                    @endif
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-[9px] font-black uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200 leading-tight">
                                        {{ $lecturer->lecturer_expertise ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-50">
                            <a href="{{ route('admin.lecturers.edit', $lecturer->lecturer_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-200 hover:text-brand-600 hover:bg-brand-50 active:bg-brand-100 transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                            </a>
                            <form action="{{ route('admin.lecturers.destroy', $lecturer->lecturer_id) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Hapus data dosen ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-200 hover:text-red-600 hover:bg-red-50 active:bg-red-100 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($lecturers->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $lecturers->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection

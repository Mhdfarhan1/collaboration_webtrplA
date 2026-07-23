@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center hover:text-brand-600 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-1.5 text-slate-400"></i>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 mx-1 text-slate-300"></i>
                        <span class="text-slate-800 font-bold">Dosen</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Dosen</h2>
                        <p class="text-sm text-slate-500">Kelola data dosen pengampu dan manajer proyek kelas.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.lecturers.create') }}"
                class="w-full md:w-auto group inline-flex justify-center items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-600 to-blue-600 text-white text-sm font-bold rounded-xl hover:from-brand-700 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg active:scale-95">
                <i data-lucide="plus" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                <span>Tambah Dosen</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <!-- Table Header Info -->
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total {{ $lecturers->total() }} Dosen</span>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Informasi Dosen</th>
                            <th class="px-6 py-4">Jabatan</th>
                            <th class="px-6 py-4">Tipe / Peran</th>
                            <th class="px-6 py-4">NIP / NIDN</th>
                            <th class="px-6 py-4">Bidang Keahlian</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($lecturers as $lecturer)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-slate-100 shadow-xs flex-shrink-0 bg-slate-100 flex items-center justify-center group-hover:border-blue-300 transition-all">
                                            @if ($lecturer->lecturer_image)
                                                <img src="{{ asset($lecturer->lecturer_image) }}" alt="{{ $lecturer->lecturer_name }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400 font-bold text-sm">
                                                    {{ substr($lecturer->lecturer_name, 0, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-base leading-snug group-hover:text-brand-600 transition-colors">{{ $lecturer->lecturer_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-semibold text-slate-700 bg-slate-100 px-3 py-1 rounded-lg border border-slate-200/60 shadow-2xs inline-block">
                                        {{ $lecturer->lecturer_position ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($lecturer->lecturer_type == 'manpro')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                            <i data-lucide="briefcase" class="w-3 h-3"></i> Manpro
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200/80 shadow-2xs">
                                            <i data-lucide="graduation-cap" class="w-3 h-3"></i> Dosen
                                        </span>
                                    @endif
                                    @if($lecturer->is_advisor)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/80 shadow-2xs mt-1.5">
                                            <i data-lucide="award" class="w-3 h-3"></i> Wali Dosen
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-semibold text-slate-600">
                                        {{ $lecturer->lecturer_nip ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-100/80 text-slate-700 border border-slate-200/60 inline-block shadow-2xs">
                                        {{ $lecturer->lecturer_expertise ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.lecturers.edit', $lecturer->lecturer_id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-amber-600 bg-amber-50 border border-amber-200 hover:bg-amber-500 hover:text-white transition-all shadow-2xs"
                                            title="Edit Data Dosen">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.lecturers.destroy', $lecturer->lecturer_id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-all shadow-2xs"
                                                title="Hapus Dosen">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto space-y-3">
                                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 border border-slate-200 shadow-inner">
                                            <i data-lucide="graduation-cap" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="font-bold text-slate-700 text-base">Belum Ada Data Dosen</h3>
                                        <p class="text-xs text-slate-400">Tambahkan data dosen pengajar untuk mempermudah pembagian manpro & pengampu.</p>
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
                    <div class="p-5 space-y-4 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-full overflow-hidden border border-slate-200 shadow-xs flex-shrink-0 bg-slate-100 flex items-center justify-center">
                                @if ($lecturer->lecturer_image)
                                    <img src="{{ asset($lecturer->lecturer_image) }}" alt="{{ $lecturer->lecturer_name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="font-bold text-slate-500 text-sm">{{ substr($lecturer->lecturer_name, 0, 2) }}</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800 text-base leading-snug truncate">{{ $lecturer->lecturer_name }}</h3>
                                <p class="text-xs font-semibold text-brand-600 mt-0.5">{{ $lecturer->lecturer_position ?? '-' }}</p>
                                <p class="text-xs font-mono text-slate-500 mt-0.5">{{ $lecturer->lecturer_nip ?? '-' }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    @if($lecturer->lecturer_type == 'manpro')
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">Manpro</span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">Dosen</span>
                                    @endif
                                    @if($lecturer->is_advisor)
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Wali Dosen</span>
                                    @endif
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $lecturer->lecturer_expertise ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                            <a href="{{ route('admin.lecturers.edit', $lecturer->lecturer_id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-2 rounded-xl text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 hover:bg-amber-600 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                            </a>
                            <form action="{{ route('admin.lecturers.destroy', $lecturer->lecturer_id) }}" method="POST" class="flex-1 delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 py-2 rounded-xl text-xs font-bold text-red-600 bg-red-50 border border-red-200 hover:bg-red-600 hover:text-white transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($lecturers->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $lecturers->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection


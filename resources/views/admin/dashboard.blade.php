@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="p-6 space-y-6">

        <div
            class="relative w-full bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 text-white shadow-lg overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-3xl font-bold mb-2">Dashboard Admin TRPL</h1>
                <p class="text-blue-100 max-w-xl">
                    Selamat datang kembali! Kelola data mahasiswa, pantau keuangan kas kelas, dan atur jadwal perkuliahan
                    dengan mudah di sini.
                </p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('admin.members.create') }}"
                        class="px-4 py-2 bg-white text-blue-600 text-sm font-semibold rounded-lg shadow hover:bg-blue-50 transition-colors">
                        + Tambah Mahasiswa
                    </a>
                </div>
            </div>
            <div class="absolute right-0 top-0 h-64 w-64 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="bg-white p-5 rounded-xl border border-slate-300 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Mahasiswa</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $counts['members'] }}</h3>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl border border-slate-300 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Projek</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $counts['projects'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                    <i data-lucide="briefcase" class="w-6 h-6"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl border border-slate-300 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Data Galeri</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $counts['albums'] }}</h3>
                </div>
                <div class="p-3 bg-orange-50 text-orange-600 rounded-lg">
                    <i data-lucide="image" class="w-6 h-6"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl border border-slate-300 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kegiatan Kelas</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $counts['activities'] }}</h3>
                </div>
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                    <i data-lucide="calendar" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Member Chart -->
                <div class="bg-white rounded-xl border border-slate-300 shadow-sm p-5">
                    <h3 class="font-bold text-slate-800 text-sm mb-1">Distribusi Anggota</h3>
                    <p class="text-[10px] text-slate-400 mb-4">Perbandingan Anggota Inti vs Biasa</p>
                    <div class="h-[240px]">
                        <canvas id="memberChart"></canvas>
                    </div>
                </div>

                <!-- Content Chart -->
                <div class="bg-white rounded-xl border border-slate-300 shadow-sm p-5">
                    <h3 class="font-bold text-slate-800 text-sm mb-1">Statistik Konten</h3>
                    <p class="text-[10px] text-slate-400 mb-4">Jumlah Projek, Galeri, dan Kegiatan</p>
                    <div class="h-[240px]">
                        <canvas id="contentChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl border border-slate-300 shadow-sm p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-slate-800">Mahasiswa Terbaru</h3>
                        <a href="{{ route('admin.members.index') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($latestMembers as $member)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full border border-slate-100 overflow-hidden bg-slate-50">
                                        @if($member->member_image)
                                            <img src="{{ asset($member->member_image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">
                                                <i data-lucide="user" class="w-4 h-4"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-700">{{ $member->member_name }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $member->member_nim }}</p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $member->member_is_core ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-slate-50 text-slate-500 border border-slate-100' }}">
                                    {{ $member->member_is_core ? 'Core' : 'Member' }}
                                </span>
                            </div>
                        @empty
                            <p class="text-center text-slate-400 text-xs py-4">Belum ada data mahasiswa.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Action Card --}}
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-xl p-5 text-white shadow-lg overflow-hidden relative">
                    <div class="relative z-10">
                        <h4 class="font-bold mb-1">Butuh Bantuan?</h4>
                        <p class="text-slate-400 text-xs mb-4">Hubungi developer jika terjadi kendala pada sistem.</p>
                        <a href="#" class="inline-flex items-center gap-2 text-xs font-bold text-blue-400 hover:text-blue-300 transition-colors">
                            Buka Dokumentasi <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                    <i data-lucide="help-circle" class="absolute -right-4 -bottom-4 w-24 h-24 text-white/5"></i>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Mahasiswa
            const ctxMember = document.getElementById('memberChart');
            new Chart(ctxMember, {
                type: 'doughnut',
                data: {
                    labels: ['Biasa', 'Inti'],
                    datasets: [{
                        data: [
                            {{ $counts['members'] - $counts['core_members'] }}, 
                            {{ $counts['core_members'] }}
                        ],
                        backgroundColor: ['rgba(37, 99, 235, 0.7)', 'rgba(245, 158, 11, 0.7)'],
                        borderColor: ['rgb(37, 99, 235)', 'rgb(245, 158, 11)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } } },
                    cutout: '70%'
                }
            });

            // Chart Konten
            const ctxContent = document.getElementById('contentChart');
            new Chart(ctxContent, {
                type: 'bar',
                data: {
                    labels: ['Projek', 'Galeri', 'Event'],
                    datasets: [{
                        label: 'Total',
                        data: [
                            {{ $counts['projects'] }}, 
                            {{ $counts['albums'] }}, 
                            {{ $counts['activities'] }}
                        ],
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { 
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { font: { size: 10 } } },
                        x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                    }
                }
            });
        });
    </script>
    @endpush
@endsection
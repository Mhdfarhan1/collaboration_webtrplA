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
                    <button
                        class="px-4 py-2 bg-white text-blue-600 text-sm font-semibold rounded-lg shadow hover:bg-blue-50 transition-colors">
                        + Tambah Mahasiswa
                    </button>
                    <button
                        class="px-4 py-2 bg-blue-500 bg-opacity-30 border border-white/30 text-white text-sm font-semibold rounded-lg hover:bg-opacity-40 transition-colors">
                        Lihat Laporan
                    </button>
                </div>
            </div>
            <div class="absolute right-0 top-0 h-64 w-64 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Mahasiswa</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">32</h3>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Saldo Kas</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">Rp 1.250k</h3>
                </div>
                <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                    <i data-lucide="wallet" class="w-6 h-6"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tugas Aktif</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">4</h3>
                </div>
                <div class="p-3 bg-orange-50 text-orange-600 rounded-lg">
                    <i data-lucide="file-text" class="w-6 h-6"></i>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Inventaris Kelas</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">12 <span
                            class="text-xs text-slate-400 font-normal">Item</span></h3>
                </div>
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                    <i data-lucide="box" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-xl border border-slate-100 shadow-sm flex flex-col">
                <div class="p-5 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 text-lg">Jadwal Kuliah Hari Ini</h3>
                    <span class="text-xs font-medium bg-slate-100 text-slate-500 px-2 py-1 rounded">Senin, 16 Feb</span>
                </div>

                <div class="p-5 space-y-4">
                    <div class="flex items-start p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <div
                            class="flex-shrink-0 w-12 h-12 bg-white rounded-lg flex items-center justify-center font-bold text-blue-600 shadow-sm">
                            WEB
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex justify-between items-start">
                                <h4 class="font-bold text-slate-800">Pemrograman Web Lanjut</h4>
                                <span
                                    class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full animate-pulse">Sedang
                                    Berlangsung</span>
                            </div>
                            <p class="text-sm text-slate-500 mt-1">08:00 - 11:30 WIB</p>
                            <div class="flex items-center gap-4 mt-2 text-xs text-slate-500">
                                <span class="flex items-center gap-1"><i data-lucide="user" class="w-3 h-3"></i> Pak Dosen
                                    TRPL</span>
                                <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i> Lab RPL
                                    1</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-start p-4 bg-white rounded-xl border border-slate-100 hover:border-slate-300 transition-colors">
                        <div
                            class="flex-shrink-0 w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center font-bold text-slate-500">
                            PPL
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="font-bold text-slate-800">Proyek Perangkat Lunak</h4>
                            <p class="text-sm text-slate-500 mt-1">13:00 - 15:30 WIB</p>
                            <div class="flex items-center gap-4 mt-2 text-xs text-slate-400">
                                <span class="flex items-center gap-1"><i data-lucide="user" class="w-3 h-3"></i> Bu Dosen
                                    TRPL</span>
                                <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i> Ruang
                                    Teori 704</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">

                <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-5">
                    <h3 class="font-bold text-slate-800 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            class="flex flex-col items-center justify-center p-3 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 rounded-lg border border-slate-100 transition-all group">
                            <i data-lucide="plus-circle" class="w-6 h-6 mb-2 text-slate-400 group-hover:text-blue-600"></i>
                            <span class="text-xs font-medium">Input Kas</span>
                        </button>
                        <button
                            class="flex flex-col items-center justify-center p-3 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 rounded-lg border border-slate-100 transition-all group">
                            <i data-lucide="file-plus" class="w-6 h-6 mb-2 text-slate-400 group-hover:text-blue-600"></i>
                            <span class="text-xs font-medium">Buat Tugas</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-slate-800">Riwayat Kas</h3>
                        <a href="#" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs">
                                    <i data-lucide="arrow-down" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-700">Setoran Mingguan</p>
                                    <p class="text-xs text-slate-400">Farhan • Hari Ini</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-green-600">+ Rp 5.000</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xs">
                                    <i data-lucide="arrow-up" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-700">Beli Spidol</p>
                                    <p class="text-xs text-slate-400">Pengeluaran • Kemarin</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-red-600">- Rp 12.000</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
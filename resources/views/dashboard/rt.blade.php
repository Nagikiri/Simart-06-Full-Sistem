@extends('layouts.app')

@section('title', 'Dashboard - Ketua RT')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 mt-2">Senin, 12 April 2026</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <p class="text-sm font-semibold text-gray-600">RT 06</p>
                <p class="text-xs text-gray-500">Pengurus RT</p>
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
                + Pengumuman
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Warga -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total warga aktif</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">248</p>
                    <p class="text-green-600 text-xs mt-2">+3 bulan ini</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M3 20.585a6 6 0 0112 0M15 12a4 4 0 110-8m6 8a6 6 0 01-12 0"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pengajuan Menunggu -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Pengajuan menunggu</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                    <p class="text-red-600 text-xs mt-2">Perlu ditindaklanjuti</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Surat Diterbitkan -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Surat diterbitkan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">87</p>
                    <p class="text-gray-600 text-xs mt-2">Bulan April 2026</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Aduan Warga -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Aduan warga aktif</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">3</p>
                    <p class="text-red-600 text-xs mt-2">Belum ditangani</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v2m0-6h2m-2 0h-2"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Left Column - 2/3 width -->
        <div class="lg:col-span-2">
            <!-- Pengajuan Surat Terbaru -->
            <div class="bg-white rounded-lg shadow mb-8">
                <div class="border-b border-gray-200 p-6 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-900">Pengajuan surat terbaru</h2>
                    <a href="#" class="text-sm text-gray-500">Lihat semua →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Warga</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Jenis surat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Proses</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm"><strong>Budi Santoso</strong><br><span class="text-xs text-gray-500">6400***0002</span></td>
                                <td class="px-6 py-4 text-sm">Penggantar domisili</td>
                                <td class="px-6 py-4 text-sm">12 Apr 2026</td>
                                <td class="px-6 py-4"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span></td>
                                <td class="px-6 py-4 text-sm text-blue-600 font-medium cursor-pointer">Proses</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm"><strong>Siti Rahayu</strong><br><span class="text-xs text-gray-500">6400***0015</span></td>
                                <td class="px-6 py-4 text-sm">Keterangan usaha</td>
                                <td class="px-6 py-4 text-sm">11 Apr 2026</td>
                                <td class="px-6 py-4"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span></td>
                                <td class="px-6 py-4 text-sm text-blue-600 font-medium cursor-pointer">Proses</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm"><strong>Ahmad Fauzii</strong><br><span class="text-xs text-gray-500">6400***0031</span></td>
                                <td class="px-6 py-4 text-sm">Tidak mampu</td>
                                <td class="px-6 py-4 text-sm">10 Apr 2026</td>
                                <td class="px-6 py-4"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Diproses</span></td>
                                <td class="px-6 py-4 text-sm text-blue-600 font-medium cursor-pointer">Lihat</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm"><strong>Dewi Lestari</strong><br><span class="text-xs text-gray-500">6400***0044</span></td>
                                <td class="px-6 py-4 text-sm">Penggantar umum</td>
                                <td class="px-6 py-4 text-sm">09 Apr 2026</td>
                                <td class="px-6 py-4"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span></td>
                                <td class="px-6 py-4 text-sm text-blue-600 font-medium cursor-pointer">Arsip</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm"><strong>Rudi Hermawan</strong><br><span class="text-xs text-gray-500">6400***0052</span></td>
                                <td class="px-6 py-4 text-sm">Penggantar domisili</td>
                                <td class="px-6 py-4 text-sm">08 Apr 2026</td>
                                <td class="px-6 py-4"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span></td>
                                <td class="px-6 py-4 text-sm text-blue-600 font-medium cursor-pointer">Lihat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tren Pengajuan Surat -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Tren pengajuan surat — April 2026</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Pengantar domisili</span>
                            <span class="text-sm font-bold text-gray-900">36</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full w-4/5"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Keterangan usaha</span>
                            <span class="text-sm font-bold text-gray-900">21</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full w-2/5"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Tidak mampu</span>
                            <span class="text-sm font-bold text-gray-900">15</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full w-1/3"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Pengantar umum</span>
                            <span class="text-sm font-bold text-gray-900">15</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full w-1/3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - 1/3 width -->
        <div>
            <!-- Demografi Warga -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Demografi warga</h3>
                <div class="flex justify-center mb-6">
                    <div id="pieChart" class="w-64 h-64"></div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-600 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-700">Laki-laki</span>
                        </div>
                        <span class="text-sm font-bold text-gray-900">134 (54%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-pink-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-700">Perempuan</span>
                        </div>
                        <span class="text-sm font-bold text-gray-900">114 (46%)</span>
                    </div>
                </div>
            </div>

            <!-- Notifikasi -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex justify-between items-center">
                    <span>Notifikasi</span>
                    <span class="text-sm text-red-600 font-semibold">3 baru</span>
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Pengajuan baru masuk</p>
                            <p class="text-xs text-gray-500">Budi Santoso — 2 menit lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Aduan warga baru</p>
                            <p class="text-xs text-gray-500">Jalan rusak Blok H — 1 jam lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Warga baru terdaftar</p>
                            <p class="text-xs text-gray-500">Siti Rahayu — 3 jam lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
                sparkline: {
                    enabled: false
                }
            },
            colors: ['#2563eb', '#ec4899'],
            series: [134, 114],
            labels: ['Laki-laki', 'Perempuan'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%'
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            }
        };

        var chart = new ApexCharts(document.querySelector("#pieChart"), options);
        chart.render();
    </script>
@endsection

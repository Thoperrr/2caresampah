@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Bank Sampah - {{ Auth::user()->name }}</h1>
                <!-- Date Range Picker -->
                <div class="flex items-center space-x-4">
                    <select class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="daily">Harian</option>
                        <option value="monthly">Bulanan</option>
                        <option value="yearly">Tahunan</option>
                    </select>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Collected Waste -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500">Total Sampah Terkumpul</h2>
                            <p class="text-2xl font-semibold text-gray-900">1,250 Kg</p>
                            <p class="text-sm text-green-600">+12.5% dari bulan lalu</p>
                        </div>
                    </div>
                </div>

                <!-- Active Members -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500">Nasabah Aktif</h2>
                            <p class="text-2xl font-semibold text-gray-900">234</p>
                            <p class="text-sm text-blue-600">+8 nasabah baru</p>
                        </div>
                    </div>
                </div>

                <!-- Total Transactions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500">Total Transaksi</h2>
                            <p class="text-2xl font-semibold text-gray-900">1,543</p>
                            <p class="text-sm text-purple-600">128 transaksi hari ini</p>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500">Pendapatan</h2>
                            <p class="text-2xl font-semibold text-gray-900">Rp 15.2M</p>
                            <p class="text-sm text-yellow-600">+21% dari bulan lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Request Section -->
            <div class="bg-white rounded-lg shadow-md mb-8">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">List Request Penjemputan Sampah</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($pickupRequests as $request)
                            <div class="bg-gray-50 rounded-xl shadow border border-gray-100 p-5 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="inline-block w-3 h-3 rounded-full bg-green-300"></span>
                                        <div>
                                            <div class="font-semibold text-gray-800">{{ $request->user->name }}</div>
                                            <div class="text-xs text-gray-400">
                                                {{ $request->created_at->format('d M Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-3 space-y-1">
                                        <div class="text-gray-600 text-sm">
                                            <span class="font-medium">Alamat:</span>
                                            <span>{{ $request->alamat }}</span>
                                        </div>
                                        @if(isset($request->jenis_sampah))
                                        <div class="text-gray-600 text-sm">
                                            <span class="font-medium">Jenis Sampah:</span>
                                            <span>{{ $request->jenis_sampah }}</span>
                                        </div>
                                        @endif
                                        <div class="text-gray-600 text-sm">
                                            <span class="font-medium">Tanggal Penjemputan:</span>
                                            @if($request->pickup_date)
                                                <span>{{ \Carbon\Carbon::parse($request->pickup_date)->format('d M Y') }}</span>
                                            @else
                                                <span class="text-red-500">Belum Dijadwalkan</span>
                                            @endif
                                        </div>
                                        <div class="text-gray-600 text-sm">
                                            <span class="font-medium">Status:</span>
                                            <span>
                                                @if($request->status == 'Assigned')
                                                    <span class="text-green-600 font-semibold">Sudah Ditugaskan</span>
                                                @else
                                                    <span class="text-red-600 font-semibold">Belum Ditugaskan</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-4">
                                @if($request->status == 'Pending')
                                    <button 
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded shadow transition"
                                        onclick="openAssignModal({{ $request->id }})">
                                        Atur Jadwal
                                    </button>
                                @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center text-gray-500 py-10">
                                Tidak ada request penjemputan.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Activities Table -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Aktivitas Terbaru</h3>
                    <button class="text-green-600 hover:text-green-700 font-medium">Lihat Semua</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nasabah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Sampah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Berat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Poin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-200"></div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Ahmad Subarjo</div>
                                            <div class="text-sm text-gray-500">ID: #12345</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Plastik</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5.2 Kg</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">260</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-04-17</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    @include('bank.assign-jadwal-modal')
@endsection
@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Request Penukaran Poin</h2>
            <a href="{{ route('points.redemptions.create') }}"
                class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow transition">
                + Request Penukaran
            </a>
        </div>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Poin</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Jumlah (Rp)</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Metode</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Tujuan</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($redemptions as $redempt)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ number_format($redempt->points) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Rp {{ number_format($redempt->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 text-sm capitalize text-gray-700">{{ $redempt->method }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $redempt->destination }}</td>
                            <td class="px-4 py-2 text-sm">
                                @if($redempt->status == 'pending')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Pending</span>
                                @elseif($redempt->status == 'approved')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Approved</span>
                                @elseif($redempt->status == 'cancelled')
                                    <span class="px-2 py-1 bg-gray-200 text-gray-600 rounded text-xs">Cancelled</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Rejected</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $redempt->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 text-sm">
                                @if($redempt->status == 'pending')
                                    <form action="{{ route('points.redemptions.cancel', $redempt->id) }}" method="POST"
                                        onsubmit="return confirm('Batalkan request ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Batalkan</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-400">Belum ada request penukaran poin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('layouts.footer')
@endsection
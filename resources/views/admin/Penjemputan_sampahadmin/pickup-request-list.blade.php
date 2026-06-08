<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-lg font-semibold mb-4">Daftar Request Penjemputan Sampah</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nasabah</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis Sampah</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Berat (kg)</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Request</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Penjemputan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Petugas</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($requests as $request)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $request->id }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $request->user ? $request->user->name : '-' }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $request->alamat }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $request->jenis_sampah }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $request->berat ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $request->created_at ? $request->created_at->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        @if($request->pickup_date)
                            {{ \Carbon\Carbon::parse($request->pickup_date)->format('d M Y') }}
                        @else
                            <span class="text-red-500">Belum Dijadwalkan</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-sm">
                        @if($request->status == 'Assigned')
                            <span class="text-green-600 font-semibold">Sudah Ditugaskan</span>
                        @else
                            <span class="text-yellow-600 font-semibold">Belum Ditugaskan</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $request->collector ? $request->collector->name : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-gray-500 py-6">Tidak ada request penjemputan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

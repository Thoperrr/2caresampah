<aside class="w-72 bg-white shadow rounded-xl p-4">
    <h2 class="text-lg font-bold mb-4 text-green-700">Ringkasan Penukaran Sampah</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-green-50 text-green-700">
                    <th class="px-2 py-1 text-left">User</th>
                    <th class="px-2 py-1 text-left">Jenis Sampah</th>
                    <th class="px-2 py-1 text-left">Berat (kg)</th>
                    <th class="px-2 py-1 text-left">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($exchanges as $exchange)
                    <tr class="border-b">
                        <td class="px-2 py-1">{{ $exchange->user->name }}</td>
                        <td class="px-2 py-1">{{ $exchange->waste->name }}</td>
                        <td class="px-2 py-1">{{ $exchange->weight }}</td>
                        <td class="px-2 py-1">
                            <span class="inline-block px-2 py-0.5 rounded {{ $exchange->pickup_option == 'antar' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $exchange->pickup_option == 'antar' ? 'Antar Sendiri' : 'Dijemput' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-400 py-4">Belum ada data penukaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</aside>

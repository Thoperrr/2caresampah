@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    @include('admin.layouts.sidebar')

    <div class="w-full px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">📋 Daftar Bank Sampah</h1>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">List Bank Sampah</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Operational Hours</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waste Types</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bankAccounts as $index => $bank)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-700">{{ $bank->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $bank->bankProfile->location ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $bank->bankProfile->contact ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $bank->bankProfile->operational_hours ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $bank->bankProfile->waste_types ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($bank->bankProfile && $bank->bankProfile->logo)
                                        <img src="{{ asset('storage/' . $bank->bankProfile->logo) }}" alt="Logo" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400">No Logo</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No Bank Sampah found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

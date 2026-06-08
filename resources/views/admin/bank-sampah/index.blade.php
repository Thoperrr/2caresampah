@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    <div class="flex-1 bg-gray-50 min-h-screen p-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Bank Sampah Management</h1>
        </div>
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.bank.bank-sampah.index') }}" class="flex flex-wrap gap-2 mb-6">
                <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                <select name="status" class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Filter</button>
            </form>
        </div>
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Bank Sampah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waste Types</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Operational Hours</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($banks as $bank)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $bank->bankProfile->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $bank->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $bank->bankProfile->waste_types ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $bank->bankProfile->operational_hours ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $bank->status ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' }}">
                                    {{ $bank->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                @if ($bank->status)
                                    <form action="{{ route('admin.clients.bank.deactivate', $bank->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Deactivate</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.clients.bank.activate', $bank->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">Activate</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.clients.bank.edit', $bank->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Edit</a>
                                <form action="{{ route('admin.clients.bank.destroy', $bank->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $banks->links() }}
        </div>
    </div>
</div>
@endsection
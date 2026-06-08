@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="flex min-h-screen bg-gray-50">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Point Redemption Requests</h1>
                    <p class="text-gray-600">Manage user requests for point-to-cash conversion</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (Rp)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($redemptions as $redempt)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $redempt->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ number_format($redempt->points) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($redempt->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm capitalize text-gray-700">{{ $redempt->method }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $redempt->destination }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($redempt->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-700 border border-yellow-400 text-xs font-medium">
                                            Pending
                                        </span>
                                    @elseif($redempt->status == 'approved')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-green-100 text-green-700 border border-green-400 text-xs font-medium">
                                            Approved
                                        </span>
                                    @elseif($redempt->status == 'cancelled')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-gray-200 text-gray-600 border border-gray-300 text-xs font-medium">
                                            Cancelled
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-red-100 text-red-700 border border-red-400 text-xs font-medium">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $redempt->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                    @if($redempt->status == 'pending')
                                        <a href="{{ route('admin.redemptions.approve', $redempt->id) }}"
                                            class="text-green-600 hover:text-green-900 hover:underline">Approve</a>
                                        <a href="{{ route('admin.redemptions.reject', $redempt->id) }}"
                                            class="text-red-600 hover:text-red-900 hover:underline">Reject</a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-400">No redemption requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
@endsection
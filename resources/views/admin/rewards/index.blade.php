@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="flex min-h-screen bg-gray-50">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Rewards</h1>
                    <p class="text-gray-600">Manage reward options for users</p>
                </div>

                <a href="{{ route('admin.rewards.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Reward
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Points Required</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cash
                                Value (IDR)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($rewards as $reward)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ number_format($reward->points_required) }} points
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Rp {{ number_format($reward->cash_value, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <button onclick="toggleStatus({{ $reward->id }})" class="inline-flex items-center px-3 py-1.5 rounded-full font-medium text-sm transition-colors duration-150 ease-in-out
                                                                                            {{ $reward->is_active
                            ? 'bg-green-100 text-green-700 hover:bg-green-200 border border-green-400'
                            : 'bg-red-100 text-red-700 hover:bg-red-200 border border-red-400' 
                                                                                            }}">
                                                    <span
                                                        class="w-2 h-2 rounded-full mr-2 
                                                                                            {{ $reward->is_active ? 'bg-green-600' : 'bg-red-600' }}">
                                                    </span>
                                                    {{ $reward->is_active ? 'Active' : 'Inactive' }}
                                                </button>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                                <a href="{{ route('admin.rewards.edit', $reward) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <button onclick="openDeleteModal('{{ route('admin.rewards.destroy', $reward) }}')"
                                                    class="text-red-600 hover:text-red-900">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script>
        function toggleStatus(rewardId) {
            if (confirm('Apakah Anda yakin ingin mengubah status reward ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/rewards/${rewardId}/toggle-status`;
                form.innerHTML = `
                                                            @csrf
                                                            @method('PATCH')
                                                        `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Confirm Deletion</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this reward?</p>
                <div class="flex justify-end space-x-4">
                    <button onclick="closeDeleteModal()"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            Confirm
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(deleteUrl) {
            document.getElementById('deleteForm').action = deleteUrl;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection
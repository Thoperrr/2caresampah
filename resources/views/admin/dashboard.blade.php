@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="flex min-h-screen bg-gray-50">
        @include('admin.layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}</p>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Points Issued</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalPointsIssued }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Points Spent</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalPointsSpent }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Users</p>
                            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Transactions</p>
                            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Point::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Points Activity</h2>
                    <div id="points-activity-chart" class="h-80"></div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">User Growth</h2>
                    <div id="user-growth-chart" class="h-80"></div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
                    <a href="#" class="text-green-600 hover:underline text-sm font-medium">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach(\App\Models\Point::with('user')->latest()->take(5)->get() as $point)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <img class="h-8 w-8 rounded-full" src="{{ $point->user->profile_photo ? asset('storage/' . $point->user->profile_photo) : asset('storage/profile-photos/default-avatar.jpg') }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $point->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $point->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $point->type == 'earned' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($point->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $point->amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $point->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $point->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script>
        // Points Activity Chart
        const pointsActivityOptions = {
            chart: {
                height: 320,
                type: 'area',
                toolbar: {
                    show: false
                },
                fontFamily: 'Inter, sans-serif',
            },
            series: [{
                name: 'Points Issued',
                data: [{{ $totalPointsIssued }}], 
            }, {
                name: 'Points Spent',
                data: [{{ $totalPointsSpent }}], 
            }],
            xaxis: {
                categories: ['Total'],
                labels: {
                    style: {
                        fontFamily: 'Inter, sans-serif',
                    },
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            colors: ['#10B981', '#3B82F6'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    opacityFrom: 0.7,
                    opacityTo: 0.2,
                },
            },
            tooltip: {
                theme: 'light',
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontFamily: 'Inter, sans-serif',
            },
        };

        const pointsActivityChart = new ApexCharts(
            document.getElementById('points-activity-chart'), 
            pointsActivityOptions
        );
        pointsActivityChart.render();

        // User Growth Chart
        const userGrowthOptions = {
            chart: {
                height: 320,
                type: 'line',
                toolbar: {
                    show: false
                },
                fontFamily: 'Inter, sans-serif',
            },
            series: [{
                name: 'Users',
                data: [{{ \App\Models\User::count() }}], 
            }],
            xaxis: {
                categories: ['Total'],
                labels: {
                    style: {
                        fontFamily: 'Inter, sans-serif',
                    },
                },
            },
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            colors: ['#8B5CF6'],
            markers: {
                size: 4,
                colors: ['#8B5CF6'],
                strokeColors: '#fff',
                strokeWidth: 2,
            },
            tooltip: {
                theme: 'light',
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontFamily: 'Inter, sans-serif',
            },
        };

        const userGrowthChart = new ApexCharts(
            document.getElementById('user-growth-chart'), 
            userGrowthOptions
        );
        userGrowthChart.render();
    </script>
@endsection
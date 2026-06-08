@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="max-w-xl mx-auto mt-10 mb-10 p-6 bg-white rounded-xl shadow-lg text-center relative overflow-hidden border border-gray-200">
    <div class="absolute top-0 left-0 w-full h-1 bg-green-600"></div>
    <h1 class="text-3xl font-extrabold mb-2 text-green-700 drop-shadow">Tantangan Bulanan</h1>
    <p class="mb-6 text-gray-700">
        Kumpulkan minimal <b class="text-green-700">10 kg</b> sampah pada bulan
        <b class="text-green-700">{{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}</b>!
    </p>

    <div class="mb-6">
        <span class="font-semibold text-gray-800">Total Sampah Terkumpul:</span>
        <span class="text-2xl font-bold text-green-700">{{ number_format($totalWeight, 2) }} kg</span>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-gray-100 rounded-full h-6 mb-4 shadow-inner border border-gray-200">
        <div class="bg-green-600 h-6 rounded-full flex items-center justify-center transition-all duration-700"
            style="width: {{ min(100, ($totalWeight/10)*100) }}%">
            <span class="text-white font-bold text-sm drop-shadow">
                {{ min(100, round(($totalWeight/10)*100)) }}%
            </span>
        </div>
    </div>

    @if($isCompleted)
        <div class="flex flex-col items-center mb-4">
            <span class="text-green-700 font-semibold text-lg flex items-center gap-2">Selamat! Tantangan bulan ini sudah tercapai! <span class="text-2xl">🎉</span></span>
        </div>
    @else
        <div class="text-red-600 font-semibold mb-4 flex flex-col items-center">
            <span>Belum tercapai, semangat mengumpulkan sampah!</span>
            <span class="text-xs text-gray-500 mt-1">Ayo, kamu hanya perlu {{ max(0, number_format(10-$totalWeight,2)) }} kg lagi!</span>
        </div>
    @endif

    <div class="mt-6">
        <button onclick="location.reload()" class="px-6 py-2 bg-green-900 hover:bg-green-600 text-white font-bold rounded-full shadow transition duration-300">Refresh Progress</button>
    </div>
</div>

@include('layouts.footer')
@endsection
@extends('layouts.app')

@section('content')

    @include('layouts.header')

    <!-- Judul -->
    <h1 class="text-5xl font-bold text-center mt-6">Leaderboard</h1>
    <h2 class="font-serif italic text-center mb-15">~Bijak lah dalam mengatur sampah~</h2>

    <form method="GET" action="{{ route('gamifikasi.index') }}" class="flex justify-center gap-4 mb-6">
        <select name="month" class="border rounded px-2 py-1">
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('month', now()->month) == $m ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                </option>
            @endforeach
        </select>
        <select name="year" class="border rounded px-2 py-1">
            @for($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
        <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded">Filter</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start max-w-4xl mx-auto">
        <!-- Top 3 -->
        <div class="flex justify-center items-end gap-8 mb-8">
            @foreach($users->take(3) as $i => $user)
                @php
                    // Styling untuk border dan ukuran
                    $border = [
                        'border-yellow-400', // 1st
                        'border-gray-400',   // 2nd
                        'border-amber-700',  // 3rd
                    ][$i] ?? 'border-gray-200';

                    $size = [
                        'w-32 h-32', // 1st
                        'w-28 h-28', // 2nd
                        'w-24 h-24', // 3rd
                    ][$i] ?? 'w-24 h-24';

                    $marginTop = [
                        'mt-0',   // 1st
                        'mt-8',   // 2nd
                        'mt-12',  // 3rd
                    ][$i] ?? 'mt-0';

                    $badgeBg = [
                        'bg-yellow-400', // 1st
                        'bg-gray-400',   // 2nd
                        'bg-amber-700',  // 3rd
                    ][$i] ?? 'bg-gray-200';
                @endphp
                <div class="flex flex-col items-center {{ $marginTop }}">
                    @if($i == 0)
                        <div class="text-3xl mb-2">👑</div>
                    @endif
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-profile.png') }}"
                        alt="{{ $user->name }}'s Avatar"
                        class="rounded-full object-cover mx-auto border-4 {{ $border }} {{ $size }}">
                    <div
                        class="mt-2 {{ $badgeBg }} text-white font-bold w-8 h-8 rounded-full flex items-center justify-center text-sm shadow-md border-2 border-white">
                        {{ $i + 1 }}
                    </div>
                    <div class="text-lg font-semibold mt-2">{{ $user->name }}</div>
                    <div class="text-sm text-gray-600">{{ $user->points ?? 0 }} pts</div>
                    @if(($user->total_weight ?? 0) > 100)
                        <span class="px-3 py-1 bg-blue-900 text-white text-xs rounded-full font-bold shadow animate-pulse">Eco
                            Legend</span>
                    @elseif(($user->total_weight ?? 0) > 50)
                        <span class="px-2 py-0.5 bg-green-700 text-white text-xs rounded-full font-bold shadow animate-pulse">Eco
                            Hero</span>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- 4-10 -->
        <ul class="mt-8 space-y-3">
            @foreach($users->slice(3) as $i => $user)
                <li
                    class="flex items-center justify-between {{ auth()->id() == $user->id ? 'bg-green-200 px-2 py-1 rounded-lg' : '' }}">
                    <span class="flex items-center gap-3">
                        <span class="font-bold">{{ $i + 1 }}</span> {{ $user->name }}
                        @if(($user->total_weight ?? 0) > 100)
                            <span class="ml-2 px-2 py-0.5 bg-blue-900 text-white text-xs rounded-full font-bold animate-pulse">Eco
                                Legend</span>
                        @elseif(($user->total_weight ?? 0) > 50)
                            <span class="ml-2 px-2 py-0.5 bg-green-700 text-white text-xs rounded-full font-bold animate-pulse">Eco
                                Hero</span>
                        @endif
                    </span>
                    <span>{{ $user->points ?? 0 }} pts</span>
                </li>
            @endforeach
        </ul>
    </div>
    @include('layouts.footer')
@endsection
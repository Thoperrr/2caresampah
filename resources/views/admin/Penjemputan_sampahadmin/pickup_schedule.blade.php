@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    {{-- Sidebar --}}
    @include('admin.layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Jadwalkan Penjemputan Sampah</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Daftar Permintaan Penjemputan --}}
        @include('admin.Penjemputan_sampahadmin.pickup-request-list')

        {{-- Modal Assign Petugas --}}
        @include('admin.Penjemputan_sampahadmin.assign-petugas-modal')
    </main>
</div>
@endsection

@extends('layouts.app')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-4xl flex flex-col md:flex-row">
            <!-- Column 1: Logo -->
            <div class="hidden md:flex items-center justify-center w-full md:w-1/2 pr-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="">
            </div>

            <!-- Column 2: Form -->
            <div class="bg-white p-8 rounded shadow-md  w-full md:w-1/2 p-6">
                <h1 class="text-2xl font-bold mb-6 text-center">Nice to see you again!</h1>

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded" required
                            autofocus>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded"
                            required>
                    </div>
                    <div class="mb-4 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="remember" id="remember" class="h-5 w-5 text-blue-600 mr-2">
                            <label for="remember" class="text-gray-700">Remember Me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Lupa
                            password?</a>
                    </div>



                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Login
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Tidak punya akun? Daftar</a>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
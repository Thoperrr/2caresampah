@extends('layouts.app')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-4xl flex flex-col md:flex-row">
            <div class="hidden md:flex items-center justify-center w-full md:w-1/2 pr-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="">
            </div>
            <div class="bg-white p-8 rounded shadow-md  w-full md:w-1/2 p-6">
                <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

                @if ($errors->any())
                    <div class="mb-4 text-red-600 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-150">
                        Sign up
                    </button>
                </form>

                <div class="mt-4 flex justify-center items-center">
                    <span class="text-sm text-gray-600">Or sign up with</span>
                </div>

                <div class="mt-2">
                    <a href="{{ route('login.google') }}"
                        class="w-full flex justify-center items-center bg-black text-white py-2 rounded hover:bg-gray-800">
                        <img src="https://www.google.com/images/branding/googleg/1x/googleg_standard_color_18dp.png"
                            class="w-5 h-5 mr-2" alt="Google logo">
                        Sign up with Google
                    </a>
                </div>

                <div class="mt-4 text-center text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Sign in</a>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
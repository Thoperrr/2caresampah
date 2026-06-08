<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased">
    {{-- Global Alert --}}
    <div class="fixed top-6 right-6 z-50 w-full max-w-sm px-4 flex flex-col items-end space-y-2">
        @if ($errors->any())
        <div x-data="{ show: true, fadeOut: false }" x-show="show"
            x-init="setTimeout(() => { fadeOut = true; setTimeout(() => show = false, 800); }, 5000)" :class="fadeOut
                ? 'animate__animated animate__fadeOutRight'
                : 'animate__animated animate__fadeInRight'"
            class="mb-2 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-lg flex items-start space-x-3"
            style="min-width: 250px;">
            <span class="mt-1"><i class="fas fa-exclamation-circle"></i></span>
            <div>
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button @click="fadeOut = true; setTimeout(() => show = false, 800);"
                class="ml-auto text-red-500 hover:text-red-700 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if (session('success'))
        <div x-data="{ show: true, fadeOut: false }" x-show="show"
            x-init="setTimeout(() => { fadeOut = true; setTimeout(() => show = false, 800); }, 5000)" :class="fadeOut
                ? 'animate__animated animate__fadeOutRight'
                : 'animate__animated animate__fadeInRight'"
            class="mb-2 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg flex items-start space-x-3"
            style="min-width: 250px;">
            <span class="mt-1"><i class="fas fa-check-circle"></i></span>
            <div class="text-sm font-semibold">
                {{ session('success') }}
            </div>
            <button @click="fadeOut = true; setTimeout(() => show = false, 800);"
                class="ml-auto text-green-500 hover:text-green-700 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
    </div>
    {{-- End Global Alert --}}

    @yield('content')
    @stack('scripts')
</body>

</html>
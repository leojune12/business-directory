<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Business Index') }}@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/sass/app.scss',
        ])

        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

        @stack('links')

    </head>
    <body class="font-sans antialiased">
        {{-- <div class="min-h-screen bg-gray-100"> --}}
        <div>
            <!-- Page Content -->
            {{ $slot }}
        </div>

        @stack('scripts')

        <script src="../../bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>

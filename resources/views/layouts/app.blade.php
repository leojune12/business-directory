<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/css/bootstrap.min.css',
            'resources/css/owl.carousel.min.css',
            'resources/css/owl.theme.default.min.css',
            'resources/css/jquery.fancybox.min.css',
            'resources/css/daterangepicker.css',
            'resources/css/aos.css',
            'resources/scss/style.css',
            'resources/fonts/icomoon/style.css',
            'resources/fonts/flaticon/font/flaticon.css',
            'resources/js/app.js',
        ])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            @if (isset($header))
                <!-- <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header> -->
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="{{ Vite::asset('resources/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/popper.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/bootstrap.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/owl.carousel.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/jquery.animateNumber.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/jquery.fancybox.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/aos.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/moment.min.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/daterangepicker.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/typed.js') }}"></script>
        <script>
            $(function() {
                var slides = $('.slides'),
                images = slides.find('img');

                images.each(function(i) {
                    $(this).attr('data-id', i + 1);
                })

                var typed = new Typed('.typed-words', {
                    strings: ["San Francisco."," Paris."," New Zealand.", " Maui.", " London."],
                    typeSpeed: 80,
                    backSpeed: 80,
                    backDelay: 4000,
                    startDelay: 1000,
                    loop: true,
                    showCursor: true,
                    preStringTyped: (arrayPos, self) => {
                        arrayPos++;
                        console.log(arrayPos);
                        $('.slides img').removeClass('active');
                        $('.slides img[data-id="'+arrayPos+'"]').addClass('active');
                    }

                });
            })
        </script>
        <script src="{{ Vite::asset('resources/js/custom.js') }}"></script>
    </body>
</html>

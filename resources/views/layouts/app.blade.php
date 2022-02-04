<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Início ICON Brasil -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-32x32.png') }}" />
    <!-- Fim ICON Brasil -->

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/1d96c2b4cc.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>

    <script src="{{ asset('js/jquery.mask.js') }}" type="text/javascript"></script>

    @livewireStyles

    <style type="text/css">
        .arrow-up {
            width: 0;
            height: 0;
            border-left: 75px solid transparent;
            border-right: 275px solid transparent;
            border-bottom: 17px solid rgba(238,238,238, var(--tw-bg-opacity));;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-white">
        @livewire('navigation-menu',['ano' => session('ano')])

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow-md">
            <div class="max-w-34xl mx-auto pt-2 pb-2 sm:pl-3 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>

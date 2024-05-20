<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Início ICON Brasil -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/brasao.png') }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/brasao.png') }}"/>
    <!-- Fim ICON Brasil -->

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
            crossorigin="anonymous"></script>

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
            border-bottom: 17px solid rgba(238, 238, 238, var(--tw-bg-opacity));;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<x-jet-banner/>

<div class="min-h-screen bg-white">
    @livewire('navigation-menu',['ano' => session('ano')])

    <main>
        <div class="w-full px-4 py-3 ">
            <div class="px-4 py-4 rounded shadow-lg text-slate-800 bg-slate-300 shadow-slate-500/50" role="alert">
                O seu cadastro nesse sistema está como inativo, dessa forma você pode navegar sem restrições pelas
                páginas com conteúdo aberto, mas não poderá acessar ou executar qualquer tipo de gestão nas páginas onde
                é necessário que o usuário esteja logado.
            </div>
        </div>
    </main>
</div>

@stack('modals')

@livewireScripts
</body>
</html>

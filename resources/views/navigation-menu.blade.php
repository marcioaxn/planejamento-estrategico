<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <?php

    $parameters = explode('/', Request::path());

    isset($parameters) && !is_null($parameters) && is_array($parameters) ? $anoSelecionado = $parameters[0] : $anoSelecionado = date('Y');

    if (\Session::has('ano')) {

        $ano = \Session('ano');

        $this->ano = $ano;

    } else {

        $ano = date('Y');

        $this->ano = $ano;

    }

    ?>
    <!-- Primary Navigation Menu -->
    <div class="max-w-34xl mx-auto px-4 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/'.$ano) }}">
                        <x-jet-application-mark class="block h-9 w-auto"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ url('/'.session('ano')) }}" :active="request()->routeIs('pei.*')">
                        {{ __('Planejamento Estratégico Integrado') }}
                    </x-jet-nav-link>
                </div>

                @if(request()->routeIs('profile.show'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ url('user/profile') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-jet-nav-link>
                </div>
                @endif

                <!-- Início da parte do menu para a alteração do Ano -->

                @if(request()->path() != 'user/profile')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex pt-4">

                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">

                                <span class="inline-flex rounded-md">

                                    <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">

                                    {{ $ano }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"/>
                                </svg>

                            </button>

                        </span>

                    </x-slot>

                    <?php

                    $anos = [];
                    for ($index = date('Y') + 1; $index >= 2020; $index -= 1) {
                        $anos[$index * 1] = $index * 1;
                    }

                    ?>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Selecione o ano
                        </div>

                        @foreach($anos as $key => $result)

                        <?php

                        $valor = '';

                        if ($ano == $result) {

                            $valor = 1;

                        } else {

                            $valor = 0;

                        }

                        $urlAtual = $_SERVER['REQUEST_URI'];

                        $url = str_replace(\Session('ano'),$result,$urlAtual);

                        ?>

                        <x-jet-dropdown-link href="{{ $url }}" :active="$valor">
                            {!! $result !!}
                        </x-jet-dropdown-link>

                        @endforeach
                    </x-slot>
                </x-jet-dropdown>
            </div>

        </div>
        @endif

        <!-- Fim da parte do menu para a alteração do Ano -->

        <!-- Início do menu da Administração do Sistema -->

        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="ml-3 relative">
                <x-jet-dropdown align="right" width="48" :active="\Request()->routeIs('rel.*')">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            Relatórios

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"/>
                        </svg>
                    </button>
                </span>
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Selecione o relatório
                </div>

                <x-jet-dropdown-link href="{{ url($ano.'/rel/gestores') }}"
                :active="request()->routeIs('rel.gestores')">
                {{ __('Gestores') }}
            </x-jet-dropdown-link>

        </x-slot>
    </x-jet-dropdown>

</div>
</div>

@auth

@if(Auth::user()->adm == 1)

<div class="hidden sm:flex sm:items-center sm:ml-6 z-50">
    <div class="ml-3 relative">
        <x-jet-dropdown align="right" width="48" :active="\Request()->routeIs('adm.*')">
            <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                    <button type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                    Administração do Sistema

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"/>
                </svg>
            </button>
        </span>
    </x-slot>

    <x-slot name="content">
        <!-- Account Management -->
        <div class="block px-4 py-2 text-xs text-gray-400">
            Selecione o tema de administração
        </div>

        <x-jet-dropdown-link href="{{ url($ano.'/adm/organization') }}"
        :active="request()->routeIs('organization')">
        {{ __('Unidades da Organização') }}
    </x-jet-dropdown-link>

    <div class="border-t blue-gray-100"></div>

    <x-jet-dropdown-link href="{{ url($ano.'/adm/usuarios') }}"
    :active="request()->routeIs('usuarios')">
    Usuários
</x-jet-dropdown-link>

<div class="border-t blue-gray-100"></div>

<x-jet-dropdown-link href="{{ url($ano.'/adm/pei') }}"
:active="request()->routeIs('PlanejamentoEstrategicoIntegrado')">
Planejamento Estratégico Integrado
</x-jet-dropdown-link>

<div class="border-t blue-gray-100"></div>

<x-jet-dropdown-link href="{{ url($ano.'/adm/missao-visao-valores') }}"
:active="request()->routeIs('missao')">
Missão, Visão e Valores
</x-jet-dropdown-link>

<div class="border-t blue-gray-100"></div>

<x-jet-dropdown-link href="{{ url($ano.'/adm/perspectiva') }}"
:active="request()->routeIs('perspectiva')">
{{ __('Perspective') }}
</x-jet-dropdown-link>

<div class="border-t blue-gray-100"></div>

<x-jet-dropdown-link href="{{ url($ano.'/adm/objetivo-estrategico') }}"
:active="request()->routeIs('objetivoEstragico')">
{{ __('Objetivo Estratégico') }}
</x-jet-dropdown-link>

<div class="border-t blue-gray-100"></div>

<x-jet-dropdown-link href="{{ url($ano.'/adm/plano-de-acao') }}"
:active="request()->routeIs('planoAcao')">
{{ __('Plano de Ação') }}
</x-jet-dropdown-link>

<div class="border-t blue-gray-100"></div>

<x-jet-dropdown-link href="{{ url($ano.'/adm/indicador') }}"
:active="request()->routeIs('indicadores')">
{{ __('Indicadores') }}
</x-jet-dropdown-link>

<div class="border-t blue-gray-100"></div>

<x-jet-dropdown-link href="{{ url($ano.'/adm/grau-satisfacao') }}"
:active="request()->routeIs('grauSatisfacao')">
{{ __('Grau de Satisfação') }}
</x-jet-dropdown-link>


</x-slot>
</x-jet-dropdown>

</div>
</div>

@endif

@endauth

<!-- Fim do menu da Administração do Sistema -->

</div>

<div class="hidden sm:flex sm:items-center sm:ml-6">
    <!-- Teams Dropdown -->
    @auth
    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
    <div class="ml-3 relative">
        <x-jet-dropdown align="right" width="60">
            <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                    <button type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                    {{ Auth::user()->currentTeam->name }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                    clip-rule="evenodd"/>
                </svg>
            </button>
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="w-60">
            <!-- Team Management -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Team') }}
            </div>

            <!-- Team Settings -->
            <x-jet-dropdown-link
            href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
            {{ __('Team Settings') }}
        </x-jet-dropdown-link>

        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
        <x-jet-dropdown-link href="{{ route('teams.create') }}">
            {{ __('Create New Team') }}
        </x-jet-dropdown-link>
        @endcan

        <div class="border-t blue-gray-100"></div>

        <!-- Team Switcher -->
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Switch Teams') }}
        </div>

        @foreach (Auth::user()->allTeams() as $team)
        <x-jet-switchable-team :team="$team"/>
        @endforeach
    </div>
</x-slot>
</x-jet-dropdown>
</div>
@endif
@endauth

<!-- Settings Dropdown -->
<div class="ml-3 relative">
    @auth
    <x-jet-dropdown align="right" width="48">
        <x-slot name="trigger">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <button
            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
            <img class="h-8 w-8 rounded-full object-cover"
            src="{{ Auth::user()->profile_photo_url }}"
            alt="{{ Auth::user()->name }}"/>
        </button>
        @else
        <span class="inline-flex rounded-md">
            <button type="button"
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
            {{ Auth::user()->name }}

            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"/>
        </svg>
    </button>
</span>
@endif
</x-slot>

<x-slot name="content">
    <!-- Account Management -->
    <div class="block px-4 py-2 text-xs text-gray-400">
        {{ __('Manage Account') }}
    </div>

    <x-jet-dropdown-link href="{{ route('profile.show') }}">
        {{ __('Profile') }}
    </x-jet-dropdown-link>

    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
        {{ __('API Tokens') }}
    </x-jet-dropdown-link>
    @endif

    <div class="border-t blue-gray-100"></div>

    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-jet-dropdown-link href="{{ route('logout') }}"
        onclick="event.preventDefault();
        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-jet-dropdown-link>
</form>
</x-slot>
</x-jet-dropdown>
@else
<a href="{{ route('login') }}"
class="text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Login') }}</a>

@if (Route::has('register'))
<a href="{{ route('register') }}"
class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Register') }}</a>
@endif
@endauth
</div>
</div>

<!-- Hamburger -->
<div class="-mr-2 flex items-center sm:hidden">
    <button @click="open = ! open"
    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 6h16M4 12h16M4 18h16"/>
        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
</button>
</div>
</div>
</div>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-jet-responsive-nav-link href="{{ route('pei.dashboard') }}"
        :active="request()->routeIs('pei.dashboard')">
        {{ __('Dashboard') }}
    </x-jet-responsive-nav-link>
</div>

<!-- Início da parte do menu para a alteração do Ano -->

@if(request()->path() != 'user/profile')
<div class="lg:flex sm:ml-6 pt-4">

    <div class="ml-3 relative">
        <x-jet-dropdown align="right" width="48">
            <x-slot name="trigger">

                <span class="inline-flex rounded-md">

                    <button type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">

                    {{ $ano }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"/>
                </svg>

            </button>

        </span>

    </x-slot>

    <?php

    $anos = [];
    for ($index = date('Y'); $index >= 2020; $index -= 1) {
        $anos[$index * 1] = $index * 1;
    }

    ?>

    <x-slot name="content">
        <!-- Account Management -->
        <div class="block px-4 py-2 text-xs text-gray-400">
            Selecione o ano
        </div>

        @foreach($anos as $key => $result)

        <?php

        $valor = '';

        if ($ano == $result) {

            $valor = 'true';

        } else {

            $valor = 'false';

        }

        ?>

        <x-jet-dropdown-link href="{{ url('/'.$result) }}" :active="$valor">
            {!! $result !!}
        </x-jet-dropdown-link>

        @endforeach
    </x-slot>
</x-jet-dropdown>
</div>

</div>
@endif

<!-- Fim da parte do menu para a alteração do Ano -->

<!-- Responsive Settings Options -->
<div class="pt-4 pb-1 border-t border-gray-200">
    <div class="flex items-center px-4">
        @auth
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="flex-shrink-0 mr-3">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
            alt="{{ Auth::user()->name }}"/>
        </div>
        @endif

        <div>
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>
        @endauth
    </div>

    <div class="mt-3 space-y-1">
        <!-- Account Management -->
        <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
        :active="request()->routeIs('profile.show')">
        {{ __('Profile') }}
    </x-jet-responsive-nav-link>

    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
    :active="request()->routeIs('api-tokens.index')">
    {{ __('API Tokens') }}
</x-jet-responsive-nav-link>
@endif

<!-- Authentication -->
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-jet-responsive-nav-link href="{{ route('logout') }}"
    onclick="event.preventDefault();
    this.closest('form').submit();">
    {{ __('Log Out') }}
</x-jet-responsive-nav-link>
</form>

<!-- Team Management -->
@if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
<div class="border-t border-gray-200"></div>

<div class="block px-4 py-2 text-xs text-gray-400">
    {{ __('Manage Team') }}
</div>

<!-- Team Settings -->
<x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
   :active="request()->routeIs('teams.show')">
   {{ __('Team Settings') }}
</x-jet-responsive-nav-link>

@can('create', Laravel\Jetstream\Jetstream::newTeamModel())
<x-jet-responsive-nav-link href="{{ route('teams.create') }}"
:active="request()->routeIs('teams.create')">
{{ __('Create New Team') }}
</x-jet-responsive-nav-link>
@endcan

<div class="border-t border-gray-200"></div>

<!-- Team Switcher -->
<div class="block px-4 py-2 text-xs text-gray-400">
    {{ __('Switch Teams') }}
</div>

@foreach (Auth::user()->allTeams() as $team)
<x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
@endforeach
@endif
</div>
</div>
</div>
</nav>

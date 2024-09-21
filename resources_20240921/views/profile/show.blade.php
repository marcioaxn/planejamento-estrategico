<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @php
        if (!Auth::guest() && Auth::user()->trocarsenha === 1) {

                print('<div>
        <div class="max-w-34xl mx-auto py-10 sm:px-6 lg:px-8 mt-2 pt-5 bg-slate-500 text-white ">Você fez o acesso utilizando a senha que recebeu por e-mail, agora é necessário que crie sua própria senha segura. Ela precisa ter no mínimo 9 caracteres e o ideal que seja alfanumérica (letras e números) e se possível um ou mais caracteres especiais, por exemplo @ ou # ou &.<br /><br />No item <strong>Atualizar a senha</strong>, que está após o item Informação do Perfil, você poderá efetuar essa alteração de senha.</div></div>');

            }
    @endphp

    <div>
        <div class="max-w-34xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border/>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border/>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border/>
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
        </div>
    </div>
</x-app-layout>

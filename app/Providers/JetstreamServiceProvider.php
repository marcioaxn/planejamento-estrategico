<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{

    protected function registerComponent(string $component) {
        \Illuminate\Support\Facades\Blade::component('jetstream::components.'.$component, 'jet-'.$component);
    }

    public function register()
    {
        $this->registerComponent('geral-modal');
        $this->registerComponent('important-modal');
        $this->registerComponent('button-danger');
        $this->registerComponent('labelopcional');
        $this->registerComponent('labelpreenchimentoobrigatoriio');
    }

    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\OrganizacaoController;

use App\Http\Livewire\{
    ShowDashboard,
    ShowOrganization,
    PlanejamentoEstrategicoIntegrado
};


/*
|--------------------------------------------------------------------------
| Rotas no Laravel 8 precisa de ajuste
|--------------------------------------------------------------------------
|
| https://mazer.dev/como-corrigir-o-erro-target-class-does-not-exist-no-laravel-8/
|
*/

Route::get('/', function () {
    $ano = date('Y');

    return redirect()->action(ShowDashboard::class,['ano' => $ano]);
})->name('principal');

// Route::PATCH('{ano}',[PrincipalController::class, 'index']);
// Route::get('{ano}',[PrincipalController::class, 'index']);

Route::get('{ano?}', ShowDashboard::class)->name('dashboard');

Route::group(['middleware' => ['auth', 'trocarSenha']], function () {

    Route::get('{ano}/organization/show', ShowOrganization::class)->name('organization');

    Route::get('{ano}/pei/show',PlanejamentoEstrategicoIntegrado::class)->name('PlanejamentoEstrategicoIntegrado');

});

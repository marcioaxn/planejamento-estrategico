<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\OrganizacaoController;

use App\Http\Livewire\{
    ShowDashboard,
    ShowOrganization,
    PlanejamentoEstrategicoIntegrado,
    MissaoVisaoValoresLivewire,
    PerspectivaLivewire,
    ObjetivoEstrategicoLivewire,
    PlanoAcaoLivewire
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

    $cod_organizacao = null;

    return redirect()->action(ShowDashboard::class,['ano' => $ano,'cod_organizacao' => $cod_organizacao]);
})->name('principal');

// Route::PATCH('{ano}',[PrincipalController::class, 'index']);
// Route::get('{ano}',[PrincipalController::class, 'index']);

Route::get('{ano?}/{cod_organizacao?}', ShowDashboard::class)->name('dashboard');

Route::group(['middleware' => ['auth', 'trocarSenha']], function () {

    Route::get('{ano}/organization/show', ShowOrganization::class)->name('organization');

    Route::get('{ano}/pei/show',PlanejamentoEstrategicoIntegrado::class)->name('PlanejamentoEstrategicoIntegrado');

    Route::get('{ano}/missao-visao-valores/show',MissaoVisaoValoresLivewire::class)->name('missao');

    Route::get('{ano}/perspectiva',PerspectivaLivewire::class)->name('perspectiva');

    Route::get('{ano}/adm/objetivo-estrategico',ObjetivoEstrategicoLivewire::class)->name('objetivoEstragico');

    Route::get('{ano}/adm/plano-de-acao',PlanoAcaoLivewire::class)->name('planoAcao');

});

Route::fallback( function () {
    $ano = date('Y');

    return redirect()->action(ShowDashboard::class,['ano' => $ano]);
} );

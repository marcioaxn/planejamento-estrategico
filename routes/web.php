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
    PlanoAcaoLivewire,
    IndicadoresLivewire,
    GrauSatisfacaoLivewire,
    ShowObjetivoEstrategicoLivewire
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

    Route::get('{ano}/adm/organization', ShowOrganization::class)->name('organization');

    Route::get('{ano}/adm/pei',PlanejamentoEstrategicoIntegrado::class)->name('PlanejamentoEstrategicoIntegrado');

    Route::get('{ano}/adm/missao-visao-valores',MissaoVisaoValoresLivewire::class)->name('missao');

    Route::get('{ano}/adm/perspectiva',PerspectivaLivewire::class)->name('perspectiva');

    Route::get('{ano}/adm/objetivo-estrategico',ObjetivoEstrategicoLivewire::class)->name('objetivoEstragico');

    Route::get('{ano}/adm/plano-de-acao',PlanoAcaoLivewire::class)->name('planoAcao');

    Route::get('{ano}/adm/indicador',IndicadoresLivewire::class)->name('indicadores');

    Route::get('{ano}/adm/grau-satisfacao',GrauSatisfacaoLivewire::class)->name('grauSatisfacao');

});

Route::get('{ano}/perspectiva/{cod_perspectiva}/objetivo-estrategico/{cod_objetivo_estrategico}/plano-de-acao/{cod_plano_de_acao?}',ShowObjetivoEstrategicoLivewire::class)->name('showObjetivoEstrategico');

Route::fallback( function () {
    $ano = date('Y');

    return redirect()->action(ShowDashboard::class,['ano' => $ano]);
} );

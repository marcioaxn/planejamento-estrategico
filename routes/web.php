<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ArquivosController;

use App\Http\Livewire\{
    ShowDashboard,
    ShowOrganization,
    PlanejamentoEstrategicoIntegrado,
    MissaoVisaoLivewire,
    ValoresLivewire,
    RelatorioLivewire,
    PerspectivaLivewire,
    ObjetivoEstrategicoLivewire,
    IndicadorObjetivoEstrategicoLivewire,
    IndicadoresObjetivoEstrategicoLivewire,
    PlanoAcaoLivewire,
    IndicadoresLivewire,
    GrauSatisfacaoLivewire,
    ShowObjetivoEstrategicoLivewire,
    UsuariosLivewire,
    DashboardLivewire
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

    return redirect()->action(ShowDashboard::class, ['ano' => $ano, 'cod_organizacao' => $cod_organizacao]);
})->name('pei.principal');

Route::get('{ano?}/dashboard', DashboardLivewire::class)->name('dashboard');

// Route::PATCH('{ano}',[PrincipalController::class, 'index']);
// Route::get('{ano}',[PrincipalController::class, 'index']);

Route::get('/user/inativo', function () {
    return view('users.inativo');
})->name('user.inativo');

Route::get('{ano?}/{cod_organizacao?}', ShowDashboard::class)->name('pei.dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified', 'auth', 'trocarSenha', 'usuarioNaoAtivo']], function () {

    Route::get('{ano}/adm/organization', ShowOrganization::class)->name('organization');

    Route::get('{ano}/adm/usuarios', UsuariosLivewire::class)->name('usuarios');

    Route::get('{ano}/adm/pei', PlanejamentoEstrategicoIntegrado::class)->name('PlanejamentoEstrategicoIntegrado');

    Route::get('{ano}/adm/missao-visao', MissaoVisaoLivewire::class)->name('missao');

    Route::get('{ano}/adm/valores', ValoresLivewire::class)->name('adm.valores');

    Route::get('{ano}/adm/perspectiva', PerspectivaLivewire::class)->name('perspectiva');

    Route::get('{ano}/adm/objetivo-estrategico', ObjetivoEstrategicoLivewire::class)->name('objetivoEstragico');

    Route::get('{ano}/adm/indicador-objetivo-estrategico', IndicadoresObjetivoEstrategicoLivewire::class)->name('indicadores.objetivo-estrategico');

    Route::get('{ano}/adm/plano-de-acao', PlanoAcaoLivewire::class)->name('planoAcao');

    Route::get('{ano}/adm/indicador', IndicadoresLivewire::class)->name('indicadores');

    Route::get('{ano}/adm/grau-satisfacao', GrauSatisfacaoLivewire::class)->name('grauSatisfacao');
});

Route::get('{ano}/{cod_origem}/{cod_organizacao}/{cod_perspectiva}/{cod_objetivo_estrategico}/{cod_plano_de_acao?}', ShowObjetivoEstrategicoLivewire::class)->name('objetivo-estrategico');

Route::get('{ano}/indicador-objetivo-estrategico/{cod_organizacao}/{cod_perspectiva}/{cod_objetivo_estrategico}/{cod_plano_de_acao?}', IndicadorObjetivoEstrategicoLivewire::class)->name('objetivo-estrategico.indicador');

Route::get('{ano}/evolucao-mensal-arquivo/{cod_arquivo}', 'App\Http\Controllers\ArquivosController@show')->name('showArquivoEvolucaoMensal');

Route::get('relatorio/indicador-e-plano-acao/{periodo}/{ano}/{mes}', RelatorioLivewire::class)->name('relatorio.indicador-oe-e-plano-acao');

Route::fallback(function () {
    $ano = date('Y');

    return redirect()->action(ShowDashboard::class, ['ano' => $ano]);
});

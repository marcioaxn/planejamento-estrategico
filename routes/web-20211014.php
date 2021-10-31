<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\OrganizacaoController;

use App\Http\Livewire\{
    ShowDashboard
};

use App\Http\Livewire\Organization\Show;


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

// Route::get('/', ShowDashboard::class);

Route::middleware(['auth:sanctum', 'verified'])->get('{ano?}/dashboard', function ($ano) {

    if(isset($ano) && !is_null($ano) && $ano != '') {

        return redirect()->action(ShowDashboard::class,['ano' => $ano]);

    } else {

        $ano = date('Y');

        return redirect()->action(ShowDashboard::class,['ano' => $ano]);

    }

    Route::get('organization/show', Show::class)->name('organization');

})->name('logado');

Route::group(['middleware' => ['auth', 'trocarSenha', 'usuarioNaoAtivo']], function () {

    Route::get('organization/show', Show::class)->name('organization');

});

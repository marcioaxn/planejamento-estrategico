<?php

namespace App\Http\Livewire;

use App\Models\PlanoAcao;
use App\Models\User;
use Livewire\Component;

class RelatorioGestoresLivewire extends Component
{

    public $users = [];
    public $planoAcao = [];

    public function render()
    {

        $planoAcao = PlanoAcao::with('objetivoEstrategico','tipoExecucao','unidade','servidorResponsavel','servidorSubstituto','acoesRealizadas')
            ->orderBy('num_nivel_hierarquico_apresentacao');

        $planoAcao = $planoAcao->whereHas('objetivoEstrategico', function ($query) {
            $query->orderBy('num_nivel_hierarquico_apresentacao');
        });

        $this->planoAcao = $planoAcao->get();

        return view('livewire.relatorio-gestores-livewire');
    }
}

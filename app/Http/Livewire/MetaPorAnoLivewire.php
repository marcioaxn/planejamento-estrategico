<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MetaAno;
use App\Models\Indicador;
use App\Models\Acoes;
use App\Models\Audit;
use App\Models\TabAudit;
use DB;
Use Auth;
use Illuminate\Support\Str;

class MetaPorAnoLivewire extends Component
{

    public function getMetaPorAnoPorCodIndicadorEAno($cod_indicador = '', $ano = '') {

        // Esta função tem o objetivo de consultar e retornar o valor da meta pelo $cod_indicador
        // --- x --- x --- x ---

        // Início da declaração da variável de consulta a meta anual do indicador
        $metaPorAno = [];
        // Fim da declaração da variável de consulta a meta anual do indicador
        // --- x --- x --- x ---

        // Início da declaração de variáveis gerais
        $meta = null;
        // Fim da declaração de variáveis gerais

        // Início do IF para verificar se a variável $cod_indicador contem algum conteúdo
        if(isset($cod_indicador) && !is_null($cod_indicador) && $cod_indicador != '') {

            $metaPorAno = MetaAno::select('meta')
            ->where('cod_indicador',$cod_indicador)
            ->where('num_ano',$ano)
            ->first();

            // Início do IF para verificar se a consulta foi feita com sucesso
            if($metaPorAno) {

                // Valor da meta anual
                $meta = $metaPorAno->meta;

            }
            // Fim do IF para verificar se a consulta foi feita com sucesso
            // --- x --- x --- x ---

        }
        // Fim do IF para verificar se a variável $cod_indicador contem algum conteúdo
        // --- x --- x --- x ---

        // Retorno com o resultado da função
        return $meta;


    }

    public function render()
    {
        return view('livewire.meta-por-ano-livewire');
    }
}

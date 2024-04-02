<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use App\Models\Pei;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanoAcao;
use App\Models\Indicador;
use App\Models\LinhaBase;
use App\Models\MetaAno;
use App\Models\EvolucaoIndicador;
use App\Models\GrauSatisfacao;
use Illuminate\Support\Facades\DB;

class EvolucaoIndicadorLivewire extends Component
{

    public function calcularPercentualExecutado($cod_indicador = '',$num_ano = '',$num_mes = '',$acumuladoAno = false,$acumuladoPeriodo = false)
    {

        // Início do IF para verificar se existe conteúdo na variável $cod_indicador

        if(isset($cod_indicador) && !is_null($cod_indicador) && $cod_indicador != '') {

            // Início da consulta para retornar a evolução do indicador

            $consultarEvolucaoIndicador = EvolucaoIndicador::where('cod_indicador',$cod_indicador)
            ->where('num_ano',$num_ano)
            ->select(DB::raw("SUM(vlr_previsto) AS vlr_previsto, SUM(vlr_realizado) AS vlr_realizado"));

            // Início do IF para verificar se existe conteúdo na variável $acumuladoAno

            if(!$acumuladoAno) {

                // Início do IF para verificar se existe conteúdo na variável $acumuladoPeriodo

                if(!$acumuladoPeriodo) {

                    // Início do IF para verificar se existe conteúdo na variável $num_mes

                    if(isset($num_mes) && !is_null($num_mes) && $num_mes != '') {

                        $consultarEvolucaoIndicador = $consultarEvolucaoIndicador->where('num_mes',$num_mes);

                    }

                    // Fim do IF para verificar se existe conteúdo na variável $num_mes

                } else {

                    // Início do IF para verificar se existe conteúdo na variável $num_mes

                    if(isset($num_mes) && !is_null($num_mes) && $num_mes != '') {

                        $consultarEvolucaoIndicador = $consultarEvolucaoIndicador->where('num_mes','<=',$num_mes);

                    }

                    // Fim do IF para verificar se existe conteúdo na variável $num_mes

                }

                // Fim do IF para verificar se existe conteúdo na variável $acumuladoPeriodo

            }

            // Fim do IF para verificar se existe conteúdo na variável $acumuladoAno

            $consultarEvolucaoIndicador = $consultarEvolucaoIndicador->first();

            return $consultarEvolucaoIndicador;

            // Fim da consulta para retornar a evolução do indicador

        }

        // Fim do IF para verificar se existe conteúdo na variável $cod_indicador

    }

    public function render()
    {
        return view('livewire.evolucao-indicador-livewire');
    }
}

<div class="">

    <div class="flex flex-wrap w-full pt-3 pb-3 pl-3 pr-3">

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-1 pb-1 pl-1">
            Perspectiva: <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}. {!! $this->perspectiva->dsc_perspectiva !!}</strong>
        </div>

        <div class="w-full md:w-5/6 border-b-2 border-gray-300 pt-1 pb-1 pl-1">
            Objetivo Estratégico: <strong>{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}. {!! $this->objetivoEstrategico->dsc_objetivo_estrategico !!}</strong>
        </div>

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-3 pb-1 pl-1">Plano de Ação:</div>

        <div class="w-full md:w-5/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-12 2xl:grid-cols-12 gap-2 mt-0">

                <?php $contPlanoAcao = 1; ?>

                @foreach($this->planosAcao as $resultPlanoAcao)

                <a href="{!! url($this->ano.'/perspectiva/'.$this->cod_perspectiva.'/objetivo-estrategico/'.$this->cod_objetivo_estrategico.'/plano-de-acao/'.$resultPlanoAcao->cod_plano_de_acao) !!}">
                    <div class="text-base text-center bg-green-500 text-white rounded-md border-2 border-green-50 border-opacity-25 shadow-md">
                        <?php is_null($this->cod_plano_de_acao) && $contPlanoAcao == 1 ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?><?php $resultPlanoAcao->cod_plano_de_acao == $this->cod_plano_de_acao ? print('<i class="fas fa-arrow-circle-right"></i> ') : print(''); ?>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $resultPlanoAcao->num_nivel_hierarquico_apresentacao !!}
                    </div>
                </a>

                <?php $contPlanoAcao = $contPlanoAcao + 1; ?>

                @endforeach

            </div>

        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            {!! $planoAcao->tipoExecucao->dsc_tipo_execucao !!}: <strong>{!! $this->perspectiva->num_nivel_hierarquico_apresentacao !!}.{!! $this->objetivoEstrategico->num_nivel_hierarquico_apresentacao !!}.{!! $planoAcao->num_nivel_hierarquico_apresentacao !!}. {!! $planoAcao->dsc_plano_de_acao !!}</strong>
        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Principais entregas: <strong>{{ $planoAcao->txt_principais_entregas }}</strong>
        </div>

        <div class="w-full md:w-3/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">Data de início em <strong>{{ converterData('EN','PTBR',$planoAcao->dte_inicio) }}</strong><span class="text-gray-400">, {{ formatarDataComCarbonForHumans($planoAcao->dte_inicio) }},</span> e a conclusão prevista para <strong>{{ converterData('EN','PTBR',$planoAcao->dte_fim) }}</strong>
        </div>

        <div class="w-full md:w-1/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Status: <strong>{{ $planoAcao->bln_status }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Orçamento previsto: R$ <strong>{{ converteValor('MYSQL','PTBR',$planoAcao->vlr_orcamento_previsto) }}</strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Unidade responsável: <strong>{{ $planoAcao->unidade->sgl_organizacao }}</strong><span class="text-gray-400">{!! $this->hierarquiaUnidade($planoAcao->unidade->cod_organizacao) !!}</span>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Servidor(a) Responsável: 
            <strong>
                @foreach($planoAcao->servidorResponsavel as $responsavel)

                {!! $responsavel->name !!}

                @endforeach
            </strong>
        </div>

        <div class="w-full md:w-2/6 border-b-2 border-gray-300 pt-2 pb-2 pl-1">
            Servidor(a) Substituto(a): 
            <strong>
                @foreach($planoAcao->servidorSubstituto as $subtituto)

                {!! $subtituto->name !!}

                @endforeach
            </strong>
        </div>

    </div>

</div>
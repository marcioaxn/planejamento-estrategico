<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\NumNivelHierarquico;
use App\Models\TipoExecucao;
use App\Models\Organization;
use App\Models\PlanoAcao;
use App\Models\Indicador;
use App\Models\LinhaBase;
use App\Models\MetaAno;
use App\Models\EvolucaoIndicador;
use App\Models\User;
use App\Models\RelUsersTabOrganizacoesTabPerfilAcesso;
use App\Models\Acoes;
use App\Models\Audit;
use DB;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

class IndicadoresLivewire extends Component
{

    public $cod_pei = null;
    public $pei = [];
    public $cod_perspectiva = null;
    public $perspectiva = [];
    public $cod_objetivo_estrategico = null;
    public $objetivoEstragico = [];

    public $cod_indicador = null;

    public $indicadores = [];

    public $cod_plano_de_acao = null;
    public $planoAcao = [];
    public $dsc_indicador = null;
    public $dsc_formula = null;

    public $unidadesMedida = ['Quantidade' => 'Quantidade','Porcentagem' => 'Porcentagem','Dinheiro' => 'Dinheiro R$ 0,00 (real)'];
    public $dsc_unidade_medida = null;

    public $bln_acumulado = null;

    public $tiposIndicadores = ['+' => 'Quanto maior for o resultado melhor','-' => 'Quanto menor for o resultado melhor','=' => 'Quanto igual for o resultado melhor'];
    public $dsc_tipo = null;

    public $dsc_fonte = null;
    public $dsc_periodo_medicao = null;

    public $vlr_meta = null;

    public $tirarReadonly = false;

    public $adequarMascara = null;

    public $hierarquiaUnidade = null;

    public $anoInicioDoPeiSelecionado = null;
    public $anoConclusaoDoPeiSelecionado = null;

    public $anoInicioDoPlanoDeAcaoSelecionado = null;
    public $mesInicioDoPlanoDeAcaoSelecionado = null;
    public $anoConclusaoDoPlanoDeAcaoSelecionado = null;
    public $mesConclusaoDoPlanoDeAcaoSelecionado = null;

    public $habilitarCampoInserirMetas = 'none';

    public $primeiroAnoDoPeiSelecionado = null;
    public $ultimoAnoDoPeiSelecionado = null;

    public $anosLinhaBase = null;

    public $num_ano_base_1 = null;
    public $num_ano_base_2 = null;
    public $num_ano_base_3 = null;

    public $num_linha_base_1 = null;
    public $num_linha_base_2 = null;
    public $num_linha_base_3 = null;

    public $metaAno_2020 = null;
    public $metaAno_2021 = null;
    public $metaAno_2022 = null;
    public $metaAno_2023 = null;
    public $metaAno_2024 = null;
    public $metaAno_2025 = null;
    public $metaAno_2026 = null;
    public $metaAno_2027 = null;
    public $metaAno_2028 = null;
    public $metaAno_2029 = null;
    public $metaAno_2030 = null;
    public $metaAno_2031 = null;
    public $metaAno_2032 = null;
    public $metaAno_2033 = null;
    public $metaAno_2034 = null;
    public $metaAno_2035 = null;
    public $metaAno_2036 = null;
    public $metaAno_2037 = null;
    public $metaAno_2038 = null;
    public $metaAno_2039 = null;
    public $metaAno_2040 = null;
    public $metaAno_2041 = null;
    public $metaAno_2042 = null;
    public $metaAno_2043 = null;
    public $metaAno_2044 = null;
    public $metaAno_2045 = null;

    public $metaMes_1_2020 = null;
    public $metaMes_2_2020 = null;
    public $metaMes_3_2020 = null;
    public $metaMes_4_2020 = null;
    public $metaMes_5_2020 = null;
    public $metaMes_6_2020 = null;
    public $metaMes_7_2020 = null;
    public $metaMes_8_2020 = null;
    public $metaMes_9_2020 = null;
    public $metaMes_10_2020 = null;
    public $metaMes_11_2020 = null;
    public $metaMes_12_2020 = null;
    public $metaMes_1_2021 = null;
    public $metaMes_2_2021 = null;
    public $metaMes_3_2021 = null;
    public $metaMes_4_2021 = null;
    public $metaMes_5_2021 = null;
    public $metaMes_6_2021 = null;
    public $metaMes_7_2021 = null;
    public $metaMes_8_2021 = null;
    public $metaMes_9_2021 = null;
    public $metaMes_10_2021 = null;
    public $metaMes_11_2021 = null;
    public $metaMes_12_2021 = null;
    public $metaMes_1_2022 = null;
    public $metaMes_2_2022 = null;
    public $metaMes_3_2022 = null;
    public $metaMes_4_2022 = null;
    public $metaMes_5_2022 = null;
    public $metaMes_6_2022 = null;
    public $metaMes_7_2022 = null;
    public $metaMes_8_2022 = null;
    public $metaMes_9_2022 = null;
    public $metaMes_10_2022 = null;
    public $metaMes_11_2022 = null;
    public $metaMes_12_2022 = null;
    public $metaMes_1_2023 = null;
    public $metaMes_2_2023 = null;
    public $metaMes_3_2023 = null;
    public $metaMes_4_2023 = null;
    public $metaMes_5_2023 = null;
    public $metaMes_6_2023 = null;
    public $metaMes_7_2023 = null;
    public $metaMes_8_2023 = null;
    public $metaMes_9_2023 = null;
    public $metaMes_10_2023 = null;
    public $metaMes_11_2023 = null;
    public $metaMes_12_2023 = null;
    public $metaMes_1_2024 = null;
    public $metaMes_2_2024 = null;
    public $metaMes_3_2024 = null;
    public $metaMes_4_2024 = null;
    public $metaMes_5_2024 = null;
    public $metaMes_6_2024 = null;
    public $metaMes_7_2024 = null;
    public $metaMes_8_2024 = null;
    public $metaMes_9_2024 = null;
    public $metaMes_10_2024 = null;
    public $metaMes_11_2024 = null;
    public $metaMes_12_2024 = null;
    public $metaMes_1_2025 = null;
    public $metaMes_2_2025 = null;
    public $metaMes_3_2025 = null;
    public $metaMes_4_2025 = null;
    public $metaMes_5_2025 = null;
    public $metaMes_6_2025 = null;
    public $metaMes_7_2025 = null;
    public $metaMes_8_2025 = null;
    public $metaMes_9_2025 = null;
    public $metaMes_10_2025 = null;
    public $metaMes_11_2025 = null;
    public $metaMes_12_2025 = null;
    public $metaMes_1_2026 = null;
    public $metaMes_2_2026 = null;
    public $metaMes_3_2026 = null;
    public $metaMes_4_2026 = null;
    public $metaMes_5_2026 = null;
    public $metaMes_6_2026 = null;
    public $metaMes_7_2026 = null;
    public $metaMes_8_2026 = null;
    public $metaMes_9_2026 = null;
    public $metaMes_10_2026 = null;
    public $metaMes_11_2026 = null;
    public $metaMes_12_2026 = null;
    public $metaMes_1_2027 = null;
    public $metaMes_2_2027 = null;
    public $metaMes_3_2027 = null;
    public $metaMes_4_2027 = null;
    public $metaMes_5_2027 = null;
    public $metaMes_6_2027 = null;
    public $metaMes_7_2027 = null;
    public $metaMes_8_2027 = null;
    public $metaMes_9_2027 = null;
    public $metaMes_10_2027 = null;
    public $metaMes_11_2027 = null;
    public $metaMes_12_2027 = null;
    public $metaMes_1_2028 = null;
    public $metaMes_2_2028 = null;
    public $metaMes_3_2028 = null;
    public $metaMes_4_2028 = null;
    public $metaMes_5_2028 = null;
    public $metaMes_6_2028 = null;
    public $metaMes_7_2028 = null;
    public $metaMes_8_2028 = null;
    public $metaMes_9_2028 = null;
    public $metaMes_10_2028 = null;
    public $metaMes_11_2028 = null;
    public $metaMes_12_2028 = null;
    public $metaMes_1_2029 = null;
    public $metaMes_2_2029 = null;
    public $metaMes_3_2029 = null;
    public $metaMes_4_2029 = null;
    public $metaMes_5_2029 = null;
    public $metaMes_6_2029 = null;
    public $metaMes_7_2029 = null;
    public $metaMes_8_2029 = null;
    public $metaMes_9_2029 = null;
    public $metaMes_10_2029 = null;
    public $metaMes_11_2029 = null;
    public $metaMes_12_2029 = null;
    public $metaMes_1_2030 = null;
    public $metaMes_2_2030 = null;
    public $metaMes_3_2030 = null;
    public $metaMes_4_2030 = null;
    public $metaMes_5_2030 = null;
    public $metaMes_6_2030 = null;
    public $metaMes_7_2030 = null;
    public $metaMes_8_2030 = null;
    public $metaMes_9_2030 = null;
    public $metaMes_10_2030 = null;
    public $metaMes_11_2030 = null;
    public $metaMes_12_2030 = null;
    public $metaMes_1_2031 = null;
    public $metaMes_2_2031 = null;
    public $metaMes_3_2031 = null;
    public $metaMes_4_2031 = null;
    public $metaMes_5_2031 = null;
    public $metaMes_6_2031 = null;
    public $metaMes_7_2031 = null;
    public $metaMes_8_2031 = null;
    public $metaMes_9_2031 = null;
    public $metaMes_10_2031 = null;
    public $metaMes_11_2031 = null;
    public $metaMes_12_2031 = null;
    public $metaMes_1_2032 = null;
    public $metaMes_2_2032 = null;
    public $metaMes_3_2032 = null;
    public $metaMes_4_2032 = null;
    public $metaMes_5_2032 = null;
    public $metaMes_6_2032 = null;
    public $metaMes_7_2032 = null;
    public $metaMes_8_2032 = null;
    public $metaMes_9_2032 = null;
    public $metaMes_10_2032 = null;
    public $metaMes_11_2032 = null;
    public $metaMes_12_2032 = null;
    public $metaMes_1_2033 = null;
    public $metaMes_2_2033 = null;
    public $metaMes_3_2033 = null;
    public $metaMes_4_2033 = null;
    public $metaMes_5_2033 = null;
    public $metaMes_6_2033 = null;
    public $metaMes_7_2033 = null;
    public $metaMes_8_2033 = null;
    public $metaMes_9_2033 = null;
    public $metaMes_10_2033 = null;
    public $metaMes_11_2033 = null;
    public $metaMes_12_2033 = null;
    public $metaMes_1_2034 = null;
    public $metaMes_2_2034 = null;
    public $metaMes_3_2034 = null;
    public $metaMes_4_2034 = null;
    public $metaMes_5_2034 = null;
    public $metaMes_6_2034 = null;
    public $metaMes_7_2034 = null;
    public $metaMes_8_2034 = null;
    public $metaMes_9_2034 = null;
    public $metaMes_10_2034 = null;
    public $metaMes_11_2034 = null;
    public $metaMes_12_2034 = null;
    public $metaMes_1_2035 = null;
    public $metaMes_2_2035 = null;
    public $metaMes_3_2035 = null;
    public $metaMes_4_2035 = null;
    public $metaMes_5_2035 = null;
    public $metaMes_6_2035 = null;
    public $metaMes_7_2035 = null;
    public $metaMes_8_2035 = null;
    public $metaMes_9_2035 = null;
    public $metaMes_10_2035 = null;
    public $metaMes_11_2035 = null;
    public $metaMes_12_2035 = null;
    public $metaMes_1_2036 = null;
    public $metaMes_2_2036 = null;
    public $metaMes_3_2036 = null;
    public $metaMes_4_2036 = null;
    public $metaMes_5_2036 = null;
    public $metaMes_6_2036 = null;
    public $metaMes_7_2036 = null;
    public $metaMes_8_2036 = null;
    public $metaMes_9_2036 = null;
    public $metaMes_10_2036 = null;
    public $metaMes_11_2036 = null;
    public $metaMes_12_2036 = null;
    public $metaMes_1_2037 = null;
    public $metaMes_2_2037 = null;
    public $metaMes_3_2037 = null;
    public $metaMes_4_2037 = null;
    public $metaMes_5_2037 = null;
    public $metaMes_6_2037 = null;
    public $metaMes_7_2037 = null;
    public $metaMes_8_2037 = null;
    public $metaMes_9_2037 = null;
    public $metaMes_10_2037 = null;
    public $metaMes_11_2037 = null;
    public $metaMes_12_2037 = null;
    public $metaMes_1_2038 = null;
    public $metaMes_2_2038 = null;
    public $metaMes_3_2038 = null;
    public $metaMes_4_2038 = null;
    public $metaMes_5_2038 = null;
    public $metaMes_6_2038 = null;
    public $metaMes_7_2038 = null;
    public $metaMes_8_2038 = null;
    public $metaMes_9_2038 = null;
    public $metaMes_10_2038 = null;
    public $metaMes_11_2038 = null;
    public $metaMes_12_2038 = null;
    public $metaMes_1_2039 = null;
    public $metaMes_2_2039 = null;
    public $metaMes_3_2039 = null;
    public $metaMes_4_2039 = null;
    public $metaMes_5_2039 = null;
    public $metaMes_6_2039 = null;
    public $metaMes_7_2039 = null;
    public $metaMes_8_2039 = null;
    public $metaMes_9_2039 = null;
    public $metaMes_10_2039 = null;
    public $metaMes_11_2039 = null;
    public $metaMes_12_2039 = null;
    public $metaMes_1_2040 = null;
    public $metaMes_2_2040 = null;
    public $metaMes_3_2040 = null;
    public $metaMes_4_2040 = null;
    public $metaMes_5_2040 = null;
    public $metaMes_6_2040 = null;
    public $metaMes_7_2040 = null;
    public $metaMes_8_2040 = null;
    public $metaMes_9_2040 = null;
    public $metaMes_10_2040 = null;
    public $metaMes_11_2040 = null;
    public $metaMes_12_2040 = null;
    public $metaMes_1_2041 = null;
    public $metaMes_2_2041 = null;
    public $metaMes_3_2041 = null;
    public $metaMes_4_2041 = null;
    public $metaMes_5_2041 = null;
    public $metaMes_6_2041 = null;
    public $metaMes_7_2041 = null;
    public $metaMes_8_2041 = null;
    public $metaMes_9_2041 = null;
    public $metaMes_10_2041 = null;
    public $metaMes_11_2041 = null;
    public $metaMes_12_2041 = null;
    public $metaMes_1_2042 = null;
    public $metaMes_2_2042 = null;
    public $metaMes_3_2042 = null;
    public $metaMes_4_2042 = null;
    public $metaMes_5_2042 = null;
    public $metaMes_6_2042 = null;
    public $metaMes_7_2042 = null;
    public $metaMes_8_2042 = null;
    public $metaMes_9_2042 = null;
    public $metaMes_10_2042 = null;
    public $metaMes_11_2042 = null;
    public $metaMes_12_2042 = null;
    public $metaMes_1_2043 = null;
    public $metaMes_2_2043 = null;
    public $metaMes_3_2043 = null;
    public $metaMes_4_2043 = null;
    public $metaMes_5_2043 = null;
    public $metaMes_6_2043 = null;
    public $metaMes_7_2043 = null;
    public $metaMes_8_2043 = null;
    public $metaMes_9_2043 = null;
    public $metaMes_10_2043 = null;
    public $metaMes_11_2043 = null;
    public $metaMes_12_2043 = null;
    public $metaMes_1_2044 = null;
    public $metaMes_2_2044 = null;
    public $metaMes_3_2044 = null;
    public $metaMes_4_2044 = null;
    public $metaMes_5_2044 = null;
    public $metaMes_6_2044 = null;
    public $metaMes_7_2044 = null;
    public $metaMes_8_2044 = null;
    public $metaMes_9_2044 = null;
    public $metaMes_10_2044 = null;
    public $metaMes_11_2044 = null;
    public $metaMes_12_2044 = null;
    public $metaMes_1_2045 = null;
    public $metaMes_2_2045 = null;
    public $metaMes_3_2045 = null;
    public $metaMes_4_2045 = null;
    public $metaMes_5_2045 = null;
    public $metaMes_6_2045 = null;
    public $metaMes_7_2045 = null;
    public $metaMes_8_2045 = null;
    public $metaMes_9_2045 = null;
    public $metaMes_10_2045 = null;
    public $metaMes_11_2045 = null;
    public $metaMes_12_2045 = null;

    public $requiredMetaAno_2020 = null;
    public $requiredMetaAno_2021 = null;
    public $requiredMetaAno_2022 = null;
    public $requiredMetaAno_2023 = null;
    public $requiredMetaAno_2024 = null;
    public $requiredMetaAno_2025 = null;
    public $requiredMetaAno_2026 = null;
    public $requiredMetaAno_2027 = null;
    public $requiredMetaAno_2028 = null;
    public $requiredMetaAno_2029 = null;
    public $requiredMetaAno_2030 = null;
    public $requiredMetaAno_2031 = null;
    public $requiredMetaAno_2032 = null;
    public $requiredMetaAno_2033 = null;
    public $requiredMetaAno_2034 = null;
    public $requiredMetaAno_2035 = null;
    public $requiredMetaAno_2036 = null;
    public $requiredMetaAno_2037 = null;
    public $requiredMetaAno_2038 = null;
    public $requiredMetaAno_2039 = null;
    public $requiredMetaAno_2040 = null;
    public $requiredMetaAno_2041 = null;
    public $requiredMetaAno_2042 = null;
    public $requiredMetaAno_2043 = null;
    public $requiredMetaAno_2044 = null;
    public $requiredMetaAno_2045 = null;

    public $ano1 = null;
    public $ano2 = null;
    public $ano3 = null;
    public $ano4 = null;

    public $somaMetaAno1 = null;
    public $somaMetaAno2 = null;
    public $somaMetaAno3 = null;
    public $somaMetaAno4 = null;

    public $erroInsercaoMetaMensal = false;
    public $textoErroInsercaoMetaMensal = null;

    public $inputAnoLinhaBaseClass = null;
    public $inputValorLinhaBaseClass = null;

    public $inputValorClass = null;

    public $inputValorMesAno1Class = null;
    public $inputValorMesAno2Class = null;
    public $inputValorMesAno3Class = null;
    public $inputValorMesAno4Class = null;

    public $estruturaTable = null;
    
    public $editarForm = false;
    public $deleteForm = false;
    public $audit = false;
    public $showModalResultadoEdicao = false;
    public $showModalImportant = false;
    public $mensagemResultadoEdicao = null;
    public $mensagemImportant = null;
    public $showModalDelete = false;
    public $showModalAudit = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public function getIndicadorPorCodPlanoDeAcao($cod_plano_de_acao = '', $anoSelecionado = '')
    {

        // Esta função tem o objetivo de consultar e retornar o(s) indicador(es) pelo $cod_plano_de_acao
        // --- x --- x --- x ---

        // Início da declaração da variável de consulta ao indicador
        $indicador = [];
        // Fim da declaração da variável de consulta ao indicador
        // --- x --- x --- x ---

        // Início do IF para verificar se a variável $cods_organizacao contem algum conteúdo
        if(isset($cod_plano_de_acao) && !is_null($cod_plano_de_acao) && $cod_plano_de_acao != '') {

            $indicador = Indicador::orderBy('dsc_indicador')
            ->where('cod_plano_de_acao',$cod_plano_de_acao)
            ->with('metaAno');

            if(isset($anoSelecionado) && !is_null($anoSelecionado) && $anoSelecionado != '') {

                $indicador = $indicador->whereHas('metaAno', function ($query) use($anoSelecionado) {
                    $query->where('num_ano',$anoSelecionado);
                });

            }

            $indicador = $indicador->get();

        }
        // Fim do IF para verificar se a variável $cods_organizacao contem algum conteúdo
        // --- x --- x --- x ---

        // Retorno com o resultado da função
        return $indicador;

    }

    public function obterIndicadoresPorCodIndicadorEAnoSelecionado($cod_indicador = '',$anoSelecionado = '') {

        $result = false;

        if(isset($cod_indicador) && !is_null($cod_indicador) && $cod_indicador != '') {

            $consultarIndicadorParaAcessarMetaAno = Indicador::with('metaAno');

            if(isset($anoSelecionado) && !is_null($anoSelecionado) && $anoSelecionado != '') {

                $consultarIndicadorParaAcessarMetaAno = $consultarIndicadorParaAcessarMetaAno->whereHas('metaAno', function ($query) use($anoSelecionado) {
                    $query->where('num_ano',$anoSelecionado);
                });

            }

            $consultarIndicadorParaAcessarMetaAno = $consultarIndicadorParaAcessarMetaAno->find($cod_indicador);

            if(!is_null($consultarIndicadorParaAcessarMetaAno)) {

                $result = true;

            }

        }

        return $result;

    }

    public function create() {

        $contMetaAnualPreenchida = 0;

        for($anos=2020;$anos<=2045;$anos++) {

            $column_name = 'metaAno_'.$anos;

            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '') {

                $contMetaAnualPreenchida = $contMetaAnualPreenchida + 1;

            }

        }

        if($contMetaAnualPreenchida <= 0) {

            $this->showModalImportant = true;

            $this->mensagemImportant = "Ainda não é possível gravar as informações desse indicador pois é necessário que seja informado ao menos uma Meta prevista anual e que seja feita a distribuição dessa Meta nos meses ou em um mês.<br><br>Informe agora e em seguida clique em salvar novamente.";

        } else {

            // Início da parte de controle da inserção da meta mensal

            $contAnos = 1;

            $somaMetaAno1 = 0;
            $somaMetaAno2 = 0;
            $somaMetaAno3 = 0;
            $somaMetaAno4 = 0;

            $valorMetaOriginal1 = 0;
            $valorMetaOriginal2 = 0;
            $valorMetaOriginal3 = 0;
            $valorMetaOriginal4 = 0;

            $valorMeta1 = 0;
            $valorMeta2 = 0;
            $valorMeta3 = 0;
            $valorMeta4 = 0;

            $valor = 0;

            $textoErro1 = '';
            $textoErro2 = '';
            $textoErro3 = '';
            $textoErro4 = '';

            $contNaoVazio1 = 0;
            $contNaoVazio2 = 0;
            $contNaoVazio3 = 0;
            $contNaoVazio4 = 0;

            for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                $column_name = '';

                $column_name = 'metaAno_'.$anoLoop;

                if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != ''  && $this->$column_name > 0) {

                    for ($contMes=1;$contMes<=12;$contMes++) {

                        $column_name_mes = '';

                        $column_name_mes = 'metaMes_'.$contMes.'_'.$anoLoop;

                        if(isset($this->$column_name_mes) && !is_null($this->$column_name_mes) && $this->$column_name_mes != '') {

                            if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '') {

                                if($this->dsc_unidade_medida == 'Quantidade') {

                                    $valor = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name_mes);

                                }

                                if($this->dsc_unidade_medida == 'Porcentagem') {

                                    $valor = converteValor('PTBR','MYSQL',$this->$column_name_mes);

                                    if(strlen($valor) <= 2) {

                                        $valor = $valor/100;

                                    }

                                }

                                if($this->dsc_unidade_medida == 'Dinheiro') {

                                    $valor = converteValor('PTBR','MYSQL',$this->$column_name_mes);

                                    if(strlen($valor) <= 2) {

                                        $valor = ($valor)/100;

                                    }

                                }

                            }

                            if($contAnos == 1) {

                                if($valor > 0) {

                                    $contNaoVazio1 = $contNaoVazio1 + 1;

                                    $somaMetaAno1 = (($somaMetaAno1)*1) + (($valor)*1);

                                }

                            }

                            if($contAnos == 2) {

                                if($valor > 0) {

                                    $contNaoVazio2 = $contNaoVazio2 + 1;

                                    $somaMetaAno2 = (($somaMetaAno2)*1) + (($valor)*1);

                                }

                            }

                            if($contAnos == 3) {

                                if($valor > 0) {

                                    $contNaoVazio3 = $contNaoVazio3 + 1;

                                    $somaMetaAno3 = (($somaMetaAno3)*1) + (($valor)*1);

                                }

                            }

                            if($contAnos == 4) {

                                if($valor > 0) {

                                    $contNaoVazio4 = $contNaoVazio4 + 1;

                                    $somaMetaAno4 = (($somaMetaAno4)*1) + (($valor)*1);

                                }

                            }

                        }

                    }

                    if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                        if(isset($contNaoVazio1) && !is_null($contNaoVazio1) && $contNaoVazio1 != '' && $contNaoVazio1 > 0) {

                            $somaMetaAno1 = ($somaMetaAno1)/$contNaoVazio1;

                        }

                        if(isset($contNaoVazio2) && !is_null($contNaoVazio2) && $contNaoVazio2 != '' && $contNaoVazio2 > 0) {

                            $somaMetaAno2 = ($somaMetaAno2)/$contNaoVazio2;

                        }

                        if(isset($contNaoVazio3) && !is_null($contNaoVazio3) && $contNaoVazio3 != '' && $contNaoVazio3 > 0) {

                            $somaMetaAno3 = ($somaMetaAno3)/$contNaoVazio3;

                        }

                        if(isset($contNaoVazio4) && !is_null($contNaoVazio4) && $contNaoVazio4 != '' && $contNaoVazio4 > 0) {

                            $somaMetaAno4 = ($somaMetaAno4)/$contNaoVazio4;

                        }

                    }

                    if($this->dsc_unidade_medida == 'Quantidade') {

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida quantidade

                        if($contAnos == 1) {

                            $valorMetaOriginal1 = $this->$column_name;
                            $valorMeta1 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno1 == $valorMeta1) {

                            } elseif($somaMetaAno1 < $valorMeta1) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro1 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal1." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1);

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro1 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal1." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1);

                                }

                            } elseif($somaMetaAno1 > $valorMeta1) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro1 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal1." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1)."";

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro1 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal1." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1)."";

                                }

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida quantidade

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida quantidade

                        if($contAnos == 2) {

                            $valorMetaOriginal2 = $this->$column_name;
                            $valorMeta2 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno2 == $valorMeta2) {

                            } elseif($somaMetaAno2 < $valorMeta2) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro2 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal2." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2);

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro2 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal2." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2);

                                }

                            } elseif($somaMetaAno2 > $valorMeta2) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro2 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal2." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2)."";

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro2 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal2." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2)."";

                                }

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida quantidade

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida quantidade

                        if($contAnos == 3) {

                            $valorMetaOriginal3 = $this->$column_name;
                            $valorMeta3 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno3 == $valorMeta3) {

                            } elseif($somaMetaAno3 < $valorMeta3) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro3 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal3." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3);

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro3 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal3." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3);

                                }

                            } elseif($somaMetaAno3 > $valorMeta3) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro3 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal3." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3)."";

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro3 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal3." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3)."";

                                }

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida quantidade

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida quantidade

                        if($contAnos == 4) {

                            $valorMetaOriginal4 = $this->$column_name;
                            $valorMeta4 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno4 == $valorMeta4) {

                            } elseif($somaMetaAno4 < $valorMeta4) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro4 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal4." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4);

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro4 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal4." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4);

                                }

                            } elseif($somaMetaAno4 > $valorMeta4) {

                                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Sim') {

                                    $textoErro4 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal4." e a soma da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4)."";

                                } elseif(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                                    $textoErro4 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal4." e a média da Meta prevista mensal é ".converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4)."";

                                }

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida quantidade

                        $agrupamentoTextoErros = '';

                        if(isset($textoErro1) && !is_null($textoErro1) && $textoErro1 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro1;

                        }

                        if(isset($textoErro2) && !is_null($textoErro2) && $textoErro2 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro2;

                        }

                        if(isset($textoErro3) && !is_null($textoErro3) && $textoErro3 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro3;

                        }

                        if(isset($textoErro4) && !is_null($textoErro4) && $textoErro4 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro4;

                        }

                        $this->textoErroInsercaoMetaMensal = $agrupamentoTextoErros;

                    }

                    if($this->dsc_unidade_medida == 'Porcentagem') {

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida porcentagem

                        if($contAnos == 1) {

                            $valorMetaOriginal1 = $this->$column_name;
                            $valorMeta1 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno1 == $valorMeta1) {

                            } elseif($somaMetaAno1 < $valorMeta1) {

                                $textoErro1 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal1."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno1)."%";

                            } elseif($somaMetaAno1 > $valorMeta1) {

                                $textoErro1 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal1."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno1)."%";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida porcentagem

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida porcentagem

                        if($contAnos == 2) {

                            $valorMetaOriginal2 = $this->$column_name;
                            $valorMeta2 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno2 == $valorMeta2) {

                            } elseif($somaMetaAno2 < $valorMeta2) {

                                $textoErro2 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal2."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno2)."%";

                            } elseif($somaMetaAno2 > $valorMeta2) {

                                $textoErro2 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal2."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno2)."%";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida porcentagem

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida porcentagem

                        if($contAnos == 3) {

                            $valorMetaOriginal3 = $this->$column_name;
                            $valorMeta3 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno3 == $valorMeta3) {

                            } elseif($somaMetaAno3 < $valorMeta3) {

                                $textoErro3 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal3."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno3)."%";

                            } elseif($somaMetaAno3 > $valorMeta3) {

                                $textoErro3 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal3."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno3)."%";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida porcentagem

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida porcentagem

                        if($contAnos == 4) {

                            $valorMetaOriginal4 = $this->$column_name;
                            $valorMeta4 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno4 == $valorMeta4) {

                            } elseif($somaMetaAno4 < $valorMeta4) {

                                $textoErro4 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal4."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno4)."%";

                            } elseif($somaMetaAno4 > $valorMeta4) {

                                $textoErro4 = "Meta prevista anual de ".$anoLoop." é ".$valorMetaOriginal4."% e a soma da Meta prevista mensal é ".converteValor('MYSQL','PTBR',$somaMetaAno4)."%";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida porcentagem

                        $agrupamentoTextoErros = '';

                        if(isset($textoErro1) && !is_null($textoErro1) && $textoErro1 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro1;

                        }

                        if(isset($textoErro2) && !is_null($textoErro2) && $textoErro2 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro2;

                        }

                        if(isset($textoErro3) && !is_null($textoErro3) && $textoErro3 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro3;

                        }

                        if(isset($textoErro4) && !is_null($textoErro4) && $textoErro4 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro4;

                        }

                        $this->textoErroInsercaoMetaMensal = $agrupamentoTextoErros;

                    }

                    if($this->dsc_unidade_medida == 'Dinheiro') {

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida dinheiro

                        if($contAnos == 1) {

                            $valorMetaOriginal1 = $this->$column_name;
                            $valorMeta1 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno1 == $valorMeta1) {

                            } elseif($somaMetaAno1 < $valorMeta1) {

                                $textoErro1 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal1." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno1)."";

                            } elseif($somaMetaAno1 > $valorMeta1) {

                                $textoErro1 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal1." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno1)."";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida dinheiro

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida dinheiro

                        if($contAnos == 2) {

                            $valorMetaOriginal2 = $this->$column_name;
                            $valorMeta2 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno2 == $valorMeta2) {

                            } elseif($somaMetaAno2 < $valorMeta2) {

                                $textoErro2 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal2." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno2)."";

                            } elseif($somaMetaAno2 > $valorMeta2) {

                                $textoErro2 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal2." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno2)."";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida dinheiro

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida dinheiro

                        if($contAnos == 3) {

                            $valorMetaOriginal3 = $this->$column_name;
                            $valorMeta3 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno3 == $valorMeta3) {

                            } elseif($somaMetaAno3 < $valorMeta3) {

                                $textoErro3 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal3." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno3)."";

                            } elseif($somaMetaAno3 > $valorMeta3) {

                                $textoErro3 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal3." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno3)."";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida dinheiro

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida dinheiro

                        if($contAnos == 4) {

                            $valorMetaOriginal4 = $this->$column_name;
                            $valorMeta4 = converteValor('PTBR','MYSQL',$this->$column_name);

                            if($somaMetaAno4 == $valorMeta4) {

                            } elseif($somaMetaAno4 < $valorMeta4) {

                                $textoErro4 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal4." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno4)."";

                            } elseif($somaMetaAno4 > $valorMeta4) {

                                $textoErro4 = "Meta prevista anual de ".$anoLoop." é R$ ".$valorMetaOriginal4." e a soma da Meta prevista mensal é R$ ".converteValor('MYSQL','PTBR',$somaMetaAno4)."";

                            }

                        }

                        // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida dinheiro

                        $agrupamentoTextoErros = '';

                        if(isset($textoErro1) && !is_null($textoErro1) && $textoErro1 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro1;

                        }

                        if(isset($textoErro2) && !is_null($textoErro2) && $textoErro2 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro2;

                        }

                        if(isset($textoErro3) && !is_null($textoErro3) && $textoErro3 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro3;

                        }

                        if(isset($textoErro4) && !is_null($textoErro4) && $textoErro4 != '') {

                            $agrupamentoTextoErros = $agrupamentoTextoErros.'<br><i class="fas fa-arrow-right"></i> '.$textoErro4;

                        }

                        $this->textoErroInsercaoMetaMensal = $agrupamentoTextoErros;

                    }

                }

                $contAnos = $contAnos + 1;

            }

            // Fim da parte de controle da inserção da meta mensal

            if(isset($this->textoErroInsercaoMetaMensal) && !is_null($this->textoErroInsercaoMetaMensal) && $this->textoErroInsercaoMetaMensal != '') {

                $this->showModalImportant = true;

                $this->mensagemImportant = "Existe inconsistência entre o valor preenchido da Meta prevista anual e o(s) valor(es) preenchido(s) na Meta Mensal.<br>A soma da Meta Mensal é diferente do valor da Meta prevista anual. É necessário corrigir para salvar.<br>".$this->textoErroInsercaoMetaMensal;

            } else {

                // Início do trecho para gravação

                $modificacoes = '';
                $modificacoesLinhaBase = '';
                $modificacoesMetaAno = '';
                $modificacoesMetaMes = '';
                $alteracao = array();
                $alteracaoLinhaBase = array();
                $alteracaoMetaAno = array();
                $alteracaoMetaMes = array();

                if(!$this->editarForm) {

                    // Início do trecho para verificar se esse indicador já existe, pois se existir não poderá ser gravado novamente

                    $consultarIndicador = Indicador::where('cod_plano_de_acao',$this->cod_plano_de_acao)
                    ->where('dsc_indicador',$this->dsc_indicador)
                    ->where('dsc_formula',$this->dsc_formula)
                    ->where('dsc_unidade_medida',$this->dsc_unidade_medida)
                    ->where('bln_acumulado',$this->bln_acumulado)
                    ->where('dsc_tipo',$this->dsc_tipo)
                    ->where('dsc_fonte',$this->dsc_fonte)
                    ->where('dsc_periodo_medicao',$this->dsc_periodo_medicao)
                    ->get();

                    // Fim do trecho para verificar se esse indicador já existe, pois se existir não poderá ser gravado novamente

                    if($consultarIndicador->count() <= 0) {

                        // Início do trecho para inserir um novo indicador

                        $modificacoes = "Inseriu os seguintes dados em relação ao novo Indicador:<br><br>";

                        $save = new Indicador;

                        // Início do trecho para o código do Plano de Ação

                        if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

                            $save->cod_plano_de_acao = $this->cod_plano_de_acao;

                            $consultarPlanoDeAcao = PlanoAcao::find($this->cod_plano_de_acao);

                            $modificacoes = $modificacoes . "Plano de Ação relacionado: <span class='text-green-800'>".$consultarPlanoDeAcao->num_nivel_hierarquico_apresentacao.'. '.$consultarPlanoDeAcao->dsc_plano_de_acao."</span><br>";

                        }

                        // Fim do trecho para o código do Plano de Ação

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para a descrição do indicador

                        if(isset($this->dsc_indicador) && !is_null($this->dsc_indicador) && $this->dsc_indicador != '') {

                            $save->dsc_indicador = $this->dsc_indicador;

                            $modificacoes = $modificacoes . "Descrição: <strong><span class='text-green-800'>".$this->dsc_indicador."</span></strong><br>";

                        }

                        // Fim do trecho para a descrição do indicador

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para a fórmula do indicador

                        if(isset($this->dsc_formula) && !is_null($this->dsc_formula) && $this->dsc_formula != '') {

                            $save->dsc_formula = $this->dsc_formula;

                            $modificacoes = $modificacoes . "Fórmula do Indicador: <span class='text-green-800'>".nl2br($this->dsc_formula)."</span><br>";

                        }

                        // Fim do trecho para a fórmula do indicador

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para a unidade de medida do indicador

                        if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '') {

                            $save->dsc_unidade_medida = $this->dsc_unidade_medida;

                            $dsc_unidade_medida = '';

                            if($this->dsc_unidade_medida === 'Dinheiro') {

                                $dsc_unidade_medida = 'Dinheiro R$ 0,00 (real)';

                            } else {

                                $dsc_unidade_medida = $this->dsc_unidade_medida;

                            }

                            $modificacoes = $modificacoes . "Unidade de Medida do Indicador: <span class='text-green-800'>".$dsc_unidade_medida."</span><br>";

                        }

                        // Fim do trecho para a unidade de medida do indicador

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para o campo Esse indicador terá o resultado acumulado?

                        if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '') {

                            $save->bln_acumulado = $this->bln_acumulado;

                            $modificacoes = $modificacoes . "Esse indicador terá o resultado acumulado? <span class='text-green-800'>".$this->bln_acumulado."</span><br>";

                        }

                        // Fim do trecho para o campo Esse indicador terá o resultado acumulado?

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para o campo Tipo de Análise do Indicador (Polaridade)

                        if(isset($this->dsc_tipo) && !is_null($this->dsc_tipo) && $this->dsc_tipo != '') {

                            $save->dsc_tipo = $this->dsc_tipo;

                            $modificacoes = $modificacoes . "Tipo de Análise do Indicador (Polaridade): <span class='text-green-800'>".tipoPolaridade($this->dsc_tipo)."</span><br>";

                        }

                        // Fim do trecho para o campo Tipo de Análise do Indicador (Polaridade)

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para a Fonte

                        if(isset($this->dsc_fonte) && !is_null($this->dsc_fonte) && $this->dsc_fonte != '') {

                            $save->dsc_fonte = $this->dsc_fonte;

                            $modificacoes = $modificacoes . "Fonte: <span class='text-green-800'>".nl2br($this->dsc_fonte)."</span><br>";

                        }

                        // Fim do trecho para a Fonte

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para o Período de medição

                        if(isset($this->dsc_periodo_medicao) && !is_null($this->dsc_periodo_medicao) && $this->dsc_periodo_medicao != '') {

                            $save->dsc_periodo_medicao = $this->dsc_periodo_medicao;

                            $modificacoes = $modificacoes . "Período de medição: <span class='text-green-800'>".$this->dsc_periodo_medicao."</span><br>";

                        }

                        // Fim do trecho para o Período de medição

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para Salvar a primeira parte dos dados do indicador

                        $save->save();

                        // Fim do trecho para Salvar a primeira parte dos dados do indicador

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para a Linha de Base

                        $saveLinhaBase = new LinhaBase;

                        if(isset($this->num_ano_base_1) && !is_null($this->num_ano_base_1) && $this->num_ano_base_1 != '' && isset($this->num_linha_base_1) && !is_null($this->num_linha_base_1) && $this->num_linha_base_1 != '') {

                            $saveLinhaBase->cod_indicador = $save->cod_indicador;
                            $saveLinhaBase->num_ano = $this->num_ano_base_1;
                            $saveLinhaBase->num_linha_base = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->num_linha_base_1);

                            $modificacoes = $modificacoes . "Linha de Base: <span class='text-green-800'>".$this->num_ano_base_1." - ".$this->num_linha_base_1."</span><br>";

                        }

                        // Fim do trecho para a Linha de Base

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para Salvar a Linha de base

                        $saveLinhaBase->save();

                        // Fim do trecho para Salvar a Linha de base

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início do trecho para a Meta Prevista Anual

                        $contMetaAnualPreenchida = 0;

                        for($anos=2020;$anos<=2045;$anos++) {

                            $saveMetaAno = new MetaAno;

                            $column_name = 'metaAno_'.$anos;

                            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '' && $this->$column_name > 0) {

                                $saveMetaAno->cod_indicador = $save->cod_indicador;
                                $saveMetaAno->num_ano = $anos;
                                $saveMetaAno->meta = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->$column_name);

                                // Início do trecho para Salvar a Meta Prevista Anual

                                $saveMetaAno->save();

                                // Fim do trecho para Salvar a Meta Prevista Anual

                                $modificacoes = $modificacoes . "<span class='mt-4 pt-4'>Inseriu o valor de <span class='text-green-800'><strong>".$this->$column_name."</strong></span> para a <strong>Meta Prevista Anual de ".$anos."</strong></span><br>";

                                $contMetaAnualPreenchida = $contMetaAnualPreenchida + 1;

                            }

                            // --- x --- x --- x --- x --- x --- x ---

                            // Início do trecho para gravar a Meta Prevista Mensal

                            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '' && $this->$column_name > 0) {

                                for ($contMes=1;$contMes<=12;$contMes++) {

                                    $column_name_mes = '';

                                    $column_name_mes = 'metaMes_'.$contMes.'_'.$anos;

                                    $saveMetaMensal = new EvolucaoIndicador;

                                    $saveMetaMensal->cod_indicador = $save->cod_indicador;
                                    $saveMetaMensal->num_ano = $anos;
                                    $saveMetaMensal->num_mes = $contMes;

                                    if(isset($this->$column_name_mes) && !is_null($this->$column_name_mes) && $this->$column_name_mes != '') {

                                        $saveMetaMensal->vlr_previsto = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->$column_name_mes);

                                        $modificacoes = $modificacoes . "<span class='ml-3'>Meta Prevista Mensal: <span class='text-green-800'>".mesNumeralParaExtensoCurto($contMes)."/".$anos." - ".$this->$column_name_mes."</span></span><br>";

                                    }

                                    // Início do trecho para Salvar a Meta Prevista Mensal

                                    $saveMetaMensal->save();

                                    // Fim do trecho para Salvar a Meta Prevista Mensal

                                }

                            }

                            // Fim do trecho para gravar a Meta Prevista Mensal

                        }

                        $acao = Acoes::create(array(
                            'table' => 'tab_indicador',
                            'table_id' => $save->cod_indicador,
                            'user_id' => Auth::user()->id,
                            'acao' => $modificacoes
                        ));

                        // Fim do trecho para a Meta Prevista Anual

                        $this->showModalResultadoEdicao = true;

                        $this->mensagemResultadoEdicao = $modificacoes;

                        // Fim do trecho para inserir um novo indicador

                    } else {

                        // Já existir o indicador

                        $consultarPlanoDeAcao = PlanoAcao::find($this->cod_plano_de_acao);

                        $this->showModalImportant = true;

                        $this->mensagemImportant = "Já existi esse indicador com essas mesmas características para este Plano de Ação (".$consultarPlanoDeAcao->num_nivel_hierarquico_apresentacao.'. '.$consultarPlanoDeAcao->dsc_plano_de_acao.")";

                    }

                    // --- x --- x --- x --- x --- x --- x ---

                } else {

                    // Início do trecho para editar um indicador

                    $editar = Indicador::with('linhaBase','metaAno','evolucaoIndicador')
                    ->find($this->cod_indicador);

                    $consultarPlanoDeAcao = PlanoAcao::find($editar->cod_plano_de_acao);

                    $cabecalhoModificacoes = '';

                    $cabecalhoModificacoes = 'Plano de Ação: <strong>'.$consultarPlanoDeAcao->num_nivel_hierarquico_apresentacao.'. '.$consultarPlanoDeAcao->dsc_plano_de_acao.'</strong><br>Indicador: <strong>'.$editar->dsc_indicador.'</strong><br><br>';

                    $estruturaTable = $this->estruturaTableParaEditar();

                    foreach($estruturaTable as $result) {

                        $column_name = $result->column_name;
                        $data_type = $result->data_type;

                        // Início da parte para igualar a formatação do campo de valor

                        if($data_type === 'numeric') {

                            $this->$column_name = converteValor('PTBR','MYSQL',$this->$column_name);

                        }

                        // Fim da parte para igualar a formatação do campo de valor

                        // --- x --- x --- x --- x --- x --- x ---

                        // Início da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados básicos do indicador

                        if($editar->$column_name != $this->$column_name) {

                            $alteracao[$column_name] = $this->$column_name;

                            if($data_type === 'date') {

                                $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.converterData('EN','PTBR',$editar->$column_name).' )</span> para <span style="color:#28a745;">( '.converterData('EN','PTBR',$this->$column_name).' )</span>;<br>';

                                $audit = Audit::create(array(
                                    'table' => 'tab_indicador',
                                    'table_id' => $this->cod_plano_de_acao,
                                    'column_name' => $column_name,
                                    'data_type' => $data_type,
                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                    'user_id' => Auth::user()->id,
                                    'acao' => 'Editou',
                                    'antes' => $editar->$column_name,
                                    'depois' => $this->$column_name
                                ));

                            } elseif($data_type === 'numeric') {

                                $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.converteValor('MYSQL','PTBR',$editar->$column_name).' )</span> para <span style="color:#28a745;">( '.converteValor('MYSQL','PTBR',$this->$column_name).' )</span>;<br>';

                                $audit = Audit::create(array(
                                    'table' => 'tab_indicador',
                                    'table_id' => $this->cod_plano_de_acao,
                                    'column_name' => $column_name,
                                    'data_type' => $data_type,
                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                    'user_id' => Auth::user()->id,
                                    'acao' => 'Editou',
                                    'antes' => $editar->$column_name,
                                    'depois' => converteValor('MYSQL','PTBR',$this->$column_name)
                                ));

                            } elseif($data_type === 'uuid') {

                                if($column_name === 'cod_plano_de_acao') {

                                    $consultarValorAntigo = PlanoAcao::find($editar->$column_name);

                                    $consultarValorAtualizado = PlanoAcao::find($this->$column_name);

                                    $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.$consultarValorAntigo->num_nivel_hierarquico_apresentacao.'. '.$consultarValorAntigo->dsc_plano_de_acao.' )</span> para <span style="color:#28a745;">( '.$consultarValorAtualizado->num_nivel_hierarquico_apresentacao.'. '.$consultarValorAtualizado->dsc_plano_de_acao.' )</span>;<br>';

                                    $audit = Audit::create(array(
                                        'table' => 'tab_indicador',
                                        'table_id' => $this->cod_plano_de_acao,
                                        'column_name' => $column_name,
                                        'data_type' => $data_type,
                                        'ip' => $_SERVER['REMOTE_ADDR'],
                                        'user_id' => Auth::user()->id,
                                        'acao' => 'Editou',
                                        'antes' => $consultarValorAntigo->num_nivel_hierarquico_apresentacao.'. '.$consultarValorAntigo->dsc_plano_de_acao,
                                        'depois' => $consultarValorAtualizado->num_nivel_hierarquico_apresentacao.'. '.$consultarValorAtualizado->dsc_plano_de_acao
                                    ));

                                }

                            } else {

                                $modificacoes = $modificacoes.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado($column_name).'</b> de <span style="color:#CD3333;">( '.$editar->$column_name.' )</span> para <span style="color:#28a745;">( '.$this->$column_name.' )</span>;<br>';

                                $audit = Audit::create(array(
                                    'table' => 'tab_indicador',
                                    'table_id' => $this->cod_plano_de_acao,
                                    'column_name' => $column_name,
                                    'data_type' => $data_type,
                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                    'user_id' => Auth::user()->id,
                                    'acao' => 'Editou',
                                    'antes' => $editar->$column_name,
                                    'depois' => $this->$column_name
                                ));

                            }

                        }

                        // Fim da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados básicos do indicador

                        // --- x --- x --- x --- x --- x --- x ---

                    }

                    // Início da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados da Linha de Base do indicador

                    $this->num_linha_base_1 = converteValor('PTBR','MYSQL',$this->num_linha_base_1);

                    $contLinhaBase = 1;

                    foreach($editar->linhaBase as $linhaBase) {

                        if($contLinhaBase == 1) {

                            $editarLinhaBase = LinhaBase::find($linhaBase->cod_linha_base);

                            if($linhaBase->num_ano != $this->num_ano_base_1) {

                                $alteracaoLinhaBase['num_ano'] = $this->num_ano_base_1;

                                $audit = Audit::create(array(
                                    'table' => 'tab_linha_base_indicador',
                                    'table_id' => $linhaBase->cod_linha_base,
                                    'column_name' => 'num_ano',
                                    'data_type' => 'smallint',
                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                    'user_id' => Auth::user()->id,
                                    'acao' => 'Editou',
                                    'antes' => $linhaBase->num_ano,
                                    'depois' => $this->num_ano_base_1
                                ));

                                $modificacoesLinhaBase = $modificacoesLinhaBase.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado('num_ano_base_1').'</b> de <span style="color:#CD3333;">( '.$linhaBase->num_ano.' )</span> para <span style="color:#28a745;">( '.$this->num_ano_base_1.' )</span>;<br>';

                            }

                            if($linhaBase->num_linha_base != $this->num_linha_base_1) {

                                $alteracaoLinhaBase['num_linha_base'] = $this->num_linha_base_1;

                                $audit = Audit::create(array(
                                    'table' => 'tab_linha_base_indicador',
                                    'table_id' => $linhaBase->cod_linha_base,
                                    'column_name' => 'num_linha_base',
                                    'data_type' => 'numeric',
                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                    'user_id' => Auth::user()->id,
                                    'acao' => 'Editou',
                                    'antes' => $linhaBase->num_linha_base,
                                    'depois' => $this->num_linha_base_1
                                ));

                                $modificacoesLinhaBase = $modificacoesLinhaBase.'Alterou o(a) <b>'.nomeCampoTabelaNormalizado('num_ano_base_1').'</b> de <span style="color:#CD3333;">( '.$linhaBase->num_linha_base.' )</span> para <span style="color:#28a745;">( '.formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$this->num_linha_base_1).' )</span>;<br>';

                            }

                            if(isset($modificacoesLinhaBase) && !is_null($modificacoesLinhaBase) && $modificacoesLinhaBase != '') {

                                $editarLinhaBase->update($alteracaoLinhaBase);

                            }

                        }

                        $contLinhaBase = $contLinhaBase + 1;

                    }

                    // Fim da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados da Linha de Base do indicador

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados da Meta Prevista Anual do indicador

                    for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                        $column_name = '';

                        $column_name = 'metaAno_'.$anoLoop;

                        $consultar = MetaAno::where('cod_indicador',$this->cod_indicador)
                        ->where('num_ano',$anoLoop)
                        ->first();

                        if($consultar) {

                            // Início para verificar se houve modificação da Meta Prevista Anual

                            $consultar->meta = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultar->meta);

                            $consultar->meta = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$consultar->meta);

                            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '') {

                                $this->$column_name = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->$column_name);

                            }

                            if($consultar->meta != $this->$column_name) {

                                $editarMetaAno = MetaAno::find($consultar->cod_meta_por_ano);

                                if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '') {

                                    $this->$column_name = $this->$column_name;

                                } else {

                                    $this->$column_name = NULL;

                                }

                                $alteracaoMetaAno['meta'] = $this->$column_name;

                                $audit = Audit::create(array(
                                    'table' => 'tab_meta_por_ano',
                                    'table_id' => $consultar->cod_meta_por_ano,
                                    'column_name' => 'meta',
                                    'data_type' => 'numeric',
                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                    'user_id' => Auth::user()->id,
                                    'acao' => 'Editou',
                                    'antes' => formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultar->meta),
                                    'depois' => $this->$column_name
                                ));

                                $modificacoesMetaAno = $modificacoesMetaAno.'Alterou o(a) <b>Meta prevista do ano de '.$anoLoop.'</b> de <span style="color:#CD3333;">( '.formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultar->meta).' )</span> para <span style="color:#28a745;">( '.formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$this->$column_name).' )</span>;<br>';

                                if(isset($modificacoesMetaAno) && !is_null($modificacoesMetaAno) && $modificacoesMetaAno != '') {

                                    $editarMetaAno->update($alteracaoMetaAno);

                                }

                            }

                            // Fim para verificar se houve modificação da Meta Prevista Anual

                        } else {

                            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '') {

                                $saveMetaAno = new MetaAno;

                                $saveMetaAno->cod_indicador = $this->cod_indicador;
                                $saveMetaAno->num_ano = $anoLoop;
                                $saveMetaAno->meta = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->$column_name);

                                // Início do trecho para Salvar a nova Meta Prevista Anual

                                $saveMetaAno->save();

                                $audit = Audit::create(array(
                                    'table' => 'tab_meta_por_ano',
                                    'table_id' => $saveMetaAno->cod_meta_por_ano,
                                    'column_name' => 'meta',
                                    'data_type' => 'numeric',
                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                    'user_id' => Auth::user()->id,
                                    'acao' => 'Editou',
                                    'antes' => '',
                                    'depois' => $this->$column_name
                                ));

                                // Fim do trecho para Salvar a nova Meta Prevista Anual

                                $modificacoesMetaAno = $modificacoesMetaAno . "<span class='mt-4 pt-4'>Inseriu o valor de <span class='text-green-800'><strong>".$this->$column_name."</strong></span> para a <strong>Meta Prevista Anual de ".$anoLoop."</strong></span><br>";

                            }

                        }

                    }

                    // Fim da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados da Meta Prevista Anual do indicador

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados da Meta Prevista Mensal (evolucao_indicador) do indicador

                    for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                        for ($contMes=1;$contMes<=12;$contMes++) {

                            $column_name_mes = '';

                            $column_name_mes = 'metaMes_'.$contMes.'_'.$anoLoop;

                            $consultar = EvolucaoIndicador::where('cod_indicador',$this->cod_indicador)
                            ->where('num_mes',$contMes)
                            ->where('num_ano',$anoLoop)
                            ->first();

                            if($consultar) {

                                // Início para verificar se houve modificação da Meta Prevista Mensal

                                $consultar->vlr_previsto = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultar->vlr_previsto);

                                $consultar->vlr_previsto = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$consultar->vlr_previsto);

                                if(isset($this->$column_name_mes) && !is_null($this->$column_name_mes) && $this->$column_name_mes != '') {

                                    $this->$column_name_mes = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->$column_name_mes);

                                }

                                if($consultar->vlr_previsto != $this->$column_name_mes) {

                                    $editarMetaMes = EvolucaoIndicador::find($consultar->cod_evolucao_indicador);

                                    $alteracaoMetaMes['vlr_previsto'] = $this->$column_name_mes;

                                    $audit = Audit::create(array(
                                        'table' => 'tab_evolucao_indicador',
                                        'table_id' => $consultar->cod_evolucao_indicador,
                                        'column_name' => 'vlr_previsto',
                                        'data_type' => 'numeric',
                                        'ip' => $_SERVER['REMOTE_ADDR'],
                                        'user_id' => Auth::user()->id,
                                        'acao' => 'Editou',
                                        'antes' => formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultar->vlr_previsto),
                                        'depois' => $this->$column_name_mes
                                    ));

                                    $modificacoesMetaMes = $modificacoesMetaMes.'Alterou o(a) <b>Meta prevista de '.mesNumeralParaExtenso($contMes).'/'.$anoLoop.'</b> de <span style="color:#CD3333;">( '.formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$consultar->vlr_previsto).' )</span> para <span style="color:#28a745;">( '.formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$this->$column_name_mes).' )</span>;<br>';

                                    if(isset($modificacoesMetaMes) && !is_null($modificacoesMetaMes) && $modificacoesMetaMes != '') {

                                        $editarMetaMes->update($alteracaoMetaMes);

                                    }

                                }

                                // Fim para verificar se houve modificação da Meta Prevista Mensal

                            } else {

                                if(isset($this->$column_name_mes) && !is_null($this->$column_name_mes) && $this->$column_name_mes != '') {

                                    $saveMetaMensal = new EvolucaoIndicador;

                                    $saveMetaMensal->cod_indicador = $this->cod_indicador;
                                    $saveMetaMensal->num_ano = $anoLoop;
                                    $saveMetaMensal->num_mes = $contMes;

                                    $saveMetaMensal->vlr_previsto = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'PTBR','MYSQL',$this->$column_name_mes);

                                    $modificacoesMetaMes = $modificacoesMetaMes.'Inseriu o valor de <span style="color:#28a745;">( '.formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$this->$column_name_mes).' )</span> para o(a) <b>Meta prevista de '.mesNumeralParaExtenso($contMes).'/'.$anoLoop.'</b>;<br>';

                                    // Início do trecho para Salvar a nova Meta Prevista Mensal

                                    $saveMetaMensal->save();

                                    $audit = Audit::create(array(
                                        'table' => 'tab_evolucao_indicador',
                                        'table_id' => $saveMetaMensal->cod_evolucao_indicador,
                                        'column_name' => 'vlr_previsto',
                                        'data_type' => 'numeric',
                                        'ip' => $_SERVER['REMOTE_ADDR'],
                                        'user_id' => Auth::user()->id,
                                        'acao' => 'Editou',
                                        'antes' => '',
                                        'depois' => $this->$column_name_mes
                                    ));

                                    // Fim do trecho para Salvar a nova Meta Prevista Mensal

                                }

                            }

                        }

                    }

                    // Fim da verificação se houve alteração entre o valor antigo e o atual e se houver alteração preencher o array de alteracao[] e a variável de modificacoes para os dados da Meta Prevista Mensal (evolucao_indicador) do indicador

                    // --- x --- x --- x --- x --- x --- x ---

                    if(isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '' || isset($modificacoesLinhaBase) && !is_null($modificacoesLinhaBase) && $modificacoesLinhaBase != '' || isset($modificacoesMetaAno) && !is_null($modificacoesMetaAno) && $modificacoesMetaAno != '' || isset($modificacoesMetaMes) && !is_null($modificacoesMetaMes) && $modificacoesMetaMes != '') {

                        $editar->update($alteracao);

                        $acao = Acoes::create(array(
                            'table' => 'tab_indicador',
                            'table_id' => $this->cod_plano_de_acao,
                            'user_id' => Auth::user()->id,
                            'acao' => $modificacoes.$modificacoesLinhaBase.$modificacoesMetaAno.$modificacoesMetaMes
                        ));

                        $this->showModalResultadoEdicao = true;

                        $this->mensagemResultadoEdicao = $cabecalhoModificacoes.$modificacoes.$modificacoesLinhaBase.$modificacoesMetaAno.$modificacoesMetaMes;

                    } else {

                        $this->showModalResultadoEdicao = true;

                        $this->mensagemResultadoEdicao = $cabecalhoModificacoes.'Nada foi feito, por não ter nenhuma modificação nesse indicador desse Plano de Ação.';

                    }

                    // Fim do trecho para editar um indicador

                }

                // Fim do trecho para gravação

                $this->zerarVariaveis();

                $this->abrirFecharForm = 'none';
                $this->iconAbrirFechar = 'fas fa-plus text-xs';

                $this->editarForm = false;

            }

        }

    }

    public function editForm($cod_indicador = '') {

        $singleData = Indicador::with('linhaBase','metaAno','evolucaoIndicador')
        ->find($cod_indicador);

        $this->cod_indicador = $singleData->cod_indicador;

        $consultarPlanoDeAcao = PlanoAcao::find($singleData->cod_plano_de_acao);

        $consultarObjetivoEstrategico = ObjetivoEstrategico::find($consultarPlanoDeAcao->cod_objetivo_estrategico);

        $consultarPerspectiva = Perspectiva::find($consultarObjetivoEstrategico->cod_perspectiva);

        $this->cod_pei = $consultarPerspectiva->cod_pei;

        $consultarPei = Pei::select('num_ano_inicio_pei','num_ano_fim_pei')
        ->find($this->cod_pei);

        $this->anoInicioDoPeiSelecionado = $consultarPei->num_ano_inicio_pei;

        $this->anoConclusaoDoPeiSelecionado = $consultarPei->num_ano_fim_pei;

        
        $this->cod_perspectiva = $consultarObjetivoEstrategico->cod_perspectiva;
        $this->cod_objetivo_estrategico = $consultarObjetivoEstrategico->cod_objetivo_estrategico;
        $this->cod_plano_de_acao = $singleData->cod_plano_de_acao;

        $this->dsc_indicador = $singleData->dsc_indicador;
        $this->dsc_formula = $singleData->dsc_formula;
        $this->dsc_unidade_medida = $singleData->dsc_unidade_medida;
        $this->dsc_tipo = $singleData->dsc_tipo;
        $this->bln_acumulado = $singleData->bln_acumulado;

        $this->dsc_fonte = $singleData->dsc_fonte;
        $this->dsc_periodo_medicao = $singleData->dsc_periodo_medicao;

        foreach($singleData->linhaBase as $linhaBase) {

            $this->num_ano_base_1 = $linhaBase->num_ano;
            $this->num_linha_base_1 = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$linhaBase->num_linha_base);

        }

        foreach($singleData->metaAno as $metaAno) {

            for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                $column_name = '';

                $column_name = 'metaAno_'.$anoLoop;

                // public $metaAno_2020 = null;

                if($metaAno->num_ano == $anoLoop) {

                    $this->$column_name = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$metaAno->meta);

                }

            }

        }

        foreach($singleData->evolucaoIndicador as $metaMes) {

            for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                for ($contMes=1;$contMes<=12;$contMes++) {

                    $column_name_mes = '';

                    $column_name_mes = 'metaMes_'.$contMes.'_'.$anoLoop;

                    // public $metaMes_1_2020 = null;

                    if($metaMes->num_ano == $anoLoop && $metaMes->num_mes == $contMes) {

                        $this->$column_name_mes = formatarValorConformeUnidadeMedida($this->dsc_unidade_medida,'MYSQL','PTBR',$metaMes->vlr_previsto);

                    }

                }

            }

        }

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm($cod_indicador = '') {

        $singleData = Indicador::with('linhaBase','metaAno','evolucaoIndicador')
        ->find($cod_indicador);

        $this->cod_indicador = $singleData->cod_indicador;

        $consultarPlanoDeAcao = PlanoAcao::find($singleData->cod_plano_de_acao);

        $consultarObjetivoEstrategico = ObjetivoEstrategico::find($consultarPlanoDeAcao->cod_objetivo_estrategico);

        $consultarPerspectiva = Perspectiva::find($consultarObjetivoEstrategico->cod_perspectiva);

        $this->cod_pei = $consultarPerspectiva->cod_pei;

        $consultarPei = Pei::select('num_ano_inicio_pei','num_ano_fim_pei')
        ->find($this->cod_pei);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-900 text-xs leading-relaxed"><strong>Dados do Indicador para confirmar a exclusão</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Relacionado(a) ao PEI: <strong>'.$consultarPei->dsc_pei.' ('.$consultarPei->num_ano_inicio_pei.' a '.$consultarPei->num_ano_fim_pei.')</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Perspectiva: <strong>'.$consultarPerspectiva->num_nivel_hierarquico_apresentacao.'. '.$consultarPerspectiva->dsc_perspectiva.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Objetivo Estratégico: <strong>'.$consultarObjetivoEstrategico->num_nivel_hierarquico_apresentacao.'. '.$consultarObjetivoEstrategico->dsc_objetivo_estrategico.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Plano de Ação: <strong>'.$consultarPlanoDeAcao->num_nivel_hierarquico_apresentacao.'. '.$consultarPlanoDeAcao->dsc_plano_de_acao.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">_________________________________</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Descrição do Indicador: <strong>'.$singleData->dsc_indicador.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Unidade de Medida do Indicador: <strong>'.$singleData->dsc_unidade_medida.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Esse indicador terá o resultado acumulado? <strong>'.$singleData->bln_acumulado.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Tipo de Análise do Indicador (Polaridade): <strong>'.tipoPolaridade($singleData->dsc_tipo).'</strong></p><p class="my-2 text-gray-500 text-xs font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->dsc_missao = null;
        $this->cod_pei = null;
        $this->cod_organizacao = null;
        $this->editarForm = false;

    }

    public function delete($cod_indicador = '') {

        $this->showModalDelete = false;

        $singleData = Indicador::with('linhaBase','metaAno','evolucaoIndicador')
        ->find($cod_indicador);

        $this->cod_indicador = $singleData->cod_indicador;

        $consultarPlanoDeAcao = PlanoAcao::find($singleData->cod_plano_de_acao);

        $consultarObjetivoEstrategico = ObjetivoEstrategico::find($consultarPlanoDeAcao->cod_objetivo_estrategico);

        $consultarPerspectiva = Perspectiva::find($consultarObjetivoEstrategico->cod_perspectiva);

        $this->cod_pei = $consultarPerspectiva->cod_pei;

        $consultarPei = Pei::select('num_ano_inicio_pei','num_ano_fim_pei')
        ->find($this->cod_pei);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-900 text-xs leading-relaxed"><strong>Excluiu com sucesso este Indicador</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Relacionado(a) ao PEI: <strong>'.$consultarPei->dsc_pei.' ('.$consultarPei->num_ano_inicio_pei.' a '.$consultarPei->num_ano_fim_pei.')</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Perspectiva: <strong>'.$consultarPerspectiva->num_nivel_hierarquico_apresentacao.'. '.$consultarPerspectiva->dsc_perspectiva.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Objetivo Estratégico: <strong>'.$consultarObjetivoEstrategico->num_nivel_hierarquico_apresentacao.'. '.$consultarObjetivoEstrategico->dsc_objetivo_estrategico.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Plano de Ação: <strong>'.$consultarPlanoDeAcao->num_nivel_hierarquico_apresentacao.'. '.$consultarPlanoDeAcao->dsc_plano_de_acao.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">_________________________________</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Descrição do Indicador: <strong>'.$singleData->dsc_indicador.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Unidade de Medida do Indicador: <strong>'.$singleData->dsc_unidade_medida.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Esse indicador terá o resultado acumulado? <strong>'.$singleData->bln_acumulado.'</strong></p><p class="my-2 text-gray-500 text-xs leading-relaxed">Tipo de Análise do Indicador (Polaridade): <strong>'.tipoPolaridade($singleData->dsc_tipo).'</strong></p>';

        $acao = Acoes::create(array(
            'table' => 'tab_indicador',
            'table_id' => $this->cod_indicador,
            'user_id' => Auth::user()->id,
            'acao' => $texto
        ));

        $consultarLinhaBaseParaExcluir = LinhaBase::where('cod_indicador',$this->cod_indicador)
        ->get(['cod_linha_base']);

        LinhaBase::destroy($consultarLinhaBaseParaExcluir->toArray());

        $consultarMetaAnoParaExcluir = MetaAno::where('cod_indicador',$this->cod_indicador)
        ->get(['cod_meta_por_ano']);

        MetaAno::destroy($consultarMetaAnoParaExcluir->toArray());

        $consultarEvolucaoIndicadorParaExcluir = EvolucaoIndicador::where('cod_indicador',$this->cod_indicador)
        ->get(['cod_evolucao_indicador']);

        EvolucaoIndicador::destroy($consultarEvolucaoIndicadorParaExcluir->toArray());

        $singleData->delete();

        $this->zerarVariaveis();

        $this->editarForm = false;

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $texto;

    }

    public function adequarMascara() {

        if(isset($this->vlr_meta) && !is_null($this->vlr_meta) && $this->vlr_meta != '') {

            $valorOriginalVlrMeta = $this->vlr_meta;

            $this->vlr_meta = null;

            $this->mensagemResultadoEdicao = "Você alterou a Unidade de Medida.<br>Dessa forma o valor informado da Meta que era (".$valorOriginalVlrMeta.") será apagado para que digite o valor correspondente a Unidade de Medida selecionada (".$this->dsc_unidade_medida.")";

            $this->showModalResultadoEdicao = true;

        }

    }

    public function abrirFecharForm() {

        if($this->abrirFecharForm === 'none') {

            $this->cod_perspectiva = null;
            $this->cod_pei = null;
            $this->dsc_perspectiva = null;
            $this->num_nivel_hierarquico_apresentacao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'block';
            $this->iconAbrirFechar = 'fas fa-minus text-xs';

        } else {

            $this->cod_perspectiva = null;
            $this->cod_pei = null;
            $this->dsc_perspectiva = null;
            $this->num_nivel_hierarquico_apresentacao = null;
            $this->editarForm = false;

            $this->abrirFecharForm = 'none';
            $this->iconAbrirFechar = 'fas fa-plus text-xs';

        }

    }

    public function audit($texto = '') {

        $this->mensagemDelete = $texto;

        $this->showModalAudit = true;

        $this->editarForm = false;

    }

    public function cancelar() {

        $this->zerarVariaveis();
        
        $this->editarForm = false;

    }

    public function render()
    {

        if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

            $consultarPlanoDeAcao = PlanoAcao::find($this->cod_plano_de_acao);

            $dataInicioPlanoDeAcao = strtotime($consultarPlanoDeAcao->dte_inicio);
            $dataConclusaoPlanoDeAcao = strtotime($consultarPlanoDeAcao->dte_fim);

            $this->anoInicioDoPlanoDeAcaoSelecionado = date('Y',$dataInicioPlanoDeAcao);
            $this->anoConclusaoDoPlanoDeAcaoSelecionado = date('Y',$dataConclusaoPlanoDeAcao);

            $this->mesInicioDoPlanoDeAcaoSelecionado = date('n',$dataInicioPlanoDeAcao);
            $this->mesConclusaoDoPlanoDeAcaoSelecionado = date('n',$dataConclusaoPlanoDeAcao);

        } else {



        }

        $indicadores = Pei::with('perspectivas','perspectivas.objetivosEstrategicos','perspectivas.objetivosEstrategicos.planosDeAcao','perspectivas.objetivosEstrategicos.planosDeAcao.indicadores','perspectivas.objetivosEstrategicos.planosDeAcao.indicadores.linhaBase','perspectivas.objetivosEstrategicos.planosDeAcao.indicadores.metaAno','perspectivas.objetivosEstrategicos.planosDeAcao.indicadores.evolucaoIndicador','perspectivas.objetivosEstrategicos.planosDeAcao.indicadores.acoesRealizadas');

        // Início para montagem dos anos da linha de base

        $anos = [];
        for ($index=date('Y')-1;$index>=2012;$index-=1) {
            $anos[$index * 1] = $index * 1;
        }

        $this->anosLinhaBase = $anos;

        // Fim para montagem dos anos da linha de base

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
        ->where('dsc_pei','!=','')
        ->whereNotNull('dsc_pei')
        ->orderBy('dsc_pei')
        ->pluck('dsc_pei', 'cod_pei');

        $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

        if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $perspectiva = $perspectiva->where('cod_pei',$this->cod_pei);

            $indicadores = $indicadores->where('cod_pei',$this->cod_pei);

        } else {

            $perspectiva = $perspectiva->whereNull('cod_pei');

        }

        $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao','desc')
        ->pluck('dsc_perspectiva','cod_perspectiva');

        $this->perspectiva = $perspectiva;

        $objetivoEstrategico = ObjetivoEstrategico::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_objetivo_estrategico AS dsc_objetivo_estrategico, cod_objetivo_estrategico"));

        if(isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '') {

            Session()->put('cod_perspectiva', $this->cod_perspectiva);

        } else {

            Session()->forget('cod_perspectiva');

        }

        if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '' && isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $perspectiva->count() > 0) {

            $objetivoEstrategico = $objetivoEstrategico->where('cod_perspectiva',$this->cod_perspectiva);

        } else {

            $objetivoEstrategico = $objetivoEstrategico->whereNull('cod_perspectiva');

        }

        $objetivoEstrategico = $objetivoEstrategico->orderBy('num_nivel_hierarquico_apresentacao')
        ->with('perspectiva')
        ->pluck('dsc_objetivo_estrategico','cod_objetivo_estrategico');

        $this->objetivoEstragico = $objetivoEstrategico;

        if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $consultarPei = Pei::select('num_ano_inicio_pei','num_ano_fim_pei')
            ->find($this->cod_pei);

            if($perspectiva->count() > 0) {

                $this->anoInicioDoPeiSelecionado = $consultarPei->num_ano_inicio_pei;

                $this->anoConclusaoDoPeiSelecionado = $consultarPei->num_ano_fim_pei;

                $this->habilitarCampoInserirMetas = 'block';

                $primeiroAnoDoPeiSelecionado = $consultarPei->num_ano_inicio_pei;

                $ultimoAnoDoPeiSelecionado = $consultarPei->num_ano_fim_pei;

                $this->primeiroAnoDoPeiSelecionado = $primeiroAnoDoPeiSelecionado.'-01-01';

                $this->ultimoAnoDoPeiSelecionado = $ultimoAnoDoPeiSelecionado.'-12-31';

                $contAnos = 1;

                for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                    if($contAnos == 1) {

                        $this->ano1 = $anoLoop;

                    }

                    if($contAnos == 2) {

                        $this->ano2 = $anoLoop;

                    }

                    if($contAnos == 3) {

                        $this->ano3 = $anoLoop;

                    }

                    if($contAnos == 4) {

                        $this->ano4 = $anoLoop;

                    }

                    $contAnos = $contAnos + 1;

                }

            } else {

                $this->habilitarCampoInserirMetas = 'none';

            }

        } else {

            $this->primeiroAnoDoPeiSelecionado = '2020-01-01';

            $this->ultimoAnoDoPeiSelecionado = '2051-12-31';

        }

        $contAnos = 1;

        if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '' && isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '') {

            // Início da abertura dos campos de preenchimento da linha de base e das metas previstas anuais

            $this->inputAnoLinhaBaseClass = 'block w-full mt-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-3';

            $this->inputValorLinhaBaseClass = 'block w-full mt-1 rounded-r-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-right pl-3';

            

            // Fim da abertura dos campos de preenchimento da linha de base e das metas previstas anuais

            $contAnos = 1;

            for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                $column_name = '';

                $column_name = 'metaAno_'.$anoLoop;

                $column_name_input_class_mes = '';

                $column_name_input_class_mes = 'inputValorMesAno'.$contAnos.'Class';

                $column_name_ano_required = 'requiredMetaAno_'.$anoLoop;

                if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '' && $this->$column_name > 0) {

                    $this->$column_name_input_class_mes = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right';

                    $this->$column_name_ano_required = 'required';

                } else {

                    $this->$column_name_input_class_mes = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right ler-somente';

                    $this->$column_name_ano_required = '';

                }

                $contAnos = $contAnos + 1;
            }

        } else {

            // Início do fechamento dos campos de preenchimento da linha de base e das metas previstas anuais

            $this->inputAnoLinhaBaseClass = 'block w-full mt-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-3 ler-somente';

            $this->inputValorLinhaBaseClass = 'block w-full mt-1 rounded-r-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-right pl-3 ler-somente';

            $this->inputValorClass = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 text-right ler-somente';

            // Fim do fechamento dos campos de preenchimento da linha de base e das metas previstas anuais

            $contAnos = 1;

            for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

                $column_name_input_class_mes = '';

                $column_name_input_class_mes = 'inputValorMesAno'.$contAnos.'Class';

                $this->$column_name_input_class_mes = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right ler-somente';


                for ($contMes=1;$contMes<=12;$contMes++) {

                    $column_name_mes = '';

                    $column_name_mes = 'metaMes_'.$contMes.'_'.$anoLoop;

                    $column_name_soma = '';

                    $column_name_soma = 'somaMetaAno'.$contMes;

                    $this->$column_name_mes = null;

                    $this->$column_name_soma = null;

                }

                $contAnos = $contAnos + 1;
            }

        }

        $contAnos = 1;

        $somaMetaAno1 = 0;
        $somaMetaAno2 = 0;
        $somaMetaAno3 = 0;
        $somaMetaAno4 = 0;

        $valorMetaOriginal1 = 0;
        $valorMetaOriginal2 = 0;
        $valorMetaOriginal3 = 0;
        $valorMetaOriginal4 = 0;

        $valorMeta1 = 0;
        $valorMeta2 = 0;
        $valorMeta3 = 0;
        $valorMeta4 = 0;

        $texto1 = '';
        $texto2 = '';
        $texto3 = '';
        $texto4 = '';

        $valor = 0;

        $textoErro1 = '';
        $textoErro2 = '';
        $textoErro3 = '';
        $textoErro4 = '';

        $contNaoVazio1 = 0;
        $contNaoVazio2 = 0;
        $contNaoVazio3 = 0;
        $contNaoVazio4 = 0;

        for($anoLoop=($this->anoInicioDoPeiSelecionado)*1;$anoLoop<=($this->anoConclusaoDoPeiSelecionado)*1;$anoLoop++) {

            $column_name = '';

            $column_name = 'metaAno_'.$anoLoop;

            if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != ''  && $this->$column_name > 0) {

                $somaMetaAno1 = 0;
                $somaMetaAno2 = 0;
                $somaMetaAno3 = 0;
                $somaMetaAno4 = 0;

                $this->somaMetaAno1 = 0;
                $this->somaMetaAno2 = 0;
                $this->somaMetaAno3 = 0;
                $this->somaMetaAno4 = 0;

                for ($contMes=1;$contMes<=12;$contMes++) {

                    $column_name_mes = '';

                    $column_name_mes = 'metaMes_'.$contMes.'_'.$anoLoop;

                    if(isset($this->$column_name_mes) && !is_null($this->$column_name_mes) && $this->$column_name_mes != '') {

                        if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '') {

                            if($this->dsc_unidade_medida == 'Quantidade') {

                                $valor = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name_mes);

                            }

                            if($this->dsc_unidade_medida == 'Porcentagem') {

                                $valor = converteValor('PTBR','MYSQL',$this->$column_name_mes);

                                if(strlen($valor) <= 2) {

                                    $valor = $valor/100;

                                }

                            }

                            if($this->dsc_unidade_medida == 'Dinheiro') {

                                $valor = converteValor('PTBR','MYSQL',$this->$column_name_mes);

                                if(strlen($valor) <= 2) {

                                    $valor = ($valor)/100;

                                }

                            }

                        }

                        if($contAnos == 1) {

                            if($valor > 0) {

                                $contNaoVazio1 = $contNaoVazio1 + 1;

                                $somaMetaAno1 = (($somaMetaAno1)*1) + (($valor)*1);

                            }

                        }

                        if($contAnos == 2) {

                            if($valor > 0) {

                                $contNaoVazio2 = $contNaoVazio2 + 1;

                                $somaMetaAno2 = (($somaMetaAno2)*1) + (($valor)*1);

                            }

                        }

                        if($contAnos == 3) {

                            if($valor > 0) {

                                $contNaoVazio3 = $contNaoVazio3 + 1;

                                $somaMetaAno3 = (($somaMetaAno3)*1) + (($valor)*1);

                            }

                        }

                        if($contAnos == 4) {

                            if($valor > 0) {

                                $contNaoVazio4 = $contNaoVazio4 + 1;

                                $somaMetaAno4 = (($somaMetaAno4)*1) + (($valor)*1);

                            }

                        }

                    }

                }

                if(isset($this->bln_acumulado) && !is_null($this->bln_acumulado) && $this->bln_acumulado != '' && $this->bln_acumulado === 'Não') {

                    if(isset($contNaoVazio1) && !is_null($contNaoVazio1) && $contNaoVazio1 != '' && $contNaoVazio1 > 0) {

                        $somaMetaAno1 = ($somaMetaAno1)/$contNaoVazio1;

                    }

                    if(isset($contNaoVazio2) && !is_null($contNaoVazio2) && $contNaoVazio2 != '' && $contNaoVazio2 > 0) {

                        $somaMetaAno2 = ($somaMetaAno2)/$contNaoVazio2;

                    }

                    if(isset($contNaoVazio3) && !is_null($contNaoVazio3) && $contNaoVazio3 != '' && $contNaoVazio3 > 0) {

                        $somaMetaAno3 = ($somaMetaAno3)/$contNaoVazio3;

                    }

                    if(isset($contNaoVazio4) && !is_null($contNaoVazio4) && $contNaoVazio4 != '' && $contNaoVazio4 > 0) {

                        $somaMetaAno4 = ($somaMetaAno4)/$contNaoVazio4;

                    }

                }

                if($this->dsc_unidade_medida == 'Quantidade') {

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida quantidade

                    if($contAnos == 1) {

                        $valorMetaOriginal1 = $this->$column_name;
                        $valorMeta1 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno1 == $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto1 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1).'</strong></p>';

                        } elseif($somaMetaAno1 < $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto1 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1).'</strong></p>';

                        } elseif($somaMetaAno1 > $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto1 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal1.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno1 = $texto1;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida quantidade

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida quantidade

                    if($contAnos == 2) {

                        $valorMetaOriginal2 = $this->$column_name;
                        $valorMeta2 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno2 == $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto2 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2).'</strong></p>';

                        } elseif($somaMetaAno2 < $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto2 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2).'</strong></p>';

                        } elseif($somaMetaAno2 > $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto2 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal2.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno2 = $texto2;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida quantidade

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida quantidade

                    if($contAnos == 3) {

                        $valorMetaOriginal3 = $this->$column_name;
                        $valorMeta3 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno3 == $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto3 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3).'</strong></p>';

                        } elseif($somaMetaAno3 < $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto3 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3).'</strong></p>';

                        } elseif($somaMetaAno3 > $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto3 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal3.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno3 = $texto3;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida quantidade

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida quantidade

                    if($contAnos == 4) {

                        $valorMetaOriginal4 = $this->$column_name;
                        $valorMeta4 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno4 == $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto4 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4).'</strong></p>';

                        } elseif($somaMetaAno4 < $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto4 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4).'</strong></p>';

                        } elseif($somaMetaAno4 > $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto4 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal4.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno4 = $texto4;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida quantidade

                }

                if($this->dsc_unidade_medida == 'Porcentagem') {

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida porcentagem

                    if($contAnos == 1) {

                        $valorMetaOriginal1 = $this->$column_name;
                        $valorMeta1 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno1 == $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>%</p>';

                        } elseif($somaMetaAno1 < $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>%</p>';

                        } elseif($somaMetaAno1 > $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto1 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>% é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal1.'</strong>%.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno1 = $texto1;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida porcentagem

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida porcentagem

                    if($contAnos == 2) {

                        $valorMetaOriginal2 = $this->$column_name;
                        $valorMeta2 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno2 == $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>%</p>';

                        } elseif($somaMetaAno2 < $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>%</p>';

                        } elseif($somaMetaAno2 > $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto2 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>% é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal2.'</strong>%.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno2 = $texto2;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida porcentagem

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida porcentagem

                    if($contAnos == 3) {

                        $valorMetaOriginal3 = $this->$column_name;
                        $valorMeta3 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno3 == $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>%</p>';

                        } elseif($somaMetaAno3 < $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>%</p>';

                        } elseif($somaMetaAno3 > $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto3 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>% é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal3.'</strong>%.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno3 = $texto3;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida porcentagem

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida porcentagem

                    if($contAnos == 4) {

                        $valorMetaOriginal4 = $this->$column_name;
                        $valorMeta4 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno4 == $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>%</p>';

                        } elseif($somaMetaAno4 < $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                            $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>%</p>';

                        } elseif($somaMetaAno4 > $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto4 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>% é maior que a Meta prevista anual de '.$anoLoop.' que é <strong>'.$valorMetaOriginal4.'</strong>%.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno4 = $texto4;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida porcentagem

                }

                if($this->dsc_unidade_medida == 'Dinheiro') {

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida dinheiro

                    if($contAnos == 1) {

                        $valorMetaOriginal1 = $this->$column_name;
                        $valorMeta1 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno1 == $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong></p>';

                        } elseif($somaMetaAno1 < $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong></p>';

                        } elseif($somaMetaAno1 > $valorMeta1) {

                            $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto1 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é R$ <strong>'.$valorMetaOriginal1.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno1 = $texto1;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1 com a unidade de medida dinheiro

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida dinheiro

                    if($contAnos == 2) {

                        $valorMetaOriginal2 = $this->$column_name;
                        $valorMeta2 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno2 == $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong></p>';

                        } elseif($somaMetaAno2 < $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong></p>';

                        } elseif($somaMetaAno2 > $valorMeta2) {

                            $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto2 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é R$ <strong>'.$valorMetaOriginal2.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno2 = $texto2;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2 com a unidade de medida dinheiro

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida dinheiro

                    if($contAnos == 3) {

                        $valorMetaOriginal3 = $this->$column_name;
                        $valorMeta3 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno3 == $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong></p>';

                        } elseif($somaMetaAno3 < $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong></p>';

                        } elseif($somaMetaAno3 > $valorMeta3) {

                            $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto3 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é R$ <strong>'.$valorMetaOriginal3.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno3 = $texto3;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3 com a unidade de medida dinheiro

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida dinheiro

                    if($contAnos == 4) {

                        $valorMetaOriginal4 = $this->$column_name;
                        $valorMeta4 = converteValor('PTBR','MYSQL',$this->$column_name);

                        if($somaMetaAno4 == $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong></p>';

                        } elseif($somaMetaAno4 < $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                            $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong></p>';

                        } elseif($somaMetaAno4 > $valorMeta4) {

                            $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                            $texto4 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong> é maior que a Meta prevista anual de '.$anoLoop.' que é R$ <strong>'.$valorMetaOriginal4.'</strong>.<br>É necessário corrigir.</p>';

                        }

                    }

                    $this->somaMetaAno4 = $texto4;

                    // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4 com a unidade de medida dinheiro

                }

                for ($contMes=1;$contMes<=12;$contMes++) {

                    $column_name_mes = '';

                    $column_name_mes = 'metaMes_'.$contMes.'_'.$anoLoop;

                    if(is_null($this->$column_name_mes) && $this->$column_name_mes == '') {

                        $this->$column_name_mes = 0;

                    }

                }

            } else {

                $column_name_input_class_mes = '';

                $column_name_input_class_mes = 'inputValorMesAno'.$contAnos.'Class';

                $column_name_ano_required = 'requiredMetaAno_'.$anoLoop;

                $this->$column_name_input_class_mes = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right ler-somente';

                $this->$column_name_ano_required = '';

                for ($contMes=1;$contMes<=12;$contMes++) {

                    $column_name_mes = '';

                    $column_name_mes = 'metaMes_'.$contMes.'_'.$anoLoop;

                    $this->$column_name_mes = null;

                }

            }

            $contAnos = $contAnos + 1;

        }

        $this->estruturaTable = $this->estruturaTable();

        $planoAcao = PlanoAcao::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_plano_de_acao AS dsc_plano_de_acao, cod_plano_de_acao"))
        ->with('objetivoEstrategico')
        ->orderBy('num_nivel_hierarquico_apresentacao');

        if(isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $perspectiva->count() > 0 && $objetivoEstrategico->count() > 0 && isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '') {

            $planoAcao = $planoAcao->where('cod_objetivo_estrategico',$this->cod_objetivo_estrategico);

        } else {

            $planoAcao = $planoAcao->whereNull('cod_objetivo_estrategico');

        }

        $planoAcao = $planoAcao->whereHas('objetivoEstrategico', function ($query) {
            $query->orderBy('num_nivel_hierarquico_apresentacao');
        });

        $planoAcao = $planoAcao->pluck('dsc_plano_de_acao','cod_plano_de_acao');

        $this->planoAcao = $planoAcao;

        if(isset($this->cod_objetivo_estrategico) && !is_null($this->cod_objetivo_estrategico) && $this->cod_objetivo_estrategico != '') {

            Session()->put('cod_objetivo_estrategico', $this->cod_objetivo_estrategico);

        } else {

            Session()->forget('cod_objetivo_estrategico');

        }

        if(isset($this->cod_plano_de_acao) && !is_null($this->cod_plano_de_acao) && $this->cod_plano_de_acao != '') {

            Session()->put('cod_plano_de_acao', $this->cod_plano_de_acao);

        } else {

            Session()->forget('cod_plano_de_acao');

        }

        $indicadores = $indicadores->get();

        $this->indicadores = $indicadores;

        return view('livewire.indicadores-livewire',['anoInicioDoPeiSelecionado' => $this->anoInicioDoPeiSelecionado, 'anoConclusaoDoPeiSelecionado' => $this->anoConclusaoDoPeiSelecionado]);
    }

    protected function estruturaTable() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_indicador' 
            AND column_name NOT IN ('cod_indicador','cod_plano_de_acao','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function estruturaTableParaEditar() {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_indicador' 
            AND column_name NOT IN ('cod_indicador','num_peso','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function hierarquiaUnidade($cod_organizacao) {

        $organizacao = Organization::with('hierarquia')
        ->where('cod_organizacao',$cod_organizacao)
        ->get();

        $hierarquiaSuperior = null;

        foreach($organizacao as $result1) {

            if($result1->hierarquia) {

                foreach($result1->hierarquia as $result2) {

                    $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result2->sgl_organizacao;

                    $organizacao2 = Organization::with('hierarquia')
                    ->where('cod_organizacao',$result2->cod_organizacao)
                    ->get();

                    foreach($organizacao2 as $result3) {

                        if($result3->hierarquia) {

                            foreach($result3->hierarquia as $result4) {

                                $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result4->sgl_organizacao;

                                $organizacao3 = Organization::with('hierarquia')
                                ->where('cod_organizacao',$result4->cod_organizacao)
                                ->get();

                                foreach($organizacao3 as $result5) {

                                    if($result5->hierarquia) {

                                        foreach($result5->hierarquia as $result6) {

                                            $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result6->sgl_organizacao;

                                            $organizacao4 = Organization::with('hierarquia')
                                            ->where('cod_organizacao',$result6->cod_organizacao)
                                            ->get();

                                            foreach($organizacao4 as $result7) {

                                                if($result7->hierarquia) {

                                                    foreach($result7->hierarquia as $result8) {

                                                        $hierarquiaSuperior = $hierarquiaSuperior.'/'.$result8->sgl_organizacao;

                                                    }

                                                }

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

        return $hierarquiaSuperior;

    }

    protected function zerarVariaveis() {

        $this->cod_pei = null;
        $this->pei = [];
        $this->cod_perspectiva = null;
        $this->perspectiva = [];
        $this->cod_objetivo_estrategico = null;
        $this->objetivoEstragico = [];

        $this->cod_indicador = null;

        $this->cod_plano_de_acao = null;
        $this->planoAcao = [];
        $this->dsc_indicador = null;
        $this->dsc_formula = null;
        $this->tiposIndicadores = ['+' => 'Quanto maior for o resultado melhor','-' => 'Quanto menor for o resultado melhor','=' => 'Quanto igual for o resultado melhor'];
        $this->dsc_unidade_medida = null;
        $this->unidadesMedida = ['Quantidade' => 'Quantidade','Porcentagem' => 'Porcentagem','Dinheiro' => 'Dinheiro R$ 0,00 (real)'];

        $this->dsc_tipo = null;
        $this->dsc_fonte = null;
        $this->dsc_periodo_medicao = null;
        $this->bln_acumulado = null;

        $this->vlr_meta = null;

        $this->tirarReadonly = false;

        $this->adequarMascara = null;

        $this->hierarquiaUnidade = null;

        $this->anoInicioDoPeiSelecionado = null;
        $this->anoConclusaoDoPeiSelecionado = null;

        $this->habilitarCampoInserirMetas = 'none';

        $this->primeiroAnoDoPeiSelecionado = null;
        $this->ultimoAnoDoPeiSelecionado = null;

        $this->anosLinhaBase = null;

        $this->num_ano_base_1 = null;
        $this->num_ano_base_2 = null;
        $this->num_ano_base_3 = null;

        $this->num_linha_base_1 = null;
        $this->num_linha_base_2 = null;
        $this->num_linha_base_3 = null;

        $this->metaAno_2020 = null;
        $this->metaAno_2021 = null;
        $this->metaAno_2022 = null;
        $this->metaAno_2023 = null;
        $this->metaAno_2024 = null;
        $this->metaAno_2025 = null;
        $this->metaAno_2026 = null;
        $this->metaAno_2027 = null;
        $this->metaAno_2028 = null;
        $this->metaAno_2029 = null;
        $this->metaAno_2030 = null;
        $this->metaAno_2031 = null;
        $this->metaAno_2032 = null;
        $this->metaAno_2033 = null;
        $this->metaAno_2034 = null;
        $this->metaAno_2035 = null;
        $this->metaAno_2036 = null;
        $this->metaAno_2037 = null;
        $this->metaAno_2038 = null;
        $this->metaAno_2039 = null;
        $this->metaAno_2040 = null;
        $this->metaAno_2041 = null;
        $this->metaAno_2042 = null;
        $this->metaAno_2043 = null;
        $this->metaAno_2044 = null;
        $this->metaAno_2045 = null;

        $this->metaMes_1_2020 = null;
        $this->metaMes_2_2020 = null;
        $this->metaMes_3_2020 = null;
        $this->metaMes_4_2020 = null;
        $this->metaMes_5_2020 = null;
        $this->metaMes_6_2020 = null;
        $this->metaMes_7_2020 = null;
        $this->metaMes_8_2020 = null;
        $this->metaMes_9_2020 = null;
        $this->metaMes_10_2020 = null;
        $this->metaMes_11_2020 = null;
        $this->metaMes_12_2020 = null;
        $this->metaMes_1_2021 = null;
        $this->metaMes_2_2021 = null;
        $this->metaMes_3_2021 = null;
        $this->metaMes_4_2021 = null;
        $this->metaMes_5_2021 = null;
        $this->metaMes_6_2021 = null;
        $this->metaMes_7_2021 = null;
        $this->metaMes_8_2021 = null;
        $this->metaMes_9_2021 = null;
        $this->metaMes_10_2021 = null;
        $this->metaMes_11_2021 = null;
        $this->metaMes_12_2021 = null;
        $this->metaMes_1_2022 = null;
        $this->metaMes_2_2022 = null;
        $this->metaMes_3_2022 = null;
        $this->metaMes_4_2022 = null;
        $this->metaMes_5_2022 = null;
        $this->metaMes_6_2022 = null;
        $this->metaMes_7_2022 = null;
        $this->metaMes_8_2022 = null;
        $this->metaMes_9_2022 = null;
        $this->metaMes_10_2022 = null;
        $this->metaMes_11_2022 = null;
        $this->metaMes_12_2022 = null;
        $this->metaMes_1_2023 = null;
        $this->metaMes_2_2023 = null;
        $this->metaMes_3_2023 = null;
        $this->metaMes_4_2023 = null;
        $this->metaMes_5_2023 = null;
        $this->metaMes_6_2023 = null;
        $this->metaMes_7_2023 = null;
        $this->metaMes_8_2023 = null;
        $this->metaMes_9_2023 = null;
        $this->metaMes_10_2023 = null;
        $this->metaMes_11_2023 = null;
        $this->metaMes_12_2023 = null;
        $this->metaMes_1_2024 = null;
        $this->metaMes_2_2024 = null;
        $this->metaMes_3_2024 = null;
        $this->metaMes_4_2024 = null;
        $this->metaMes_5_2024 = null;
        $this->metaMes_6_2024 = null;
        $this->metaMes_7_2024 = null;
        $this->metaMes_8_2024 = null;
        $this->metaMes_9_2024 = null;
        $this->metaMes_10_2024 = null;
        $this->metaMes_11_2024 = null;
        $this->metaMes_12_2024 = null;
        $this->metaMes_1_2025 = null;
        $this->metaMes_2_2025 = null;
        $this->metaMes_3_2025 = null;
        $this->metaMes_4_2025 = null;
        $this->metaMes_5_2025 = null;
        $this->metaMes_6_2025 = null;
        $this->metaMes_7_2025 = null;
        $this->metaMes_8_2025 = null;
        $this->metaMes_9_2025 = null;
        $this->metaMes_10_2025 = null;
        $this->metaMes_11_2025 = null;
        $this->metaMes_12_2025 = null;
        $this->metaMes_1_2026 = null;
        $this->metaMes_2_2026 = null;
        $this->metaMes_3_2026 = null;
        $this->metaMes_4_2026 = null;
        $this->metaMes_5_2026 = null;
        $this->metaMes_6_2026 = null;
        $this->metaMes_7_2026 = null;
        $this->metaMes_8_2026 = null;
        $this->metaMes_9_2026 = null;
        $this->metaMes_10_2026 = null;
        $this->metaMes_11_2026 = null;
        $this->metaMes_12_2026 = null;
        $this->metaMes_1_2027 = null;
        $this->metaMes_2_2027 = null;
        $this->metaMes_3_2027 = null;
        $this->metaMes_4_2027 = null;
        $this->metaMes_5_2027 = null;
        $this->metaMes_6_2027 = null;
        $this->metaMes_7_2027 = null;
        $this->metaMes_8_2027 = null;
        $this->metaMes_9_2027 = null;
        $this->metaMes_10_2027 = null;
        $this->metaMes_11_2027 = null;
        $this->metaMes_12_2027 = null;
        $this->metaMes_1_2028 = null;
        $this->metaMes_2_2028 = null;
        $this->metaMes_3_2028 = null;
        $this->metaMes_4_2028 = null;
        $this->metaMes_5_2028 = null;
        $this->metaMes_6_2028 = null;
        $this->metaMes_7_2028 = null;
        $this->metaMes_8_2028 = null;
        $this->metaMes_9_2028 = null;
        $this->metaMes_10_2028 = null;
        $this->metaMes_11_2028 = null;
        $this->metaMes_12_2028 = null;
        $this->metaMes_1_2029 = null;
        $this->metaMes_2_2029 = null;
        $this->metaMes_3_2029 = null;
        $this->metaMes_4_2029 = null;
        $this->metaMes_5_2029 = null;
        $this->metaMes_6_2029 = null;
        $this->metaMes_7_2029 = null;
        $this->metaMes_8_2029 = null;
        $this->metaMes_9_2029 = null;
        $this->metaMes_10_2029 = null;
        $this->metaMes_11_2029 = null;
        $this->metaMes_12_2029 = null;
        $this->metaMes_1_2030 = null;
        $this->metaMes_2_2030 = null;
        $this->metaMes_3_2030 = null;
        $this->metaMes_4_2030 = null;
        $this->metaMes_5_2030 = null;
        $this->metaMes_6_2030 = null;
        $this->metaMes_7_2030 = null;
        $this->metaMes_8_2030 = null;
        $this->metaMes_9_2030 = null;
        $this->metaMes_10_2030 = null;
        $this->metaMes_11_2030 = null;
        $this->metaMes_12_2030 = null;
        $this->metaMes_1_2031 = null;
        $this->metaMes_2_2031 = null;
        $this->metaMes_3_2031 = null;
        $this->metaMes_4_2031 = null;
        $this->metaMes_5_2031 = null;
        $this->metaMes_6_2031 = null;
        $this->metaMes_7_2031 = null;
        $this->metaMes_8_2031 = null;
        $this->metaMes_9_2031 = null;
        $this->metaMes_10_2031 = null;
        $this->metaMes_11_2031 = null;
        $this->metaMes_12_2031 = null;
        $this->metaMes_1_2032 = null;
        $this->metaMes_2_2032 = null;
        $this->metaMes_3_2032 = null;
        $this->metaMes_4_2032 = null;
        $this->metaMes_5_2032 = null;
        $this->metaMes_6_2032 = null;
        $this->metaMes_7_2032 = null;
        $this->metaMes_8_2032 = null;
        $this->metaMes_9_2032 = null;
        $this->metaMes_10_2032 = null;
        $this->metaMes_11_2032 = null;
        $this->metaMes_12_2032 = null;
        $this->metaMes_1_2033 = null;
        $this->metaMes_2_2033 = null;
        $this->metaMes_3_2033 = null;
        $this->metaMes_4_2033 = null;
        $this->metaMes_5_2033 = null;
        $this->metaMes_6_2033 = null;
        $this->metaMes_7_2033 = null;
        $this->metaMes_8_2033 = null;
        $this->metaMes_9_2033 = null;
        $this->metaMes_10_2033 = null;
        $this->metaMes_11_2033 = null;
        $this->metaMes_12_2033 = null;
        $this->metaMes_1_2034 = null;
        $this->metaMes_2_2034 = null;
        $this->metaMes_3_2034 = null;
        $this->metaMes_4_2034 = null;
        $this->metaMes_5_2034 = null;
        $this->metaMes_6_2034 = null;
        $this->metaMes_7_2034 = null;
        $this->metaMes_8_2034 = null;
        $this->metaMes_9_2034 = null;
        $this->metaMes_10_2034 = null;
        $this->metaMes_11_2034 = null;
        $this->metaMes_12_2034 = null;
        $this->metaMes_1_2035 = null;
        $this->metaMes_2_2035 = null;
        $this->metaMes_3_2035 = null;
        $this->metaMes_4_2035 = null;
        $this->metaMes_5_2035 = null;
        $this->metaMes_6_2035 = null;
        $this->metaMes_7_2035 = null;
        $this->metaMes_8_2035 = null;
        $this->metaMes_9_2035 = null;
        $this->metaMes_10_2035 = null;
        $this->metaMes_11_2035 = null;
        $this->metaMes_12_2035 = null;
        $this->metaMes_1_2036 = null;
        $this->metaMes_2_2036 = null;
        $this->metaMes_3_2036 = null;
        $this->metaMes_4_2036 = null;
        $this->metaMes_5_2036 = null;
        $this->metaMes_6_2036 = null;
        $this->metaMes_7_2036 = null;
        $this->metaMes_8_2036 = null;
        $this->metaMes_9_2036 = null;
        $this->metaMes_10_2036 = null;
        $this->metaMes_11_2036 = null;
        $this->metaMes_12_2036 = null;
        $this->metaMes_1_2037 = null;
        $this->metaMes_2_2037 = null;
        $this->metaMes_3_2037 = null;
        $this->metaMes_4_2037 = null;
        $this->metaMes_5_2037 = null;
        $this->metaMes_6_2037 = null;
        $this->metaMes_7_2037 = null;
        $this->metaMes_8_2037 = null;
        $this->metaMes_9_2037 = null;
        $this->metaMes_10_2037 = null;
        $this->metaMes_11_2037 = null;
        $this->metaMes_12_2037 = null;
        $this->metaMes_1_2038 = null;
        $this->metaMes_2_2038 = null;
        $this->metaMes_3_2038 = null;
        $this->metaMes_4_2038 = null;
        $this->metaMes_5_2038 = null;
        $this->metaMes_6_2038 = null;
        $this->metaMes_7_2038 = null;
        $this->metaMes_8_2038 = null;
        $this->metaMes_9_2038 = null;
        $this->metaMes_10_2038 = null;
        $this->metaMes_11_2038 = null;
        $this->metaMes_12_2038 = null;
        $this->metaMes_1_2039 = null;
        $this->metaMes_2_2039 = null;
        $this->metaMes_3_2039 = null;
        $this->metaMes_4_2039 = null;
        $this->metaMes_5_2039 = null;
        $this->metaMes_6_2039 = null;
        $this->metaMes_7_2039 = null;
        $this->metaMes_8_2039 = null;
        $this->metaMes_9_2039 = null;
        $this->metaMes_10_2039 = null;
        $this->metaMes_11_2039 = null;
        $this->metaMes_12_2039 = null;
        $this->metaMes_1_2040 = null;
        $this->metaMes_2_2040 = null;
        $this->metaMes_3_2040 = null;
        $this->metaMes_4_2040 = null;
        $this->metaMes_5_2040 = null;
        $this->metaMes_6_2040 = null;
        $this->metaMes_7_2040 = null;
        $this->metaMes_8_2040 = null;
        $this->metaMes_9_2040 = null;
        $this->metaMes_10_2040 = null;
        $this->metaMes_11_2040 = null;
        $this->metaMes_12_2040 = null;
        $this->metaMes_1_2041 = null;
        $this->metaMes_2_2041 = null;
        $this->metaMes_3_2041 = null;
        $this->metaMes_4_2041 = null;
        $this->metaMes_5_2041 = null;
        $this->metaMes_6_2041 = null;
        $this->metaMes_7_2041 = null;
        $this->metaMes_8_2041 = null;
        $this->metaMes_9_2041 = null;
        $this->metaMes_10_2041 = null;
        $this->metaMes_11_2041 = null;
        $this->metaMes_12_2041 = null;
        $this->metaMes_1_2042 = null;
        $this->metaMes_2_2042 = null;
        $this->metaMes_3_2042 = null;
        $this->metaMes_4_2042 = null;
        $this->metaMes_5_2042 = null;
        $this->metaMes_6_2042 = null;
        $this->metaMes_7_2042 = null;
        $this->metaMes_8_2042 = null;
        $this->metaMes_9_2042 = null;
        $this->metaMes_10_2042 = null;
        $this->metaMes_11_2042 = null;
        $this->metaMes_12_2042 = null;
        $this->metaMes_1_2043 = null;
        $this->metaMes_2_2043 = null;
        $this->metaMes_3_2043 = null;
        $this->metaMes_4_2043 = null;
        $this->metaMes_5_2043 = null;
        $this->metaMes_6_2043 = null;
        $this->metaMes_7_2043 = null;
        $this->metaMes_8_2043 = null;
        $this->metaMes_9_2043 = null;
        $this->metaMes_10_2043 = null;
        $this->metaMes_11_2043 = null;
        $this->metaMes_12_2043 = null;
        $this->metaMes_1_2044 = null;
        $this->metaMes_2_2044 = null;
        $this->metaMes_3_2044 = null;
        $this->metaMes_4_2044 = null;
        $this->metaMes_5_2044 = null;
        $this->metaMes_6_2044 = null;
        $this->metaMes_7_2044 = null;
        $this->metaMes_8_2044 = null;
        $this->metaMes_9_2044 = null;
        $this->metaMes_10_2044 = null;
        $this->metaMes_11_2044 = null;
        $this->metaMes_12_2044 = null;
        $this->metaMes_1_2045 = null;
        $this->metaMes_2_2045 = null;
        $this->metaMes_3_2045 = null;
        $this->metaMes_4_2045 = null;
        $this->metaMes_5_2045 = null;
        $this->metaMes_6_2045 = null;
        $this->metaMes_7_2045 = null;
        $this->metaMes_8_2045 = null;
        $this->metaMes_9_2045 = null;
        $this->metaMes_10_2045 = null;
        $this->metaMes_11_2045 = null;
        $this->metaMes_12_2045 = null;

        $this->requiredMetaAno_2020 = null;
        $this->requiredMetaAno_2021 = null;
        $this->requiredMetaAno_2022 = null;
        $this->requiredMetaAno_2023 = null;
        $this->requiredMetaAno_2024 = null;
        $this->requiredMetaAno_2025 = null;
        $this->requiredMetaAno_2026 = null;
        $this->requiredMetaAno_2027 = null;
        $this->requiredMetaAno_2028 = null;
        $this->requiredMetaAno_2029 = null;
        $this->requiredMetaAno_2030 = null;
        $this->requiredMetaAno_2031 = null;
        $this->requiredMetaAno_2032 = null;
        $this->requiredMetaAno_2033 = null;
        $this->requiredMetaAno_2034 = null;
        $this->requiredMetaAno_2035 = null;
        $this->requiredMetaAno_2036 = null;
        $this->requiredMetaAno_2037 = null;
        $this->requiredMetaAno_2038 = null;
        $this->requiredMetaAno_2039 = null;
        $this->requiredMetaAno_2040 = null;
        $this->requiredMetaAno_2041 = null;
        $this->requiredMetaAno_2042 = null;
        $this->requiredMetaAno_2043 = null;
        $this->requiredMetaAno_2044 = null;
        $this->requiredMetaAno_2045 = null;

        $this->ano1 = null;
        $this->ano2 = null;
        $this->ano3 = null;
        $this->ano4 = null;

        $this->somaMetaAno1 = null;
        $this->somaMetaAno2 = null;
        $this->somaMetaAno3 = null;
        $this->somaMetaAno4 = null;

        $this->erroInsercaoMetaMensal = false;
        $this->textoErroInsercaoMetaMensal = null;

        $this->inputAnoLinhaBaseClass = null;
        $this->inputValorLinhaBaseClass = null;

        $this->inputValorClass = null;

        $this->inputValorMesAno1Class = null;
        $this->inputValorMesAno2Class = null;
        $this->inputValorMesAno3Class = null;
        $this->inputValorMesAno4Class = null;

    }
}

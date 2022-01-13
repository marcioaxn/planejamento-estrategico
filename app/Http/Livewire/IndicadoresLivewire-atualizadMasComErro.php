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
use App\Models\EvolucaoIndicador;
use App\Models\LinhaBase;
use App\Models\User;
use App\Models\RelUsersTabOrganizacoesTabPerfilAcesso;
use App\Models\Acoes;
use DB;
Use Auth;
use Illuminate\Support\Str;

class IndicadoresLivewire extends Component
{

    public $cod_pei = null;
    public $pei = [];
    public $cod_perspectiva = null;
    public $perspectiva = [];
    public $cod_objetivo_estrategico = null;
    public $objetivoEstragico = [];

    public $cod_indicador = null;
    public $cod_plano_de_acao = null;
    public $planoAcao = [];
    public $dsc_tipo = null;
    public $dsc_indicador = null;
    public $dsc_formula = null;
    public $tiposIndicadores = ['+' => 'Quanto maior for o resultado melhor','-' => 'Quanto menor for o resultado melhor','=' => 'Quanto igual for o resultado melhor'];
    public $dsc_unidade_medida = null;
    public $unidadesMedida = ['Quantidade' => 'Quantidade','Porcentagem' => 'Porcentagem','Dinheiro' => 'Dinheiro R$ 0,00 (real)'];
    public $vlr_meta = null;

    public $tirarReadonly = false;

    public $adequarMascara = null;

    public $hierarquiaUnidade = null;

    public $anoInicioDoPeiSelecionado = null;
    public $anoConclusaoDoPeiSelecionado = null;

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

    public $require_linha_base_1 = false;
    public $require_linha_base_2 = false;
    public $require_linha_base_3 = false;

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

    public $inputAnoLinhaBaseClass = null;
    public $inputValorLinhaBaseClass = null;

    public $inputValorClass = null;

    public $inputValorMesAno1Class = null;
    public $inputValorMesAno2Class = null;
    public $inputValorMesAno3Class = null;
    public $inputValorMesAno4Class = null;

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

            if($this->erroInsercaoMetaMensal == false) {

                $this->showModalImportant = true;

                $this->mensagemImportant = "Existe inconsistência entre o valor preenchido da Meta prevista anual e o(s) valor(es) preenchido(s) na Meta Mensal. A soma da Meta Mensal é diferente do valor da Meta prevista anual. É necessário corrigir para salvar.";

            } else {

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = "Aqui 6";

            }

        }

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

        $this->cod_indicador = null;
        
        $this->editarForm = false;

    }

    public function render()
    {

        // Início para montagem dos anos da linha de base

        $anos = [];
        for ($index=date('Y')-1;$index>=2000;$index-=1) {
            $anos[$index * 1] = $index * 1;
        }

        $this->anosLinhaBase = $anos;

        // Fim para montagem dos anos da linha de base

        // Início para verificar se existe preenchimento de algum item da linha de base e solicitar o preenchimento completo, do ano e o valor.

        if(isset($this->num_ano_base_1) && !is_null($this->num_ano_base_1) && $this->num_ano_base_1 != '') {

            $this->require_linha_base_1 = true;

        }

        if(isset($this->num_ano_base_2) && !is_null($this->num_ano_base_2) && $this->num_ano_base_2 != '') {

            $this->require_linha_base_2 = true;

        }

        if(isset($this->num_ano_base_3) && !is_null($this->num_ano_base_3) && $this->num_ano_base_3 != '') {

            $this->require_linha_base_3 = true;

        }

        if(isset($this->num_linha_base_1) && !is_null($this->num_linha_base_1) && $this->num_linha_base_1 != '') {

            $this->require_linha_base_1 = true;

        }

        if(isset($this->num_linha_base_2) && !is_null($this->num_linha_base_2) && $this->num_linha_base_2 != '') {

            $this->require_linha_base_2 = true;

        }

        if(isset($this->num_linha_base_3) && !is_null($this->num_linha_base_3) && $this->num_linha_base_3 != '') {

            $this->require_linha_base_3 = true;

        }

        // Fim para verificar se existe preenchimento de algum item da linha de base e solicitar o preenchimento completo, do ano e o valor.

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
        ->where('dsc_pei','!=','')
        ->whereNotNull('dsc_pei')
        ->orderBy('dsc_pei')
        ->pluck('dsc_pei', 'cod_pei');

        $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

        if(isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

            $perspectiva = $perspectiva->where('cod_pei',$this->cod_pei);

        } else {

            $perspectiva = $perspectiva->whereNull('cod_pei');

        }

        $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao','desc')
        ->pluck('dsc_perspectiva','cod_perspectiva');

        $this->perspectiva = $perspectiva;

        $objetivoEstrategico = ObjetivoEstrategico::select(DB::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_objetivo_estrategico AS dsc_objetivo_estrategico, cod_objetivo_estrategico"));

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

                for($i=($this->anoInicioDoPeiSelecionado)*1;$i<=($this->anoConclusaoDoPeiSelecionado)*1;$i++) {

                    if($contAnos == 1) {

                        $this->ano1 = $i;

                    }

                    if($contAnos == 2) {

                        $this->ano2 = $i;

                    }

                    if($contAnos == 3) {

                        $this->ano3 = $i;

                    }

                    if($contAnos == 4) {

                        $this->ano4 = $i;

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

        if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '') {

            // Início da abertura dos campos de preenchimento da linha de base e das metas previstas anuais. Caso o campo Unidade de Medida do Indicador tenha um item selecionado.

            $this->inputAnoLinhaBaseClass = 'block w-full mt-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-3';

            $this->inputValorLinhaBaseClass = 'block w-full mt-1 rounded-r-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-right pl-3';

            $this->inputValorClass = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 text-right';

            // Fim da abertura dos campos de preenchimento da linha de base e das metas previstas anuais. Caso o campo Unidade de Medida do Indicador tenha um item selecionado.

            $contAnos = 1;

            for($i=($this->anoInicioDoPeiSelecionado)*1;$i<=($this->anoConclusaoDoPeiSelecionado)*1;$i++) {

                $column_name = '';

                $column_name = 'metaAno_'.$i;

                $column_name_input_class_mes = '';

                $column_name_input_class_mes = 'inputValorMesAno'.$contAnos.'Class';

                $column_name_ano_required = 'requiredMetaAno_'.$i;

                if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != '' && $this->$column_name > 0) {

                    // Início da montagem da classe do input da meta mensal e se esse input terá a propriedade required. Caso o input da meta prevista anual esteja preenchida.

                    $this->$column_name_input_class_mes = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right';

                    $this->$column_name_ano_required = 'required';

                    // Fim da montagem da classe do input da meta mensal e se esse input terá a propriedade required. Caso o input da meta prevista anual esteja preenchida.

                    // --- x --- x --- x --- x --- x --- x ---

                    // Início da montagem e cálculo do somatório das metas mensais

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

                    if(isset($this->$column_name) && !is_null($this->$column_name) && $this->$column_name != ''  && $this->$column_name > 0) {

                        $this->somaMetaAno1 = 0;
                        $this->somaMetaAno2 = 0;
                        $this->somaMetaAno3 = 0;
                        $this->somaMetaAno4 = 0;

                        for ($contMes=1;$contMes<=12;$contMes++) {

                            $column_name_mes = '';

                            $column_name_mes = 'metaMes_'.$contMes.'_'.$i;

                            if(isset($this->$column_name_mes) && !is_null($this->$column_name_mes) && $this->$column_name_mes != '') {

                                if(isset($this->dsc_unidade_medida) && !is_null($this->dsc_unidade_medida) && $this->dsc_unidade_medida != '') {

                                    if($this->dsc_unidade_medida == 'Quantidade') {

                                        $valor = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name_mes);

                                    }

                                    if($this->dsc_unidade_medida == 'Porcentagem' || $this->dsc_unidade_medida == 'Dinheiro') {

                                        $valor = converteValor('PTBR','MYSQL',$this->$column_name_mes);

                                        if(strlen($valor) <= 2) {

                                            $valor = ($valor)/100;

                                        }

                                    }

                                }

                                if($contAnos == 1) {

                                    $somaMetaAno1 = (($somaMetaAno1)*1) + (($valor)*1);

                                }

                                if($contAnos == 2) {

                                    $somaMetaAno2 = (($somaMetaAno2)*1) + (($valor)*1);

                                }

                                if($contAnos == 3) {

                                    $somaMetaAno3 = (($somaMetaAno3)*1) + (($valor)*1);

                                }

                                if($contAnos == 4) {

                                    $somaMetaAno4 = (($somaMetaAno4)*1) + (($valor)*1);

                                }

                            }

                        }

                        if($this->dsc_unidade_medida == 'Quantidade') {

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1

                            if($contAnos == 1) {

                                $valorMetaOriginal1 = $this->$column_name;
                                $valorMeta1 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno1 < $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-400 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto1 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno1 == $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto1 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno1 > $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto1 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno1).'</strong> é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal1.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto1 .= '</p>';

                            $this->somaMetaAno1 = $texto1;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2

                            if($contAnos == 2) {

                                $valorMetaOriginal2 = $this->$column_name;
                                $valorMeta2 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno2 < $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto2 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno2 == $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto2 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno2 > $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto2 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno2).'</strong> é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal2.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto2 .= '</p>';

                            $this->somaMetaAno2 = $texto2;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3

                            if($contAnos == 3) {

                                $valorMetaOriginal3 = $this->$column_name;
                                $valorMeta3 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno3 < $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto3 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno3 == $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto3 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno3 > $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto3 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno3).'</strong> é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal3.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto3 .= '</p>';

                            $this->somaMetaAno3 = $texto3;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4

                            if($contAnos == 4) {

                                $valorMetaOriginal4 = $this->$column_name;
                                $valorMeta4 = converteValorSemCasasDecimais('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno4 < $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto4 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno4 == $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto4 .= converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno4 > $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto4 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValorSemCasasDecimais('MYSQL','PTBR',$somaMetaAno4).'</strong> é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal4.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto4 .= '</p>';

                            $this->somaMetaAno4 = $texto4;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4

                        }

                        if($this->dsc_unidade_medida == 'Porcentagem') {

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1

                            if($contAnos == 1) {

                                $valorMetaOriginal1 = $this->$column_name;
                                $valorMeta1 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno1 < $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>%';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno1 == $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>%';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno1 > $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto1 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>% é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal1.'</strong>%.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto1 .= '</p>';

                            $this->somaMetaAno1 = $texto1;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2

                            if($contAnos == 2) {

                                $valorMetaOriginal2 = $this->$column_name;
                                $valorMeta2 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno2 < $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>%';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno2 == $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>%';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno2 > $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto2 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>% é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal2.'</strong>%.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto2 .= '</p>';

                            $this->somaMetaAno2 = $texto2;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3

                            if($contAnos == 3) {

                                $valorMetaOriginal3 = $this->$column_name;
                                $valorMeta3 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno3 < $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>%';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno3 == $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>%';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno3 > $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto3 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>% é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal3.'</strong>%.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto3 .= '</p>';

                            $this->somaMetaAno3 = $texto3;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4

                            if($contAnos == 4) {

                                $valorMetaOriginal4 = $this->$column_name;
                                $valorMeta4 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno4 < $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>%';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno4 == $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: <strong>';

                                $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>%';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno4 > $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto4 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>% é maior que a Meta anual de '.$i.' que é <strong>'.$valorMetaOriginal4.'</strong>%.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto4 .= '</p>';

                            $this->somaMetaAno4 = $texto4;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4

                        }

                        if($this->dsc_unidade_medida == 'Dinheiro') {

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 1

                            if($contAnos == 1) {

                                $valorMetaOriginal1 = $this->$column_name;
                                $valorMeta1 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno1 < $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno1 == $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto1 .= converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno1 > $valorMeta1) {

                                $texto1 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto1 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno1).'</strong> é maior que a Meta anual de '.$i.' que é R$ <strong>'.$valorMetaOriginal1.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto1 .= '</p>';

                            $this->somaMetaAno1 = $texto1;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 1

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 2

                            if($contAnos == 2) {

                                $valorMetaOriginal2 = $this->$column_name;
                                $valorMeta2 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno2 < $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno2 == $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto2 .= converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno2 > $valorMeta2) {

                                $texto2 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto2 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno2).'</strong> é maior que a Meta anual de '.$i.' que é R$ <strong>'.$valorMetaOriginal2.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto2 .= '</p>';

                            $this->somaMetaAno2 = $texto2;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 2

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 3

                            if($contAnos == 3) {

                                $valorMetaOriginal3 = $this->$column_name;
                                $valorMeta3 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno3 < $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno3 == $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto3 .= converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno3 > $valorMeta3) {

                                $texto3 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto3 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno3).'</strong> é maior que a Meta anual de '.$i.' que é R$ <strong>'.$valorMetaOriginal3.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto3 .= '</p>';

                            $this->somaMetaAno3 = $texto3;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 3

                            // Início da parte de verificação se a soma já atingiu a meta proposta do Ano 4

                            if($contAnos == 4) {

                                $valorMetaOriginal4 = $this->$column_name;
                                $valorMeta4 = converteValor('PTBR','MYSQL',$this->$column_name);

                            }

                            if($somaMetaAno4 < $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-300 border-yellow-900 text-black rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>';

                                $this->erroInsercaoMetaMensal = true;

                            } elseif($somaMetaAno4 == $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-green-600 border-green-600 text-white rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-10"> Subtotal: R$ <strong>';

                                $texto4 .= converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong>';

                                $this->erroInsercaoMetaMensal = false;

                            } elseif($somaMetaAno4 > $valorMeta4) {

                                $texto4 = '<p class="break-words text-sm text-right subpixel-antialiased tracking-wide bg-yellow-50 border-red-600 text-red-600 rounded-md shadow-md mt-3 pt-2 pb-2 pl-2 pr-3 h-24">';

                                $texto4 .= '<i class="fas fa-exclamation-triangle text-red-900"></i> O subtotal R$ <strong>'.converteValor('MYSQL','PTBR',$somaMetaAno4).'</strong> é maior que a Meta anual de '.$i.' que é R$ <strong>'.$valorMetaOriginal4.'</strong>.<br>É necessário corrigir.';

                                $this->erroInsercaoMetaMensal = true;

                            }

                            $texto4 .= '</p>';

                            $this->somaMetaAno4 = $texto4;

                            // Fim da parte de verificação se a soma já atingiu a meta proposta do Ano 4

                        }

                    }

                    // Fim da montagem e cálculo do somatório das metas mensais

                    // Início da limpeza dos inputs da meta mensal, caso o input da meta prevista anual não esteja preenchido.

                    for ($contMes=1;$contMes<=12;$contMes++) {

                        $column_name_mes = '';

                        $column_name_mes = 'metaMes_'.$contMes.'_'.$i;

                        if(is_null($this->$column_name_mes) && $this->$column_name_mes == '') {

                            $this->$column_name_mes = 0;

                        }

                    }

                    // Fim da limpeza dos inputs da meta mensal, caso o input da meta prevista anual não esteja preenchido.

                } else {

                    // Início da montagem da classe do input da meta mensal e se esse input terá a propriedade required. Caso o input da meta prevista anual não esteja preenchida.

                    $this->$column_name_input_class_mes = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-0 pt-2 pl-2 h-9 text-right ler-somente';

                    $this->$column_name_ano_required = '';

                    // Fim da montagem da classe do input da meta mensal e se esse input terá a propriedade required. Caso o input da meta prevista anual não esteja preenchida.

                    // Início da limpeza dos inputs da meta mensal, caso o input da meta prevista anual não esteja preenchido.

                    for ($contMes=1;$contMes<=12;$contMes++) {

                        $column_name_mes = '';

                        $column_name_mes = 'metaMes_'.$contMes.'_'.$i;

                        $this->$column_name_mes = null;

                    }

                    // Fim da limpeza dos inputs da meta mensal, caso o input da meta prevista anual não esteja preenchido.

                }

                $contAnos = $contAnos + 1;
            }

        } else {

            // Início do fechamento dos campos de preenchimento da linha de base e das metas previstas anuais. Caso não o campo Unidade de Medida do Indicador não tenha um item selecionado

            $this->inputAnoLinhaBaseClass = 'block w-full mt-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-3 ler-somente';

            $this->inputValorLinhaBaseClass = 'block w-full mt-1 rounded-r-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-right pl-3 ler-somente';

            $this->inputValorClass = 'w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 pt-2 pl-2 text-right ler-somente';

            // Fim do fechamento dos campos de preenchimento da linha de base e das metas previstas anuais. Caso não o campo Unidade de Medida do Indicador não tenha um item selecionado

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
            AND column_name NOT IN ('cod_indicador','created_at','updated_at','deleted_at');");

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
}

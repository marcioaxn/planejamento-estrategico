<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pei;
use App\Models\Perspectiva;
use App\Models\ObjetivoEstrategico;
use App\Models\NumNivelHierarquico;
use Livewire\WithPagination;
use App\Models\Acoes;
use App\Models\Audit;
use App\Models\FuturoAlmejado;
use App\Models\TabAudit;
use Ramsey\Uuid\Uuid;
use DB;
use Auth;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\QueryException;

class ObjetivoEstrategicoLivewire extends Component
{

    public $objetivoEstragico = null;
    public $pei = null;
    public $perspectiva = null;
    public $cod_pei = null;
    public $estruturaTable = null;
    public $cod_objetivo_estrategico = null;
    public $nom_objetivo_estrategico = null;
    public $dsc_objetivo_estrategico = null;
    public $niveis_hierarquico_apresentacao = null;
    public $num_nivel_hierarquico_apresentacao = null;
    public $cod_perspectiva = null;
    public $pesquisarCodigo = null;

    public $futurosAlmejados = [];

    public $dsc_futuro_almejado = [];

    public $editarForm = false;
    public $deleteForm = false;
    public $showModalResultadoEdicao = false;
    public $mensagemResultadoEdicao = null;
    public $showModalDelete = false;
    public $mensagemDelete = null;

    public $abrirFecharForm = 'none';
    public $iconAbrirFechar = 'fas fa-plus text-xs';
    public $iconFechar = 'fas fa-minus text-xs';

    public function mount()
    {
        $this->dsc_futuro_almejado[] = ''; // Inicializa com um campo vazio
    }

    public function getObjetivoEstrategico($codObjetivoEstrategico = null)
    {
        if (isset($codObjetivoEstrategico) && !empty($codObjetivoEstrategico)) {
            return ObjetivoEstrategico::find($codObjetivoEstrategico);
        } else {
            return null;
        }
    }

    public function addFuturoAlmejado()
    {
        // Adiciona um novo campo vazio ao array
        $this->dsc_futuro_almejado[] = '';
    }

    public function removeFuturoAlmejado($index)
    {
        unset($this->dsc_futuro_almejado[$index]);
        // $this->dsc_futuro_almejado = array_values($this->dsc_futuro_almejado); // Reindexa o array
    }

    protected function pesquisarCodigo($cod_perspectiva = '')
    {

        $this->num_nivel_hierarquico_apresentacao = '';

        if (isset($cod_perspectiva) && !is_null($cod_perspectiva) && $cod_perspectiva != '') {

            $objetivoEstragico = ObjetivoEstrategico::select('num_nivel_hierarquico_apresentacao')
                ->where('cod_perspectiva', $cod_perspectiva)
                ->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
                ->first();

            if ($objetivoEstragico) {

                $this->num_nivel_hierarquico_apresentacao = (($objetivoEstragico->num_nivel_hierarquico_apresentacao) + 1);

            } else {

                $this->num_nivel_hierarquico_apresentacao = 1;

            }

        }

        return $this->num_nivel_hierarquico_apresentacao;

    }

    public function abrirFecharForm()
    {

        if ($this->abrirFecharForm === 'none') {

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

    public function create()
    {

        $modificacoes = '';
        $alteracao = array();

        if (!$this->editarForm) {

            $modificacoes = "Inseriu os seguintes dados em relação ao Objetivo Estratégico:<br><br>";

            $save = new ObjetivoEstrategico;

            $save->cod_perspectiva = $this->cod_perspectiva;

            $consultarPerspectiva = Perspectiva::find($this->cod_perspectiva);

            $modificacoes = $modificacoes . "Perspectiva: <span class='text-green-800'>" . $consultarPerspectiva->num_nivel_hierarquico_apresentacao . ". " . $consultarPerspectiva->dsc_perspectiva . "</span><br>";

            if (isset($this->num_nivel_hierarquico_apresentacao) && !is_null($this->num_nivel_hierarquico_apresentacao) && $this->num_nivel_hierarquico_apresentacao != '') {

                $save->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

                $modificacoes = $modificacoes . "Código: <span class='text-green-800'>" . $this->num_nivel_hierarquico_apresentacao . "</span><br>";

            }

            if (isset($this->nom_objetivo_estrategico) && !is_null($this->nom_objetivo_estrategico) && $this->nom_objetivo_estrategico != '') {

                $save->nom_objetivo_estrategico = $this->nom_objetivo_estrategico;

                $modificacoes = $modificacoes . "Objetivo Estratégico: <span class='text-green-800'>" . $this->nom_objetivo_estrategico . "</span><br>";

            }

            if (isset($this->dsc_objetivo_estrategico) && !is_null($this->dsc_objetivo_estrategico) && $this->dsc_objetivo_estrategico != '') {

                $save->dsc_objetivo_estrategico = $this->dsc_objetivo_estrategico;

                $modificacoes = $modificacoes . "Descrição do Objetivo Estratégico: <span class='text-green-800'>" . $this->dsc_objetivo_estrategico . "</span><br>";

            }

            $save->save();

            $table = 'futuro_almejado';
            $model = 'App\Models\\' . transformarNomeTabelaParaNomeModel($table);

            $id = [];
            $campos = [];

            $campos['cod_objetivo_estrategico'] = $save->cod_objetivo_estrategico;

            if (isset($this->dsc_futuro_almejado) && !empty($this->dsc_futuro_almejado) && is_array($this->dsc_futuro_almejado) && count($this->dsc_futuro_almejado) > 0) {

                $modificacoes = $modificacoes . "Futuro Almejado: <br>";

                foreach ($this->dsc_futuro_almejado as $futuro) {
                    $campos['dsc_futuro_almejado'] = $futuro;
                    $this->atualizarOuCriarPorModeloDados($model, $id, $campos);
                    $modificacoes = $modificacoes . "<span class='text-green-800'>" . $futuro . "</span><br>";
                }

            }

            $acao = Acoes::create(
                array(
                    'table' => 'tab_objetivo_estrategico',
                    'table_id' => $save->cod_objetivo_estrategico,
                    'user_id' => Auth::user()->id,
                    'acao' => $modificacoes
                )
            );

            $this->showModalResultadoEdicao = true;

            $this->mensagemResultadoEdicao = $modificacoes;

        } else {

            $editar = ObjetivoEstrategico::find($this->cod_objetivo_estrategico);

            $estruturaTable = $this->estruturaTableParaEditar();

            foreach ($estruturaTable as $result) {

                $column_name = $result->column_name;
                $data_type = $result->data_type;

                if ($editar->$column_name != $this->$column_name) {

                    $alteracao[$column_name] = $this->$column_name;

                    $audit = Audit::create(
                        array(
                            'table' => 'tab_objetivo_estrategico',
                            'table_id' => $this->cod_objetivo_estrategico,
                            'column_name' => $column_name,
                            'data_type' => $data_type,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_id' => Auth::user()->id,
                            'acao' => 'Editou',
                            'antes' => $editar->$column_name,
                            'depois' => $this->$column_name
                        )
                    );

                    if ($column_name != 'cod_perspectiva') {

                        $modificacoes = $modificacoes . 'Alterou o(a) <b>' . nomeCampoTabelaNormalizado($column_name) . '</b> de <span style="color:#CD3333;">( ' . $editar->$column_name . ' )</span> para <span style="color:#28a745;">( ' . $this->$column_name . ' )</span>;<br>';

                    } elseif ($column_name == 'cod_perspectiva' || $column_name == 'cod_organizacao') {

                        if ($column_name == 'cod_perspectiva') {

                            $consultarAntigo = Perspectiva::find($editar->cod_perspectiva);

                            $consultarNovo = Perspectiva::find($this->$column_name);

                            $modificacoes = $modificacoes . 'Alterou o(a) <b>Perspectiva</b> de <span style="color:#CD3333;">( ' . $consultarAntigo->num_nivel_hierarquico_apresentacao . '. ' . $consultarAntigo->dsc_perspectiva . ' )</span> para <span style="color:#28a745;">( ' . $consultarNovo->num_nivel_hierarquico_apresentacao . '. ' . $consultarNovo->dsc_perspectiva . ' )</span>;<br>';

                        }

                    }

                }

            }

            // Início do tratamento para inserir, editar ou excluir o futuro almejado por meio
            // da edição do objetivo estratégico

            $consultarFuturosAlmejados = FuturoAlmejado::where('cod_objetivo_estrategico', $this->cod_objetivo_estrategico)
                ->get();

            foreach ($consultarFuturosAlmejados as $key => $value) {
                if (!array_key_exists($value->cod_futuro_almejado, $this->dsc_futuro_almejado)) {

                    // Excluir o futuro almejado removido pelo usuário
                    $consultarFuturoALmejado = FuturoAlmejado::find($value->cod_futuro_almejado);

                    $modificacoes = $modificacoes . "Excluiu o seguinte Futuro Almejado: <span class='text-green-800'>" . $consultarFuturoALmejado->dsc_futuro_almejado . "</span>.<br>";

                    $consultarFuturoALmejado->delete();
                }
            }

            $table = 'futuro_almejado';
            $model = 'App\Models\\' . transformarNomeTabelaParaNomeModel($table);

            $id = [];
            $campos = [];

            foreach ($this->dsc_futuro_almejado as $key => $value) {

                if (Uuid::isValid($key)) {

                    $consultarFuturoALmejado = FuturoAlmejado::find($key);

                    if ($consultarFuturoALmejado->dsc_futuro_almejado != $value) {

                        if (isset($value) && !empty($value)) {
                            $id['cod_futuro_almejado'] = $key;
                            $campos['dsc_futuro_almejado'] = $value;

                            $this->atualizarOuCriarPorModeloDados($model, $id, $campos);
                            $modificacoes = $modificacoes . "Alterou o Futuro Almejado de <span class='text-red-800'>" . $consultarFuturoALmejado->dsc_futuro_almejado . "</span> para <span class='text-green-800'>" . $value . "</span><br>";
                        } else {
                            // Embora o usuário não tenha clicado em remover ele apagou o contéudo
                            // desse futuro almejado. E dessa forma será feita a exclusão.
                            $modificacoes = $modificacoes . "Apagou o conteúdo do seguinte Futuro Almejado: <span class='text-green-800'>" . $consultarFuturoALmejado->dsc_futuro_almejado . "</span>. E devido a essa ação o sistema excluirá esse item do banco de dados.<br>";

                            $consultarFuturoALmejado->delete();
                        }

                    }

                } else {

                    if (isset($value) && !empty($value)) {
                        $id = [];
                        $campos['dsc_futuro_almejado'] = $value;
                        $campos['cod_objetivo_estrategico'] = $this->cod_objetivo_estrategico;

                        $this->atualizarOuCriarPorModeloDados($model, $id, $campos);
                        $modificacoes = $modificacoes . "Inseriu o seguinte Futuro Almejado: <span class='text-green-800'>" . $value . "</span><br>";
                    }

                }
            }

            // Fim do tratamento para inserir, editar ou excluir o futuro almejado por meio
            // da edição do objetivo estratégico

            if (isset($modificacoes) && !is_null($modificacoes) && $modificacoes != '') {

                $editar->update($alteracao);

                $acao = Acoes::create(
                    array(
                        'table' => 'tab_objetivo_estrategico',
                        'table_id' => $this->cod_objetivo_estrategico,
                        'user_id' => Auth::user()->id,
                        'acao' => $modificacoes
                    )
                );

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = $modificacoes;

            } else {

                $this->showModalResultadoEdicao = true;

                $this->mensagemResultadoEdicao = 'Por não ter nenhuma modificação nada foi feito.';

            }

        }

        $this->cod_objetivo_estrategico = null;
        $this->cod_pei = null;
        $this->cod_perspectiva = null;
        $this->nom_objetivo_estrategico = null;
        $this->dsc_objetivo_estrategico = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->dsc_futuro_almejado = [];
        $this->dsc_futuro_almejado[] = '';

        $this->abrirFecharForm = 'none';
        $this->iconAbrirFechar = 'fas fa-plus text-xs';

        $this->editarForm = false;

    }

    public function editForm(ObjetivoEstrategico $singleData)
    {

        $this->cod_objetivo_estrategico = null;
        $this->cod_pei = null;
        $this->cod_perspectiva = null;

        $this->nom_objetivo_estrategico = null;
        $this->dsc_objetivo_estrategico = null;
        $this->num_nivel_hierarquico_apresentacao = null;

        $this->cod_objetivo_estrategico = $singleData->cod_objetivo_estrategico;
        $this->cod_perspectiva = $singleData->cod_perspectiva;
        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;
        $this->nom_objetivo_estrategico = $singleData->nom_objetivo_estrategico;
        $this->dsc_objetivo_estrategico = $singleData->dsc_objetivo_estrategico;

        $consultarPerspectiva = Perspectiva::find($singleData->cod_perspectiva);

        foreach ($singleData->fututoAlmejadoParaEdicao as $value) {
            $this->dsc_futuro_almejado[$value->cod_futuro_almejado] = $value->dsc_futuro_almejado;
        }

        $this->cod_pei = $consultarPerspectiva->cod_pei;

        $this->abrirFecharForm = 'block';
        $this->iconAbrirFechar = 'fas fa-minus text-xs';

        $this->editarForm = true;

    }

    public function deleteForm(ObjetivoEstrategico $singleData)
    {

        $this->cod_objetivo_estrategico = $singleData->cod_objetivo_estrategico;

        $consultarPerspectiva = Perspectiva::find($singleData->cod_perspectiva);

        $texto = '';

        $texto .= '<p class="my-2 text-gray-500 text-lg leading-relaxed">Objetivo Estrategico: <strong>' . $singleData->num_nivel_hierarquico_apresentacao . '. ' . $singleData->nom_objetivo_estrategico . '</strong></p><p class="my-2 text-gray-500 text-lg leading-relaxed">Descrição do Objetivo Estrategico: <strong>' . $singleData->dsc_objetivo_estrategico . '</strong></p><p class="my-2 text-gray-500 text-lg leading-relaxed">Perspectiva: <strong>' . $consultarPerspectiva->num_nivel_hierarquico_apresentacao . '. ' . $consultarPerspectiva->dsc_perspectiva . '</strong></p><p class="my-2 text-gray-500 text-lg font-semibold leading-relaxed text-red-600">Quer realmente excluir?</p>';

        $this->mensagemDelete = $texto;

        $this->showModalDelete = true;

        $this->nom_objetivo_estrategico = null;
        $this->dsc_objetivo_estrategico = null;
        $this->cod_perspectiva = null;

        $this->editarForm = false;

    }

    public function delete(ObjetivoEstrategico $singleData)
    {

        $this->showModalDelete = false;

        $consultarPerspectiva = Perspectiva::find($singleData->cod_perspectiva);

        $modificacoes = '';

        $this->nom_objetivo_estrategico = $singleData->nom_objetivo_estrategico;
        $this->dsc_objetivo_estrategico = $singleData->dsc_objetivo_estrategico;
        $this->cod_perspectiva = $singleData->cod_perspectiva;
        $this->num_nivel_hierarquico_apresentacao = $singleData->num_nivel_hierarquico_apresentacao;
        $this->cod_objetivo_estrategico = $singleData->cod_objetivo_estrategico;

        $modificacoes = $modificacoes . '<p class="my-2 text-gray-500 text-lg leading-relaxed">O Objetivo Estrategico <strong>' . $singleData->num_nivel_hierarquico_apresentacao . '. ' . $singleData->nom_objetivo_estrategico . '</strong> vinculado a Perspectiva <strong>' . $consultarPerspectiva->num_nivel_hierarquico_apresentacao . '. ' . $consultarPerspectiva->dsc_perspectiva . '</strong> foi excluído com sucesso.</p>';

        $acao = Acoes::create(
            array(
                'table' => 'tab_objetivo_estrategico',
                'table_id' => $singleData->cod_objetivo_estrategico,
                'user_id' => Auth::user()->id,
                'acao' => $modificacoes
            )
        );

        $singleData->delete();

        $this->cod_pei = null;
        $this->cod_perspectiva = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->nom_objetivo_estrategico = null;
        $this->dsc_objetivo_estrategico = null;

        $this->editarForm = false;

        $this->showModalResultadoEdicao = true;

        $this->mensagemResultadoEdicao = $modificacoes;

    }

    public function cancelar()
    {

        $this->cod_pei = null;
        $this->cod_perspectiva = null;
        $this->cod_objetivo_estrategico = null;
        $this->num_nivel_hierarquico_apresentacao = null;
        $this->nom_objetivo_estrategico = null;
        $this->dsc_objetivo_estrategico = null;

        $this->dsc_futuro_almejado = [];

        $this->editarForm = false;

    }

    public function render()
    {

        $this->estruturaTable = $this->estruturaTable();

        $this->pei = Pei::select(db::raw("dsc_pei||' ( '||num_ano_inicio_pei||' a '||num_ano_fim_pei||' )' as dsc_pei, cod_pei"))
            ->where('dsc_pei', '!=', '')
            ->whereNotNull('dsc_pei')
            ->orderBy('dsc_pei')
            ->pluck('dsc_pei', 'cod_pei');

        if ($this->editarForm == false) {

            $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

            if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

                $perspectiva = $perspectiva->where('cod_pei', $this->cod_pei);

            } else {

                $perspectiva = $perspectiva->whereNull('cod_pei');

            }

            $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
                ->pluck('dsc_perspectiva', 'cod_perspectiva');

            $this->perspectiva = $perspectiva;

            if (isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '' && $this->editarForm == false) {

                $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

            }

            if (isset($this->cod_perspectiva) && !is_null($this->cod_perspectiva) && $this->cod_perspectiva != '') {

                $this->num_nivel_hierarquico_apresentacao = $this->pesquisarCodigo($this->cod_perspectiva);

            }

        } else {

            $perspectiva = Perspectiva::select(db::raw("num_nivel_hierarquico_apresentacao||'. '||dsc_perspectiva as dsc_perspectiva, cod_perspectiva"));

            if (isset($this->cod_pei) && !is_null($this->cod_pei) && $this->cod_pei != '') {

                $perspectiva = $perspectiva->where('cod_pei', $this->cod_pei);

            }

            $perspectiva = $perspectiva->orderBy('num_nivel_hierarquico_apresentacao', 'desc')
                ->pluck('dsc_perspectiva', 'cod_perspectiva');

            $this->perspectiva = $perspectiva;

            $this->num_nivel_hierarquico_apresentacao = $this->num_nivel_hierarquico_apresentacao;

        }

        $this->niveis_hierarquico_apresentacao = NumNivelHierarquico::pluck('num_nivel_hierarquico_apresentacao', 'num_nivel_hierarquico_apresentacao');

        $objetivoEstragico = ObjetivoEstrategico::orderBy('num_nivel_hierarquico_apresentacao', 'desc')
            ->with('perspectiva')
            ->get();

        $this->objetivoEstragico = $objetivoEstragico;

        return view('livewire.objetivo-estrategico-livewire');
    }

    protected function estruturaTable()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_objetivo_estrategico'
            AND column_name NOT IN ('cod_objetivo_estrategico','cod_perspectiva','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function estruturaTableParaEditar()
    {

        $estrutura = DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'pei'
            AND table_name = 'tab_objetivo_estrategico'
            AND column_name NOT IN ('cod_objetivo_estrategico','created_at','updated_at','deleted_at');");

        return $estrutura;

    }

    protected function atualizarOuCriarPorModeloDados($model = null, $id = [], $campos = [])
    {

        $camposSemArray = true;

        foreach ($campos as $key => $value) {
            if (is_array($value)) {
                $camposSemArray = false;
            }
        }

        try {

            if ($camposSemArray) {

                $registro = null;

                if (isset($id) && !is_null($id) && $id != '' && is_array($id) && count($id) > 0) {

                    if (count($id) == 1) {

                        $nomeId = null;
                        $contId = 1;

                        foreach ($id as $key => $value) {

                            if ($contId == 1) {
                                $nomeId = $key;
                            }

                            $contId++;

                        }

                        $consulta = null;

                        if (array_key_exists($nomeId, $id)) {

                            $consulta = $model::find($id[$nomeId]);

                        }

                        // Use o método `getTable` para obter o nome da tabela
                        $tableName = (new $model())->getTable();

                        // Consulta SQL para obter o nome do schema
                        $query = "SELECT table_schema FROM information_schema.tables WHERE table_name =?";

                        // Execute a consulta SQL
                        $results = DB::select($query, [$tableName]);

                        // Verifique se há resultados e obtenha o nome do schema
                        if (!empty($results)) {
                            $schemaName = $results[0]->table_schema;
                        } else {
                            $schemaName = 'Nenhum schema encontrado'; // Trate o caso em que nenhum schema foi encontrado
                        }

                        // Início gravar auditoria
                        if ($consulta !== null) {

                            foreach ($campos as $key => $value) {

                                $dadoBase = null;

                                $dadoBase = $consulta->$key;

                                $column_name = null;
                                $data_type = null;

                                if ($schemaName != 'Nenhum schema encontrado') {

                                    $estruturaColumn = $this->getColumnTable($schemaName, $tableName, $key);

                                    $column_name = $estruturaColumn->column_name;
                                    $data_type = $estruturaColumn->data_type;
                                }

                                if ($data_type != 'timestamp with time zone' && $value != $dadoBase) {

                                    $dataHoraAtual = now();

                                    // Adiciona 8 horas
                                    $dataHoraAtual->addHours(8);

                                    $gravarAuditoria = new TabAudit;

                                    $gravarAuditoria->acao = 'Atualização';
                                    $gravarAuditoria->antes = $dadoBase;
                                    $gravarAuditoria->depois = $value;
                                    $gravarAuditoria->table = $tableName;
                                    $gravarAuditoria->column_name = $key;
                                    $gravarAuditoria->data_type = $data_type;
                                    $gravarAuditoria->user_id = Auth::user()->id;

                                    if (is_array($id[$nomeId]) && count($id[$nomeId]) > 0) {
                                        $gravarAuditoria->table_id = $id[$nomeId][0];
                                    } else {
                                        $gravarAuditoria->table_id = $id[$nomeId];
                                    }

                                    $gravarAuditoria->ip = $_SERVER['REMOTE_ADDR'];
                                    $gravarAuditoria->dte_expired_at = $dataHoraAtual->format('Y-m-d H:i:s');

                                    $gravarAuditoria->save();
                                }
                            }

                        }
                        // Fim gravar auditoria

                    }

                    $model::updateOrCreate($id, $campos);

                    return true;
                } else {
                    $model::updateOrCreate($campos);

                    return true;
                }

            }

        } catch (Illuminate\Database\QueryException $e) {
            // TabLogErros::create(array('mensagem' => 'Erro ao gravar dados: ' . $e->getMessage()));
        }
    }
}

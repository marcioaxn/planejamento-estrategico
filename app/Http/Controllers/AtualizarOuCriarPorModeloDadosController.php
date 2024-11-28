<?php

namespace App\Http\Controllers;

use App\Models\TabLogErros;
use App\Models\TabAudit;
use Auth;
use Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Http\Controllers\TabAuditController;

class AtualizarOuCriarPorModeloDadosController extends Controller
{

    public function instanciarTabAuditController()
    {
        return new TabAuditController;
    }

    public function atualizarOuCriarPorModeloDados($model = null, $id = [], $campos = [])
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

    protected function getColumnTable($schema = null, $table = null, $columnName = null)
    {

        return DB::selectOne("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = '" . $schema . "'
            AND table_name = '" . $table . "'
            AND column_name = '" . $columnName . "';");
    }

    public function getEstruturaTable()
    {

        return DB::select("SELECT
            column_name,ordinal_position,is_nullable,data_type
            FROM
            information_schema.columns
            WHERE
            table_schema = 'midr_gestao'
            AND table_name = 'tab_atendimentos'
            AND column_name NOT IN ('cod_parlamentar','created_at','updated_at','deleted_at');");
    }

}

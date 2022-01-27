<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanoAcao extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_plano_de_acao';

    protected $primaryKey = 'cod_plano_de_acao';

    public $timestamps = true;

    protected $guarded = array();

    public function objetivoEstrategico() {

        return $this->belongsTo(ObjetivoEstrategico::class, 'cod_objetivo_estrategico');

    }

    public function tipoExecucao() {
        return $this->belongsTo(TipoExecucao::class,'cod_tipo_execucao');
    }

    public function unidade() {

        return $this->belongsTo(Organization::class, 'cod_organizacao');

    }

    public function servidorResponsavel()
    {
        return $this->belongsToMany(User::class, 'rel_users_tab_organizacoes_tab_perfil_acesso', 'cod_plano_de_acao', 'user_id')
        ->select('name','users.id')
        ->where('cod_perfil','c00b9ebc-7014-4d37-97dc-7875e55fff4c')
        ->whereNull('rel_users_tab_organizacoes_tab_perfil_acesso.deleted_at');
    }

    public function servidorSubstituto()
    {
        return $this->belongsToMany(User::class, 'rel_users_tab_organizacoes_tab_perfil_acesso', 'cod_plano_de_acao', 'user_id')
        ->select('name','users.id')
        ->where('cod_perfil','c00b9ebc-7014-4d37-97dc-7875e55fff5d')
        ->whereNull('rel_users_tab_organizacoes_tab_perfil_acesso.deleted_at');
    }

    public function indicadores() {

        return $this->hasMany(Indicador::class, 'cod_plano_de_acao');

    }

    public function acoesRealizadas() {

        return $this->hasMany(Acoes::class, 'table_id')
        ->whereIn('table',['tab_plano_de_acao'])
        ->orderBy('created_at','desc');

    }
    
}

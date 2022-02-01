<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;

class ObjetivoEstrategico extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_objetivo_estrategico';

    protected $primaryKey = 'cod_objetivo_estrategico';

    public $timestamps = true;

    protected $guarded = array();

    public function perspectiva() {

        return $this->belongsTo(Perspectiva::class, 'cod_perspectiva');

    }

    public function planosDeAcao() {

        if(Session::has('cod_plano_de_acao')) {

            $cod_plano_de_acao = Session::get('cod_plano_de_acao');

            return $this->hasMany(PlanoAcao::class, 'cod_objetivo_estrategico')
            ->with('tipoExecucao')
            ->where('cod_plano_de_acao','=',$cod_plano_de_acao);

        } else {

            return $this->hasMany(PlanoAcao::class, 'cod_objetivo_estrategico');

        }

    }

    public function planosDeAcaoPorArea() {

        if(Session::has('cod_organizacao')) {

            $cod_organizacao = Session::get('cod_organizacao');

            return $this->hasMany(PlanoAcao::class, 'cod_objetivo_estrategico')
            ->with('tipoExecucao')
            ->whereIn('cod_organizacao',$cod_organizacao);

        } else {

            return $this->hasMany(PlanoAcao::class, 'cod_objetivo_estrategico');

        }

    }
    
}

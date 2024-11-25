<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IndicadorObjetivoEstrategico extends Model implements Auditable
{
    use Uuids, \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_indicador';

    protected $primaryKey = 'cod_indicador';

    public $timestamps = true;

    protected $guarded = array();

    public function linhaBase()
    {

        return $this->hasMany(LinhaBase::class, 'cod_indicador');

    }

    public function metaAno()
    {

        return $this->hasMany(MetaAno::class, 'cod_indicador');

    }

    public function evolucaoIndicador()
    {

        return $this->hasMany(EvolucaoIndicador::class, 'cod_indicador')
            ->orderBy('num_ano')
            ->orderBy('num_mes');

    }

    public function acoesRealizadas()
    {

        return $this->hasMany(Acoes::class, 'table_id')
            ->whereIn('table', ['tab_indicador'])
            ->orderBy('created_at', 'desc');

    }

}

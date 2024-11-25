<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Organization extends Model implements Auditable
{
    use Uuids, \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'tab_organizacoes';

    protected $primaryKey = 'cod_organizacao';

    public $timestamps = true;

    protected $guarded = array();

    public function hierarquia()
    {
        // return $this->belongsTo(RelOrganization::class,'cod_organizacao','rel_cod_organizacao');

        return $this->belongsToMany(Organization::class, 'rel_organizacao', 'cod_organizacao', 'rel_cod_organizacao');
    }

    public function deshierarquia()
    {
        return $this->belongsToMany(Organization::class, 'rel_organizacao', 'rel_cod_organizacao', 'cod_organizacao');
    }

    public function indicadores()
    {
        return $this->belongsToMany(IndicadorObjetivoEstrategico::class, 'pei.rel_indicador_objetivo_estrategico_organizacao', 'cod_organizacao', 'cod_indicador');
    }
}

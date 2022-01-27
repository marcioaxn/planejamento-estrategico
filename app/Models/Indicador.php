<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicador extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_indicador';

    protected $primaryKey = 'cod_indicador';

    public $timestamps = true;

    protected $guarded = array();

    public function linhaBase() {

        return $this->hasMany(LinhaBase::class, 'cod_indicador');

    }

    public function metaAno() {

        return $this->hasMany(MetaAno::class, 'cod_indicador');

    }

    public function evolucaoIndicador() {

        return $this->hasMany(EvolucaoIndicador::class, 'cod_indicador');

    }

    public function acoesRealizadas() {

        return $this->hasMany(Acoes::class, 'table_id')
        ->whereIn('table',['tab_indicador'])
        ->orderBy('created_at','desc');

    }
    
}

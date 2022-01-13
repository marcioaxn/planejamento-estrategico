<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvolucaoIndicador extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $table = 'pei.tab_evolucao_indicador';

    protected $primaryKey = 'cod_evolucao_indicador';

    public $timestamps = true;

    protected $guarded = array();

    public function acoesRealizadas() {

        return $this->hasMany(Acoes::class, 'id_table')
        ->whereIn('table',['tab_evolucao_indicador'])
        ->orderBy('created_at','desc');

    }
    
}

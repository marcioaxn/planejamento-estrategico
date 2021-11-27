<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perspectiva extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $table = 'pei.tab_perspectiva';

    protected $primaryKey = 'cod_perspectiva';

    public $timestamps = true;

    protected $guarded = array();

    public function planejamentoEstrategicoIntegrado() {

        return $this->belongsTo(Pei::class, 'cod_pei');

    }

    public function objetivosEstrategicos() {
        return $this->hasMany(ObjetivoEstrategico::class,'cod_perspectiva')
        ->orderBy('num_nivel_hierarquico_apresentacao');
    }
    
}

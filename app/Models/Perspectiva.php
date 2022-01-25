<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;

class Perspectiva extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_perspectiva';

    protected $primaryKey = 'cod_perspectiva';

    public $timestamps = true;

    protected $guarded = array();

    public function objetivosEstrategicos() {

        if(Session::has('cod_objetivo_estrategico')) {

            $cod_objetivo_estrategico = Session::get('cod_objetivo_estrategico');

            return $this->hasMany(ObjetivoEstrategico::class,'cod_perspectiva')
            ->where('cod_objetivo_estrategico','=',$cod_objetivo_estrategico)
            ->orderBy('num_nivel_hierarquico_apresentacao');

        } else {

            return $this->hasMany(ObjetivoEstrategico::class,'cod_perspectiva')
            ->orderBy('num_nivel_hierarquico_apresentacao');

        }

    }
    
}

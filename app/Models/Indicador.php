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
    
    protected $table = 'pei.tab_indicador';

    protected $primaryKey = 'cod_indicador';

    public $timestamps = true;

    protected $guarded = array();

    public function acoesRealizadas() {

        return $this->hasMany(Acoes::class, 'id_table')
        ->whereIn('table',['tab_indicador'])
        ->orderBy('created_at','desc');

    }
    
}

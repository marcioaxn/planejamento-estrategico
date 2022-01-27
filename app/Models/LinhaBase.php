<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinhaBase extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_linha_base_indicador';

    protected $primaryKey = 'cod_linha_base';

    public $timestamps = true;

    protected $guarded = array();

    public function acoesRealizadas() {

        return $this->hasMany(Acoes::class, 'table_id')
        ->whereIn('table',['tab_linha_base_indicador'])
        ->orderBy('created_at','desc');

    }
    
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaAno extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_meta_por_ano';

    protected $primaryKey = 'cod_meta_por_ano';

    public $timestamps = true;

    protected $guarded = array();

    public function acoesRealizadas() {

        return $this->hasMany(Acoes::class, 'table_id')
        ->whereIn('table',['tab_meta_por_ano'])
        ->orderBy('created_at','desc');

    }
    
}

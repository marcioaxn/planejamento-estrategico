<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrauSatisfacao extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_grau_satisfcao';

    protected $primaryKey = 'cod_grau_satisfcao';

    public $timestamps = true;

    protected $guarded = array();

    public function acoesRealizadas() {

        return $this->hasMany(Acoes::class, 'table_id')
        ->whereIn('table',['tab_grau_satisfcao'])
        ->orderBy('created_at','desc');

    }
    
}

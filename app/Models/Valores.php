<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valores extends Model
{
    use Uuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_valores';

    protected $primaryKey = 'cod_valor';

    public $timestamps = true;

    protected $guarded = array();

    public function planejamentoEstrategicoIntegrado()
    {

        return $this->belongsTo(Pei::class, 'cod_pei');

    }

    public function unidade()
    {

        return $this->belongsTo(Organization::class, 'cod_organizacao');

    }

}

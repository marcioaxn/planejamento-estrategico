<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class MissaoVisao extends Model implements Auditable
{
    use Uuids, \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_missao_visao_valores';

    protected $primaryKey = 'cod_missao_visao_valores';

    public $timestamps = true;

    protected $guarded = array();

    public function planejamentoEstrategicoIntegrado() {

        return $this->belongsTo(Pei::class, 'cod_pei');

    }

    public function unidade() {

        return $this->belongsTo(Organization::class, 'cod_organizacao');

    }

}

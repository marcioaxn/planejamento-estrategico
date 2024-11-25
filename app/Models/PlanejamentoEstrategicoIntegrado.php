<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PlanejamentoEstrategicoIntegrado extends Model implements Auditable
{
    use Uuids, \OwenIt\Auditing\Auditable, SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'tab_pei';

    protected $primaryKey = 'cod_pei';

    public $timestamps = true;

    protected $guarded = array();
    
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanejamentoEstrategicoIntegrado extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $table = 'tab_pei';

    protected $primaryKey = 'cod_pei';

    public $timestamps = true;

    protected $guarded = array();
    
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoExecucao extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_tipo_execucao';

    protected $primaryKey = 'cod_tipo_execucao';

    public $timestamps = true;

    protected $guarded = array();
    
}

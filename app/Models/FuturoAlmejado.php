<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuturoAlmejado extends Model
{
    use Uuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_futuro_almejado_objetivo_estrategico';

    protected $primaryKey = 'cod_futuro_almejado';

    public $timestamps = true;

    protected $guarded = array();

}

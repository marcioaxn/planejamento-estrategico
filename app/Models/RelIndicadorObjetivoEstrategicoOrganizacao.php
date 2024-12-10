<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RelIndicadorObjetivoEstrategicoOrganizacao extends Model
{
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.rel_indicador_objetivo_estrategico_organizacao';

    protected $primaryKey = false;

    public $timestamps = true;

    protected $guarded = array();
}

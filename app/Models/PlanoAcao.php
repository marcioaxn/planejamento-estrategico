<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanoAcao extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $table = 'pei.tab_plano_de_acao';

    protected $primaryKey = 'cod_plano_de_acao';

    public $timestamps = true;

    protected $guarded = array();
    
}

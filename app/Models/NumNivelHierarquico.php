<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class NumNivelHierarquico extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;
    
    protected $table = 'pei.tab_nivel_hierarquico';

    protected $primaryKey = 'num_nivel_hierarquico_apresentacao';

    public $timestamps = true;

    protected $guarded = array();
    
}

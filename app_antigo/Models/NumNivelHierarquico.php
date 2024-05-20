<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumNivelHierarquico extends Model
{
    use SoftDeletes;
    
    protected $table = 'pei.tab_nivel_hierarquico';

    protected $primaryKey = 'num_nivel_hierarquico_apresentacao';

    public $timestamps = true;

    protected $guarded = array();
    
}

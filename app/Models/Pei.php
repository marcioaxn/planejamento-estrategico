<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use OwenIt\Auditing\Contracts\Auditable;

class Pei extends Model implements Auditable
{
    use Uuids, \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.tab_pei';

    protected $primaryKey = 'cod_pei';

    public $timestamps = true;

    protected $guarded = array();

    public function perspectivas() {

        if(Session::has('cod_perspectiva')) {

            $cod_perspectiva = Session::get('cod_perspectiva');

            return $this->hasMany(Perspectiva::class, 'cod_pei')
            ->where('cod_perspectiva','=',$cod_perspectiva);

        } else {

            return $this->hasMany(Perspectiva::class, 'cod_pei')
            ->orderBy('num_nivel_hierarquico_apresentacao','desc');

        }

    }
    
}

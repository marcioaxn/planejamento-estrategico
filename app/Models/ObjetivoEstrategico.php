<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObjetivoEstrategico extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $table = 'pei.tab_objetivo_estrategico';

    protected $primaryKey = 'cod_objetivo_estrategico';

    public $timestamps = true;

    protected $guarded = array();

    public function perspectiva() {

        return $this->belongsTo(Perspectiva::class, 'cod_perspectiva');

    }
    
}

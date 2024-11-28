<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TabEntregas extends Model implements Auditable
{
    use Uuids, \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'tab_entregas';

    protected $primaryKey = 'cod_entrega';

    public $timestamps = true;

    protected $guarded = array();

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'cod_entrega');
    }

    public function acoesRealizadas()
    {

        return $this->hasMany(Acoes::class, 'table_id')
            ->whereIn('table', ['tab_entregas'])
            ->orderBy('created_at', 'desc');

    }

    public function planoAcao()
    {
        return $this->belongsTo(PlanoAcao::class, 'cod_plano_de_acao');
    }
}

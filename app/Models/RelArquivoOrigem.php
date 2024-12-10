<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RelArquivoOrigem extends Model implements Auditable
{
    use Uuids, \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'pei.rel_arquivos_origem';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = array();
}

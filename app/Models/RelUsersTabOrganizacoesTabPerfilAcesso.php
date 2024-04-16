<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelUsersTabOrganizacoesTabPerfilAcesso extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'rel_users_tab_organizacoes_tab_perfil_acesso';

    protected $primaryKey = 'id';
    
    public $timestamps = true;

    protected $guarded = array();
}

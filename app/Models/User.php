<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use Uuids;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use \OwenIt\Auditing\Auditable;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'ativo',
        'trocarsenha',
        'adm'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function atuacaoOrganizacao()
    {
        return $this->belongsToMany(Organization::class, 'rel_users_tab_organizacoes', 'user_id', 'cod_organizacao')
            ->wherePivotNull('deleted_at');
    }

    public function organizacao()
    {
        return $this->belongsToMany(Organization::class, 'rel_users_tab_organizacoes_tab_perfil_acesso', 'user_id', 'cod_organizacao')
            ->wherePivotNull('deleted_at');
    }

    public function servidorResponsavel()
    {
        return $this->belongsToMany(PlanoAcao::class, 'rel_users_tab_organizacoes_tab_perfil_acesso', 'user_id', 'cod_plano_de_acao')
            ->where('cod_perfil', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c')
            ->whereYear('dte_fim', '<=', \Session('ano'))
            ->whereNull('rel_users_tab_organizacoes_tab_perfil_acesso.deleted_at');
    }

    public function servidorSubstituto()
    {
        return $this->belongsToMany(PlanoAcao::class, 'rel_users_tab_organizacoes_tab_perfil_acesso', 'user_id', 'cod_plano_de_acao')
            ->where('cod_perfil', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d')
            ->whereYear('dte_fim', '<=', \Session('ano'))
            ->whereNull('rel_users_tab_organizacoes_tab_perfil_acesso.deleted_at');
    }
}

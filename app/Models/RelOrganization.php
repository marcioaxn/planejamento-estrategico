<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class RelOrganization extends Model
{
    use Uuids, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'rel_organizacao';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = array();
}

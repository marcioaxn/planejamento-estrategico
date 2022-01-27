<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelOrganization extends Model
{
    use Uuids;
    use SoftDeletes;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'rel_organizacao';

    protected $primaryKey = 'id';
    public $incrementing = false;

    public $timestamps = true;

    protected $guarded = array();
}

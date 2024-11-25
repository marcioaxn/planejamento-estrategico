<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class TabStatus extends Model
{
    use Uuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'tab_status';

    protected $primaryKey = 'cod_status';

    public $timestamps = true;

    protected $guarded = array();
    
}

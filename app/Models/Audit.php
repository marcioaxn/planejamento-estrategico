<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Auth\Authenticatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audit extends Model
{
    use Uuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'tab_audit';
    protected $dates = array('deleted_at');
    protected $guarded = array();
    
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

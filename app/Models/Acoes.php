<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Auth\Authenticatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acoes extends Model
{
    use Uuids;
    use SoftDeletes;

    protected $table = 'public.acoes';
    protected $dates = array('deleted_at');
    protected $guarded = array();
    
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

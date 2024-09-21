<?php

namespace App\Traits;
use Ramsey\Uuid\Uuid;

trait Uuid
{
    public static function bootUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4();
        });
    }
}

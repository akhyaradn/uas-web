<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait KeyUUID
{
    
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->primaryKey = 'uuid';
            $model->keyType = 'string';
            $model->incrementing = false;
            $model->uuid = Str::uuid();

            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: tapos
 * Date: 8/10/2018
 * Time: 2:38 PM
 */

namespace App\Traits;


use Webpatser\Uuid\Uuid;

trait Uuids
{


    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}
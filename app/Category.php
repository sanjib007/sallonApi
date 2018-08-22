<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use Uuids;
    public $transformer = CategoryTransformer::class;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'description',
    ];
}

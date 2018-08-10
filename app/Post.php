<?php

namespace App;


use App\Traits\Uuids;
use App\Transformers\PostTransformer;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Post extends Model
{
    use Uuids;
    public $transformer = PostTransformer::class;
    public $incrementing = false;
    protected $fillable = [
        "title",
        "description"
    ];

}

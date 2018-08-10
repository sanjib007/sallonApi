<?php

namespace App;

use App\Http\Resources\PostResource;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Post extends Model
{
    use Uuids;
    public $transformer = PostResource::class;
    public $incrementing = false;
    protected $fillable = [
        "title",
        "description"
    ];

}

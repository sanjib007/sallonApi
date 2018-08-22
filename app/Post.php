<?php

namespace App;


use App\Category;
use App\Traits\Uuids;
use App\Transformers\PostTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;
    use Uuids;
    public $transformer = PostTransformer::class;
    public $incrementing = false;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'cover_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

}

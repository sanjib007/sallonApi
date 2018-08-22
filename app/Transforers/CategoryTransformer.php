<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(Category $category)
    {

        $data  = $category->toArray();
        $information =  [
            'id' => (string) $category->id,
            'name' => (string) $category->name,
            'description' => (string) $category->description
        ];

        return $information;
    }
    public static function  originalAttribute($index){
        $attributes = [
            'id' =>  'id',
            'name' =>  'name',
            'description' =>  'description',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }


}

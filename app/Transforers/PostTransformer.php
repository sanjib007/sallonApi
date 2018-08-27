<?php

namespace App\Transformers;

use App\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(Post $post)
    {

        $data  = $post->toArray();
        $information =  [
            //
            'id' => (string) $post->id,
            'title' => (string) $post->title,
            'details' => (string) $post->description
        ];
        if(isset($data['user'])){
            $userTransformer = new UserTransformer();
            $information['user'] = $userTransformer->transform($post->user);
        }

        // foreach($data as $key=> $aData){
        //     if(is_array($data[$key]) ){
        //         $transformer = $post->$key->first()->transformer;
               
        //         $value = new $transformer();
                
        //         $information[$key] = $value->transform($post->$key->first());
        //     }
        // }
        return $information;
    }
    public static function  originalAttribute($index){
        $attributes = [
            'id' =>  'id',
            'title' =>  'title',
            'details' =>  'description',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }


}

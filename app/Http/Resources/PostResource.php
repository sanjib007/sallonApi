<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'headline' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public static function  originalAttribute($index){
        $attributes = [
            'id' =>  'id',
            'headline' =>  'title',
            'description' =>  'description',
            'created_at' =>  'created_at',
            'updated_at' => 'updated_at'
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}

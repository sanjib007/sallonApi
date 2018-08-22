<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */

    public function transform(User $user)
    {

        $data  = $user->toArray();
        $information =  [
            //
            'id' => (string) $user->id,
            'name'=> (string) $user->name,
            'email'=> (string) $user->email,
            'password'=> (string) $user->password,
            'verified'=> (bool) $user->verified,
            'verification_token'=> (string) $user->verification_token,
            'admin'=> (bool) $user->admin=="true"?true:false,
            'phone_no'=> (string) $user->phone_no,
            'image_thumb'=> (string) $user->image_thumb
        ];

        return $information;
    }
    public static function  originalAttribute($index){
        $attributes = [
            'id'                    => 'id',
            'name'                  => 'name',
            'email'                 => 'email',
            'password'              => 'password',
            'verified'              => 'verified',
            'verification_token'    => 'verification_token',
            'admin'                 => 'admin',
            'phone_no'              => 'phone_no',
            'image_thumb'           => 'image_thumb',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }


}

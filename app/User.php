<?php

namespace App;

use App\Traits\Uuids;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable, SoftDeletes;
    use Uuids;
    public $transformer = UserTransformer::class;

    const VERIFIED_USER = 1;
    CONST UNVERIFIED_USER = 0;
    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
        'phone_no',
        'image_thumb'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    public function findForPassport($identifier) {
        return User::orWhere('email', $identifier)->orWhere('phone_no', $identifier)->where('verified',$this::VERIFIED_USER)->first();
    }

    public function isVerified()
    {
        return $this->verified == USER::VERIFIED_USER;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }
    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }
}

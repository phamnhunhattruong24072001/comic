<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin.
 *
 * @package namespace App\Models;
 */
class Admin extends Authenticatable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'day_of_birth',
        'address',
        'avatar',
        'email_verified_at',
        'is_visible',
    ];

    protected $hidden = [
        'password'
    ];
    protected $table = 'admins';


}

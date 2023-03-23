<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const VIEW = 'user_list';
    const CREATE = 'user_create';
    const UPDATE = 'user_update';
    const DELETE = 'user_delete';
    const RESTORE = 'user_restore';
    const FORCE_DELETE = 'user_force_delete';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'day_of_birth',
        'gender',
        'address',
        'avatar',
        'role',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions', 'user_id', 'permission_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Client.
 *
 * @package namespace App\Models;
 */
class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'username',
        'email',
        'birthday',
        'gender',
        'avatar',
        'password',
        'is_visible'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function favorites()
    {
        return $this->belongsToMany(Comic::class, 'comic_favorites', 'client_id', 'comic_id');
    }

    public function follows()
    {
        return $this->belongsToMany(Comic::class, 'comic_follows', 'client_id', 'comic_id');
    }

}

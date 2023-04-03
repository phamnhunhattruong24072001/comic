<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Genre.
 *
 * @package namespace App\Models;
 */
class Genre extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const VIEW = 'genre_list';
    const CREATE = 'genre_create';
    const UPDATE = 'genre_update';
    const DELETE = 'genre_delete';
    const RESTORE = 'genre_restore';
    const FORCE_DELETE = 'genre_force_delete';

    protected $table = 'genres';
    protected $fillable = [
        'name',
        'slug',
        'name_another',
        'tags',
        'short_desc',
        'long_desc',
        'highlight',
        'view_search',
        'is_visible',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_genres', 'genre_id', 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_visible', config('const.activate.on'));
    }
}

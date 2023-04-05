<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comic.
 *
 * @package namespace App\Models;
 */
class Comic extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const VIEW = 'comic_list';
    const CREATE = 'comic_create';
    const UPDATE = 'comic_update';
    const DELETE = 'comic_delete';
    const RESTORE = 'comic_restore';
    const FORCE_DELETE = 'comic_force_delete';

    protected $table = 'comics';
    protected $fillable = [
        'country_id',
        'category_id',
        'name',
        'name_another',
        'slug',
        'tags',
        'author_name',
        'view',
        'thumbnail',
        'cover_image',
        'many_pictures',
        'highlight',
        'view_search',
        'short_desc',
        'long_desc',
        'status',
        'release_time',
        'the_origin',
        'is_visible',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_comics', 'comic_id', 'genre_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function scopeActive($query)
    {
        $query->where('is_visible', config('const.activate.on'));
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Category.
 *
 * @package namespace App\Models;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const VIEW = 'category_list';
    const CREATE = 'category_create';
    const UPDATE = 'category_update';
    const DELETE = 'category_delete';
    const RESTORE = 'category_restore';
    const FORCE_DELETE = 'category_force_delete';

    const IMAGE = 'image';
    const TEXT = 'text';

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'tags',
        'short_desc',
        'long_desc',
        'is_visible',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_categories', 'category_id', 'country_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'category_genres', 'category_id', 'genre_id');
    }

    public function comics()
    {
        return $this->hasMany(Comic::class, 'category_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_visible', config('const.activate.on'));
    }
}

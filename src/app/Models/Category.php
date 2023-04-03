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

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'tags',
        'short_desc',
        'long_desc',
        'is_visible',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_categories', 'category_id', 'country_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_visible', config('const.activate.on'));
    }
}

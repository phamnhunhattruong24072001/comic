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
        'parent_id',
        'short_desc',
        'long_desc',
        'is_visible',
    ];

    public function parent()
    {
        return $this->hasOne(Category::class, 'parent_id');
    }

    public function childCategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}

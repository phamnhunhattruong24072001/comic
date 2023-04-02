<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Country.
 *
 * @package namespace App\Models;
 */
class Country extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const VIEW = 'country_list';
    const CREATE = 'country_create';
    const UPDATE = 'country_update';
    const DELETE = 'country_delete';
    const RESTORE = 'country_restore';
    const FORCE_DELETE = 'country_force_delete';

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'another_name',
        'short_desc',
        'avatar',
        'tags',
        'slug',
        'is_visible',
    ];

    function scopeActive($query)
    {
        return $query->where('is_visible', config('const.activate.on'));
    }
}

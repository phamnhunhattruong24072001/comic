<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Figure.
 *
 * @package namespace App\Models;
 */
class Figure extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const VIEW = 'figure_list';
    const CREATE = 'figure_create';
    const UPDATE = 'figure_update';
    const DELETE = 'figure_delete';
    const RESTORE = 'figure_restore';
    const FORCE_DELETE = 'figure_force_delete';

    protected $fillable = [
        'comic_id',
        'name',
        'nickname',
        'age',
        'birthday',
        'gender',
        'nationality',
        'height',
        'avatar',
        'character_role',
        'career',
        'short_desc',
        'long_desc',
        'chapter_appeared',
        'chapter_end',
        'relationship',
        'is_visible',
    ];

    public function comic()
    {
        return $this->hasOne(Comic::class, 'id', 'comic_id');
    }
}

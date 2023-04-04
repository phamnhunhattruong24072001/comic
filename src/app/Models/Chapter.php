<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Chapter.
 *
 * @package namespace App\Models;
 */
class Chapter extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const VIEW = 'chapter_list';
    const CREATE = 'chapter_create';
    const UPDATE = 'chapter_update';
    const DELETE = 'chapter_delete';
    const RESTORE = 'chapter_restore';
    const FORCE_DELETE = 'chapter_force_delete';

    protected $fillable = [
        'comic_id',
        'name',
        'number_chapter',
        'slug',
        'content_image',
        'content_text',
        'short_desc',
        'is_visible'
    ];
    public function comic()
    {
        return $this->hasOne(Comic::class, 'id', 'comic_id');
    }
}

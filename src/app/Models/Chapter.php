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
        'name',
        'number_chapter',
        'slug',
        'images',
        'content',
        'short_desc',
    ];

    public function comic()
    {
        return $this->belongsTo(Comic::class, 'chapter_id', 'comic_id', 'chapters');
    }
}

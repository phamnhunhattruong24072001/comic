<?php

namespace App\Models;

use App\Events\CommentEvent;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comment.
 *
 * @package namespace App\Models;
 */
class Comment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'comic_id',
        'client_id',
        'message',
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function comic()
    {
        return $this->hasOne(Comic::class, 'id', 'comic_id');
    }
}

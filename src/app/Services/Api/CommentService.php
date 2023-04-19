<?php

namespace App\Services\Api;

use App\Repositories\Contracts\CommentRepository;
use App\Services\BaseService;

class CommentService extends BaseService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        parent::__construct($commentRepository);
        $this->commentRepository = $commentRepository;
    }

    public function getCommentByComic($comic_id, $params, $columns = ['*'])
    {
        $result = $this->commentRepository
            ->with(['client' => function ($query) {
                $query->select('id', 'name');
            }, 'comic' => function ($query) {
                $query->select('id');
            }])
            ->where('comic_id', $comic_id)
            ->orderBy('created_at', 'DESC');
        return $result->paginate($params['limit'], $columns);
    }

    public function findCommentById($id, $columns = ['*'])
    {
        return $this->commentRepository
            ->with(['client' => function ($query) {
                $query->select('id', 'name');
            }, 'comic' => function ($query) {
                $query->select('id');
            }])
            ->find($id);
    }
}

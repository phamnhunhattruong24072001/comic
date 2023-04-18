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
}

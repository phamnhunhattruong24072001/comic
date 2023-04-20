<?php

namespace App\Http\Controllers\Api;

use App\Events\CommentEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\CommentService;
use Illuminate\Http\Response;
use Pusher\Pusher;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function StoreCommentApi(Request $request)
    {
        $data = $request->all();
        $this->data['comment'] = $this->commentService->storeModel($data);
        $comment = $this->commentService->findCommentById($this->data['comment']->id);
        event(new CommentEvent($comment));
        return $this->sendResult(Response::HTTP_OK, 'Add Comment', $this->data);
    }

    public function GetCommentByComicApi(Request $request ,$id)
    {
        $page = $request->get('page') ?? 1;
        $params = [
            'limit' => 10,
            'page' => $page,
        ];
        $this->data['comments'] = $this->commentService->getCommentByComic($id, $params);
        return $this->sendResult(Response::HTTP_OK, 'Get Comment', $this->data);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Events\CommentEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\CommentService;
use Illuminate\Http\Response;

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
        $this->data['comment'] =  $this->commentService->storeModel($data);
        return $this->sendResult(Response::HTTP_OK, 'Add Comment', $this->data);
    }

    public function GetCommentByComicApi()
    {
        $this->data['comments'] = $this->commentService->getListByField('comic_id', 1);
        return $this->sendResult(Response::HTTP_OK, 'Get Comment', $this->data);
    }

}

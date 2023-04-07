<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Admin\ChapterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChapterController extends Controller
{
    protected $chapterService;
    public function __construct(ChapterService $chapterService)
    {
        $this->chapterService = $chapterService;
    }

    public function getList()
    {
        $chapters = $this->chapterService->getAll(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, trans('chapter.list_title'), $chapters);
    }
}

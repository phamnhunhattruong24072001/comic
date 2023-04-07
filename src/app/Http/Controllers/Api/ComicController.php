<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Admin\ComicService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComicController extends Controller
{
    protected $comicService;
    public function __construct(ComicService $comicService)
    {
        $this->comicService = $comicService;
    }

    public function getListNew()
    {
        $comics = $this->comicService->getAllComicApi();
        return $this->sendResult(Response::HTTP_OK, trans('comic.list_title'), $comics);
    }

    public function findComicBySlug($slug)
    {
        $comic = $this->comicService->findComicBySlugApi($slug);
        return $this->sendResult(Response::HTTP_OK, trans('comic.detail_title'), $comic);
    }
}

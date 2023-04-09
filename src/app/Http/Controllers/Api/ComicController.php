<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ComicService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComicController extends Controller
{
    protected $comicService;
    public function __construct(ComicService $comicService)
    {
        $this->comicService = $comicService;
    }

    public function HomePageApi()
    {
        $this->data['comic_news'] = $this->comicService->getAllComicNewApi();
        $this->data['comic_coming_soon'] = $this->comicService->getAllComicComingSoonApi();
        return $this->sendResult(Response::HTTP_OK, trans('comic.list_title'), $this->data);
    }

    public function DetailComicApi($slug)
    {
        $comic = $this->comicService->findComicBySlugApi($slug);
        return $this->sendResult(Response::HTTP_OK, trans('comic.detail_title'), $comic);
    }
}

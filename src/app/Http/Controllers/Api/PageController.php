<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ComicService;
use App\Services\Api\ChapterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    protected $comicService;
    protected $chapterService;
    public function __construct(ComicService $comicService, ChapterService $chapterService)
    {
        $this->comicService = $comicService;
        $this->chapterService = $chapterService;
    }

    public function HomePageApi()
    {
        $this->data['comic_new'] = $this->comicService->getAllComicNewApi(['*'], 9, true);
        $this->data['comic_coming_soon'] = $this->comicService->getAllComicComingSoonApi(['*'], 9, true);
        $this->data['comic_highlight'] = $this->comicService->getAllComicHighlightApi(['*'], 5, true);
        $this->data['comic_top_view'] = $this->comicService->getAllComicTopViewApi(['*'], 5, true);
        return $this->sendResult(Response::HTTP_OK, trans('comic.list_title'), $this->data);
    }

    public function DetailPageApi($slug)
    {
        $this->data['comic'] = $this->comicService->findComicBySlugApi($slug);
        return $this->sendResult(Response::HTTP_OK, trans('comic.detail_title'), $this->data);
    }

    public function ViewChapterPageApi($slugComic, $slugChapter)
    {
        $this->data['comic'] = $this->comicService->findComicBySlugApi($slugComic);
        $chapters = $this->data['comic']->chapters;
        foreach($chapters as $key => $value) {
            if($value->slug == $slugChapter){
                $this->data['preChapter'] = $chapters[$key];
                $this->data['nextChapter'] = $chapters[$key];
                if(isset($chapters[$key + 1])){
                    $this->data['preChapter'] = $chapters[$key + 1];
                }
                if(isset($chapters[$key - 1])){
                    $this->data['nextChapter'] = $chapters[$key - 1];
                }
            }
        }
        $this->data['chapter'] = $this->chapterService->findBySlugChapterAndComic($slugComic, $slugChapter);
        return $this->sendResult(Response::HTTP_OK, trans('chapter.list_title'), $this->data);
    }
}

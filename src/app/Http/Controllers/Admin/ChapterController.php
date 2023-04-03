<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;
use App\Services\Admin\ChapterService;
use App\Services\Admin\ComicService;

class ChapterController extends Controller
{
    protected $chapterService;
    protected $comicService;

    public function __construct(ChapterService $chapterService, ComicService $comicService)
    {
        $this->chapterService = $chapterService;
        $this->comicService = $comicService;
    }

    public function index($any, Request $request)
    {
        $param = [
            'limit' => 10
        ];
        if($any != "") {
            $comic = $this->comicService->findComicBySlug($any);
            $chapters = $comic->chapters();
        }else{
            $comic = new Comic();
            $chapters = $this->chapterService->getListChapterPaginate($param);
        }
        return view('admin.chapters.list', compact('comic', 'chapters'));
    }

    public function create($any)
    {
        $chapter = new Chapter();
        $type = 'list';
        if($any != "") {
            $comic = $this->comicService->findComicBySlug($any);
            $type = 'first';
        }else{
            $comic = $this->comicService->getAllComic();
        }
        return view('admin.chapters.create', compact('chapter', 'comic', 'type'));
    }
}

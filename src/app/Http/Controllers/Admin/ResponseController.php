<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ChapterService;
use App\Services\Admin\ComicService;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;
use App\Services\Admin\CountryService;
use App\Services\Admin\GenreService;

class ResponseController extends Controller
{
    protected $comicService;
    protected $genreService;
    protected $countryService;
    protected $categoryService;
    protected $chapterService;

    public function __construct(ComicService $comicService, GenreService $genreService, CountryService $countryService, CategoryService $categoryService, ChapterService $chapterService)
    {
        $this->comicService = $comicService;
        $this->genreService = $genreService;
        $this->countryService = $countryService;
        $this->categoryService = $categoryService;
        $this->chapterService = $chapterService;
    }

    public function getCategory(Request $request)
    {
        $result = $this->countryService->findModelById($request->get('id'));
        return response()->json([
            'data' => $result->categories->where('is_visible', config('const.activate.on'))->toArray()
        ]);
    }

    public function getGenre(Request $request)
    {
        $result = $this->categoryService->findModelById($request->get('id'));
        return response()->json([
            'data' => $result->genres->where('is_visible', config('const.activate.on'))->toArray()
        ]);
    }

    public function getChapter(Request $request)
    {
        $result = $this->chapterService->getListByField('comic_id', $request->get('id'), ['id', 'name'], 'number_chapter', 'ASC');
        return response()->json([
            'data' => $result->toArray()
        ]);
    }

    public function checkTypeComic(Request $request)
    {
        $result = $this->comicService->findModelById($request->get('id'));
        return $result->category->type;
    }
}

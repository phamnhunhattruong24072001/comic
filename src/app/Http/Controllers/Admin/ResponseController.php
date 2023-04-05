<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function __construct(ComicService $comicService, GenreService $genreService, CountryService $countryService, CategoryService $categoryService)
    {
        $this->comicService = $comicService;
        $this->genreService = $genreService;
        $this->countryService = $countryService;
        $this->categoryService = $categoryService;
    }

    public function getCategory(Request $request)
    {
        $result = $this->countryService->findCountryById($request->get('id'));
        return response()->json([
            'data' => $result->categories->where('is_visible', config('const.activate.on'))->toArray()
        ]);
    }

    public function getGenre(Request $request)
    {
        $result = $this->categoryService->findCategoryById($request->get('id'));
        return response()->json([
            'data' => $result->genres->where('is_visible', config('const.activate.on'))->toArray()
        ]);
    }

    public function checkTypeComic(Request $request)
    {
        $result = $this->comicService->findComicById($request->get('id'));
        return $result->category->type;
    }
}

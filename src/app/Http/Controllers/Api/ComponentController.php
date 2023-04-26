<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\CategoryService;
use App\Services\Api\ComicService;
use App\Services\Api\CountryService;
use Illuminate\Http\Request;
use App\Services\Api\GenreService;
use Illuminate\Http\Response;

class ComponentController extends Controller
{
    protected $genreService;
    protected $comicService;
    protected $countryService;
    protected $categoryService;

    public function __construct
    (
        GenreService $genreService,
        ComicService $comicService,
        CountryService $countryService,
        CategoryService $categoryService
    )
    {
        $this->genreService = $genreService;
        $this->comicService = $comicService;
        $this->countryService = $countryService;
        $this->categoryService = $categoryService;
    }

    public function GetHeaderApi()
    {
        $this->data['genres'] = $this->genreService->getGenreHasComicApi(['id', 'name', 'slug']);
        $this->data['categories'] = $this->categoryService->getCategoryHasComicApi(['id', 'name', 'slug']);
        $this->data['countries'] = $this->countryService->getCountryHasComic(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, 'Get Header', $this->data);
    }

    public function SearchComic(Request $request)
    {
        $search = $request->get('search');
        $this->data['comics'] = $this->comicService->searchComic($search);
        return $this->sendResult(Response::HTTP_OK, 'Get Search', $this->data);
    }
}

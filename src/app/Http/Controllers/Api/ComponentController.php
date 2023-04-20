<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ComicService;
use Illuminate\Http\Request;
use App\Services\Api\GenreService;
use Illuminate\Http\Response;

class ComponentController extends Controller
{
    protected $genreService;
    protected $comicService;
    public function __construct(GenreService $genreService, ComicService $comicService)
    {
        $this->genreService = $genreService;
        $this->comicService = $comicService;
    }
    public function GetHeaderApi()
    {
        $this->data['genres'] = $this->genreService->getGenreHasComicApi(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, 'Get Header', $this->data);
    }

    public function SearchComic(Request $request)
    {
        $search = $request->get('search');
        $this->data['comics'] = $this->comicService->searchComic($search);
        return $this->sendResult(Response::HTTP_OK, 'Get Search', $this->data);
    }
}

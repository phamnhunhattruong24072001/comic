<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Admin\GenreService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    protected $genreService;
    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function getList()
    {
        $genres = $this->genreService->getAll(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, trans('genre.list_title'), $genres);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\GenreService;
use Illuminate\Http\Response;

class ComponentController extends Controller
{
    protected $genreService;
    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }
    public function GetHeaderApi()
    {
        $this->data['genres'] = $this->genreService->getAll(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, 'Get Header', $this->data);
    }
}

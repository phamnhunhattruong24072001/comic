<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Contracts\GenreRepository;

class GenreService extends BaseService
{
    protected $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        parent::__construct($genreRepository);
        $this->genreRepository = $genreRepository;
    }

    public function getGenreHasComicApi($columns = ['*'])
    {
        $result = $this->genreRepository
            ->with(['comics' => function ($query) {
                $query->select('id');
            }])
            ->has('comics')
            ->where('is_visible', config('const.activate.on'));
        return $result->get($columns);
    }
}

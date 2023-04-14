<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\GenreRepository;
use App\Services\BaseService;

class GenreService extends BaseService
{
    protected $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        parent::__construct($genreRepository);
        $this->genreRepository = $genreRepository;
    }

    public function storeGenre($data)
    {
        $result = $this->genreRepository->create($data);
        if ($result) {
            $this->genreRepository->sync($result->id, 'categories', $data['categories']);
        }
        return $result;
    }

    public function updateGenreById($data, $id)
    {
        $result = $this->genreRepository->update($data, $id);
        if ($result) {
            $this->genreRepository->sync($id, 'categories', $data['categories']);
        }
        return $result;
    }

    public function getGenreHasComic($columns = ['*'])
    {
        $result = $this->genreRepository->with(['comics' => function ($query) {
            $query->select('id');
        }])
            ->has('comics')
            ->where('is_visible', config('const.activate.on'));
        return $result->get($columns);
    }
}

<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ComicRepository;
use App\Services\BaseService;

class ComicService extends BaseService
{
    protected $comicRepository;

    public function __construct(ComicRepository $comicRepository)
    {
        parent::__construct($comicRepository);
        $this->comicRepository = $comicRepository;
    }

    public function storeComic($data)
    {
        $result = $this->comicRepository->create($data);
        if ($result) {
            $this->comicRepository->sync($result->id, 'genres', $data['genres']);
        }
        return $result;
    }

    public function updateComicById($data, $id)
    {
        $result = $this->comicRepository->update($data, $id);
        if ($result) {
            $this->comicRepository->sync($id, 'genres', $data['genres']);
        }
        return $result;
    }

    public function findComicBySlug($slug, $columns = ['*'])
    {
        return $this->comicRepository->findByField('slug', $slug, $columns)->first();
    }

}

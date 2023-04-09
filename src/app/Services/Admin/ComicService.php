<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ComicRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class ComicService extends BaseService
{
    public function __construct(ComicRepository $comicRepository)
    {
        parent::__construct($comicRepository);
    }

    public function storeComic($data)
    {
        $result = $this->repository->create($data);
        if ($result) {
            $this->repository->sync($result->id, 'genres', $data['genres']);
        }
        return $result;
    }

    public function updateComicById($data, $id)
    {
        $result = $this->repository->update($data, $id);
        if ($result) {
            $this->repository->sync($id, 'genres', $data['genres']);
        }
        return $result;
    }

    public function findComicBySlug($slug, $columns = ['*'])
    {
        return $this->repository->findByField('slug', $slug, $columns)->first();
    }
}

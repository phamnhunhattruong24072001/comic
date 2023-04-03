<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ComicRepository;

class ComicService
{
    protected $comicRepository;

    public function __construct(ComicRepository $comicRepository)
    {
        $this->comicRepository = $comicRepository;
    }

    public function getListComicPaginate($param, $columns = ['*'])
    {
        $result = $this->comicRepository->scopeQuery( function($query) use ($param){
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function storeComic($data)
    {
        $result = $this->comicRepository->create($data);
        if($result) {
            $this->comicRepository->sync($result->id ,'genres', $data['genres']);
        }
        return $result;
    }

    public function findComicById($id, $columns = ['*'])
    {
        return $this->comicRepository->find($id, $columns);
    }

    public function updateComicById($data, $id)
    {
        $result = $this->comicRepository->update($data, $id);
        if($result) {
            $this->comicRepository->sync($id ,'genres', $data['genres']);
        }
        return $result;
    }

    public function getListTrashComicPaginate($param, $columns = ['*'])
    {
        $result = $this->comicRepository->scopeQuery(function ($query) use ($param) {
            $query->onlyTrashed();
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function deleteMultipleComic(array $ids)
    {
        return $this->comicRepository->deleteMultiple($ids);
    }

    public function forceDeleteMultipleComic(array $ids)
    {
        return $this->comicRepository->forceDeleteMultiple($ids);
    }

    public function restoreMultipleComic(array $ids)
    {
        return $this->comicRepository->restoreMultiple($ids);
    }

    public function updateStatus($param, $id)
    {
        return $this->comicRepository->update($param, $id);
    }

    public function findComicBySlug($slug)
    {
        return $this->comicRepository->where('slug', $slug)->select(['id', 'slug'])->first();
    }

    public function getAllComic($columns = ['*'])
    {
        return $this->comicRepository->active()->select($columns)->get();
    }
}

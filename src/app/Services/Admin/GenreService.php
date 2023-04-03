<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\GenreRepository;

class GenreService
{
    protected $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function getListGenrePaginate($param, $columns = ['*'])
    {
        $result = $this->genreRepository->scopeQuery( function($query) use ($param){
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function storeGenre($data)
    {
        $result = $this->genreRepository->create($data);
        if($result) {
            $this->genreRepository->sync($result->id ,'categories', $data['categories']);
        }
        return $result;
    }

    public function findGenreById($id, $columns = ['*'])
    {
        return $this->genreRepository->find($id, $columns);
    }

    public function updateGenreById($data, $id)
    {
        $result = $this->genreRepository->update($data, $id);
        if($result) {
            $this->genreRepository->sync($id ,'categories', $data['categories']);
        }
        return $result;
    }

    public function getListTrashGenrePaginate($param, $columns = ['*'])
    {
        $result = $this->genreRepository->scopeQuery(function ($query) use ($param) {
            $query->onlyTrashed();
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function deleteMultipleGenre(array $ids)
    {
        return $this->genreRepository->deleteMultiple($ids);
    }

    public function forceDeleteMultipleGenre(array $ids)
    {
        return $this->genreRepository->forceDeleteMultiple($ids);
    }

    public function restoreMultipleGenre(array $ids)
    {
        return $this->genreRepository->restoreMultiple($ids);
    }

    public function updateStatus($param, $id)
    {
        return $this->genreRepository->update($param, $id);
    }

    public function getAllGenre($columns = ['*'])
    {
        return $this->genreRepository->active()->select($columns)->get();
    }
}

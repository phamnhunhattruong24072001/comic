<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ChapterRepository;
use Illuminate\Support\Facades\DB;

class ChapterService
{
    protected $chapterRepository;
    public function __construct(ChapterRepository $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    public function getListChapterPaginate($param, $columns = ['*'])
    {
        $result = $this->chapterRepository->scopeQuery( function($query) use ($param){
            return $query;
        })->with('comic');
        $result->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function storeChapter($data)
    {
        return $this->chapterRepository->create($data);
    }

    public function getListChapterByIdComic($param ,$id)
    {
        $result = $this->chapterRepository->scopeQuery( function($query) use ($id){
            $query->where('comic_id', $id);
            return $query;
        });
        $result->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], ['*']);
    }

    public function findChapterById($id, $columns = ['*'])
    {
        return $this->chapterRepository->find($id, $columns);
    }

    public function updatecChapter($data, $id)
    {
        return $this->chapterRepository->update($data, $id);
    }
}

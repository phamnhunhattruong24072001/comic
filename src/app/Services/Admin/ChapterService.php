<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ChapterRepository;

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
        });
        $result->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }
}

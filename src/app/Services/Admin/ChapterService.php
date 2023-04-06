<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ChapterRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class ChapterService extends BaseService
{
    protected $chapterRepository;

    public function __construct(ChapterRepository $chapterRepository)
    {
        parent::__construct($chapterRepository);
        $this->chapterRepository = $chapterRepository;
    }

    public function getListChapterPaginate($param, $columns = ['*'])
    {
        $result = $this->chapterRepository->scopeQuery(function ($query) use ($param) {
            return $query;
        });
        $result->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function getListChapterByIdComic($param, $id)
    {
        $result = $this->chapterRepository->scopeQuery(function ($query) use ($id) {
            $query->where('comic_id', $id);
            $query->where('is_visible', config('const.activate.on'));
            return $query;
        });
        $result->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], ['*']);
    }

}

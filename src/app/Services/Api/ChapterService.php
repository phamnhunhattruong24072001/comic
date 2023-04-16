<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Contracts\ChapterRepository;
use Illuminate\Support\Facades\DB;

class ChapterService extends BaseService
{
    protected $chapterRepository;

    public function __construct(ChapterRepository $chapterRepository)
    {
        parent::__construct($chapterRepository);
        $this->chapterRepository = $chapterRepository;
    }

    public function findBySlugChapterAndComic($slugComic, $slugChapter, $columns = ['*'])
    {
        $result = $this->chapterRepository->with('comic')
            ->whereHas('comic', function ($query) use ($slugComic){
                $query->where('slug', $slugComic);
                $query->where('status', config('const.comic.status.release'));
            })
            ->where('slug', $slugChapter);
        return $result->first($columns);
    }
}

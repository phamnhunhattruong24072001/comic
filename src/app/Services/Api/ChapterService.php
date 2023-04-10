<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Contracts\ChapterRepository;

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
        return $this->chapterRepository->scopeQuery(function ($query) use($slugComic){
            $query->join('comics', 'chapters.comic_id', '=', 'comics.id');
            $query->where('comics.slug', $slugComic);
            $query->where('comics.status', config('const.comic.status.release'));
            return $query;
        })->findByField('slug', $slugChapter, $columns)->first();
    }
}

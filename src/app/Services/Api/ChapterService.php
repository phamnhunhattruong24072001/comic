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
        $columns = ['chapters.*'];
        $result = DB::table('chapters')
            ->select($columns)
            ->join('comics', 'chapters.comic_id', '=', 'comics.id')
            ->where('comics.slug', $slugComic)
            ->where('comics.status', config('const.comic.status.release'))
            ->where('chapters.slug', $slugChapter);
        return $result->first();
    }
}

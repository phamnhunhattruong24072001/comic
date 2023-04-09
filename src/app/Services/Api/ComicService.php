<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Contracts\ComicRepository;
use Illuminate\Support\Facades\DB;

class ComicService extends BaseService
{
    protected $comicRepository;

    public function __construct(ComicRepository $comicRepository)
    {
        parent::__construct($comicRepository);
        $this->comicRepository = $comicRepository;
    }

    // Api
    public function getAllComicNewApi($columns = ['*'])
    {
        $result = $this->comicRepository
            ->with(['genres' => function ($query) {
                $query->select('name');
            }, 'chapterLatest' => function ($query) {
                $query->select('comic_id', 'name', 'created_at', 'slug');
            }, 'country', 'category'])
            ->has('chapterLatest')
            ->scopeQuery(function ($query) use ($columns) {
                $query->where('status', config('const.comic.status.release'));
                $query->select($columns);
                return $query;
            })
            ->orderBy('created_at', 'DESC');
        return $result->limit(9);
    }

    public function findComicBySlugApi($slug, $columns = ['*'])
    {
        $result = $this->comicRepository->with(['genres' => function ($query) {
            $query->select('name', 'slug');
        }, 'chapters' => function ($query) {
            $query->select('comic_id', 'name', 'number_chapter', 'slug');
        }, 'country', 'category'])
            ->scopeQuery(function ($query) use ($slug) {
                $query->where('slug', $slug);
                return $query;
            });
        return $result->first($columns);
    }

    public function getAllComicComingSoonApi($columns = ['*'])
    {
        $result = $this->comicRepository
            ->with(['genres' => function ($query) {
                $query->select('name');
            }, 'chapterLatest' => function ($query) {
                $query->select('name', 'slug');
            }, 'category', 'country' => function ($query) {
                $query->select('avatar');
            }])
            ->scopeQuery(function ($query) use ($columns) {
                $query->where('status', config('const.comic.status.waiting_for_release'));
                $query->select($columns);
                return $query;
            })
            ->orderBy('created_at', 'DESC');
        return $result->limit(9);
    }
}

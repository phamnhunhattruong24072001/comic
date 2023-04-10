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
    public function getAllComicNewApi($columns = ['*'], $limit = null, $is_home = false)
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
                return $query;
            })
            ->orderBy('created_at', 'DESC');
        if ($is_home) {
            return $result->limit($limit, $columns);
        }
        return $result->paginate($limit, $columns);
    }

    public function findComicBySlugApi($slug, $columns = ['*'])
    {
        $result = $this->comicRepository
            ->with(['genres' => function ($query) {
                $query->select('name', 'slug');
            }, 'chapters' => function ($query) {
                $query->select('comic_id', 'name', 'number_chapter', 'slug');
                $query->orderBy('number_chapter', 'DESC');
            }, 'country', 'category'])
            ->scopeQuery(function ($query) use ($slug) {
                $query->where('slug', $slug);
                return $query;
            });
        return $result->first($columns);
    }

    public function getAllComicComingSoonApi($columns = ['*'], $limit = null, $is_home = false)
    {
        $result = $this->comicRepository
            ->with(['genres' => function ($query) {
                $query->select('name');
            }, 'chapterLatest' => function ($query) {
                $query->select('comic_id', 'name', 'created_at', 'slug');
            }, 'category', 'country' => function ($query) {
                $query->select('id', 'name', 'avatar');
            }])
            ->has('chapterLatest')
            ->scopeQuery(function ($query) use ($columns) {
                $query->where('status', config('const.comic.status.waiting_for_release'));
                return $query;
            })
            ->orderBy('created_at', 'DESC');
        if ($is_home) {
            return $result->limit($limit, $columns);
        }
        return $result->paginate($limit, $columns);
    }

    public function getAllComicHighlightApi($columns = ['*'], $limit = null, $is_home = false)
    {
        $result = $this->comicRepository
            ->with(['genres' => function ($query) {
                $query->select('name');
            }, 'chapterLatest' => function ($query) {
                $query->select('comic_id', 'name', 'created_at', 'slug');
            }, 'category', 'country' => function ($query) {
                $query->select('id', 'name', 'avatar');
            }])
            ->has('chapterLatest')
            ->scopeQuery(function ($query) use ($columns) {
                $query->where('status', config('const.comic.status.release'));
                $query->where('highlight', config('const.comic.highlight'));
                return $query;
            })
            ->orderBy('created_at', 'DESC');
        if ($is_home) {
            return $result->limit($limit, $columns);
        }
        return $result->paginate($limit, $columns);
    }

    public function getAllComicTopViewApi($columns = ['*'], $limit = null, $is_home = false)
    {
        $result = $this->comicRepository
            ->with(['chapterLatest' => function ($query) {
                $query->select('comic_id', 'name', 'created_at', 'slug');
            },'country' => function ($query) {
                $query->select('id', 'name', 'avatar');
            }])
            ->has('chapterLatest')
            ->scopeQuery(function ($query) use ($columns) {
                $query->where('status', config('const.comic.status.release'));
                return $query;
            })
            ->orderBy('view', 'DESC');
        if ($is_home) {
            return $result->limit($limit, $columns);
        }
        return $result->paginate($limit, $columns);
    }
}

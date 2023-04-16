<?php

namespace App\Services\Api;

use App\Models\Comic;
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
                $query->where('is_visible', config('const.activate.on'));
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
            }, 'country', 'category', 'figures'])
            ->scopeQuery(function ($query) use ($slug) {
                $query->where('slug', $slug);
                $query->where('is_visible', config('const.activate.on'));
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
                $query->where('is_visible', config('const.activate.on'));
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
                $query->where('is_visible', config('const.activate.on'));
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
            }, 'country' => function ($query) {
                $query->select('id', 'name', 'avatar');
            }])
            ->has('chapterLatest')
            ->scopeQuery(function ($query) use ($columns) {
                $query->where('status', config('const.comic.status.release'));
                $query->where('is_visible', config('const.activate.on'));
                return $query;
            })
            ->orderBy('view', 'DESC');
        if ($is_home) {
            return $result->limit($limit, $columns);
        }
        return $result->paginate($limit, $columns);
    }

    public function getFilterComicPaginateApi($slug, $params)
    {
        $slugArr = $params['slugArr'];
        $categories = $params['categories'];
        $countries = $params['countries'];

        $result = $this->comicRepository
            ->with(['genres' => function ($query) {
                $query->select('name');
            }, 'chapterLatest' => function ($query) {
                $query->select('comic_id', 'name', 'created_at', 'slug');
            }, 'category' => function ($query) {
                $query->select('id', 'name');
            }, 'country' => function ($query) {
                $query->select('id', 'name', 'avatar');
            }])
            ->has('chapterLatest')
            ->when($slug, function ($query, $slug) {
                return $query->whereHas('genres', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                });
            })
            ->when($slugArr, function ($query, $slugArr) {
                return $query->whereHas('genres', function ($query) use ($slugArr) {
                    $query->whereIn('slug', $slugArr);
                });
            })
            ->when($countries, function ($query, $countries) {
                return $query->whereHas('country', function ($query) use ($countries) {
                    $query->whereIn('id', $countries);
                });
            })
            ->when($categories, function ($query, $categories) {
                return $query->whereHas('category', function ($query) use ($categories) {
                    $query->whereIn('id', $categories);
                });
            })
            ->where('status', config('const.comic.status.release'))
            ->where('is_visible', config('const.activate.on'));
        return $result->paginate($params['limit'], ['*'], 'page', $params['page']);
    }
}

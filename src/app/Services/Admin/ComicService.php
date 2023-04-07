<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ComicRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class ComicService extends BaseService
{
    protected $comicRepository;

    public function __construct(ComicRepository $comicRepository)
    {
        parent::__construct($comicRepository);
        $this->comicRepository = $comicRepository;
    }

    public function storeComic($data)
    {
        $result = $this->comicRepository->create($data);
        if ($result) {
            $this->comicRepository->sync($result->id, 'genres', $data['genres']);
        }
        return $result;
    }

    public function updateComicById($data, $id)
    {
        $result = $this->comicRepository->update($data, $id);
        if ($result) {
            $this->comicRepository->sync($id, 'genres', $data['genres']);
        }
        return $result;
    }

    public function findComicBySlug($slug, $columns = ['*'])
    {
        return $this->comicRepository->findByField('slug', $slug, $columns)->first();
    }

    // Api
    public function getAllComicApi($columns = ['*'], $col = "created_at", $soft = "DESC")
    {
        $subQuery = DB::table('chapters')
            ->select('comic_id', DB::raw('MAX(number_chapter) as max_number_chapter'))
            ->groupBy('comic_id');

        $result = $this->repository->with(['genres' => function($query){
            $query->select('name');
        }, 'chapters' => function($query) use ($subQuery){
            $query->select('comic_id', 'name', 'number_chapter', 'created_at')
            ->whereIn('id', function($query) use ($subQuery){
                $query->select('id')
                    ->fromSub($subQuery, 'sub')
                    ->whereRaw('chapters.comic_id = sub.comic_id AND chapters.number_chapter = sub.max_number_chapter');
            });
        }, 'country'])->scopeQuery(function ($query) {
            return $query;
        });
        $result->orderBy($col, $soft);
        return $result->get($columns);
    }

    public function findComicBySlugApi($slug, $columns = ['*'])
    {
        $result = $this->repository->with(['genres' => function($query){
            $query->select('name', 'slug');
        }, 'chapters' => function($query){
            $query->select('comic_id', 'name', 'number_chapter', 'slug');
        }, 'country'])->scopeQuery(function ($query) use ($slug){
            $query->where('slug', $slug);
            return $query;
        });
        return $result->first($columns);
    }

}

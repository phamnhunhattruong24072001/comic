<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ComicRepository;
use App\Services\BaseService;
use App\Services\ImgurService;
use Illuminate\Support\Facades\DB;
use Exception;

class ComicService extends BaseService
{
    public function __construct(ComicRepository $comicRepository)
    {
        parent::__construct($comicRepository);
    }

    public function storeComic($data)
    {
        DB::beginTransaction();
        try {
            if (!empty($data['thumbnail'])) {
                $data['thumbnail'] = ImgurService::uploadImage($data['thumbnail']);
                if (!empty($data['cover_image'])) {
                    $data['cover_image'] = ImgurService::uploadImage($data['cover_image']);
                }
            }
            $result = $this->repository->create($data);
            if ($result) {
                $this->repository->sync($result->id, 'genres', $data['genres']);
            }
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return false;
        }
    }

    public function updateComic($data, $id)
    {
        DB::beginTransaction();
        try {
            if (!empty($data['thumbnail'])) {
                $data['thumbnail'] = ImgurService::uploadImage($data['thumbnail']);
                if(!empty($data['thumbnail_exist'])) {
                    ImgurService::deleteImage($data['thumbnail_exist']);
                }
                if (!empty($data['cover_image'])) {
                    $data['cover_image'] = ImgurService::uploadImage($data['cover_image']);
                    if (!empty($data['cover_image_exist'])) {
                        ImgurService::deleteImage($data['cover_image_exist']);
                    }
                }
            }
            $result = $this->repository->update($data, $id);
            if ($result) {
                $this->repository->sync($result->id, 'genres', $data['genres']);
            }
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return false;
        }
    }

    public function findComicBySlug($slug, $columns = ['*'])
    {
        return $this->repository->findByField('slug', $slug, $columns)->first();
    }

    public function forceDeleteMultiple(array $ids)
    {
        DB::beginTransaction();
        try {
            $arrId = [];
            $comics = $this->getComicNoRelation($ids);
            foreach ($comics as $comic) {
                $comic->genres->detach();
                deleteFile($comic->thumbnail);
                deleteFile($comic->cover_image);
                $arrId = array_push($arrId, $comic->id);
            }
            $this->repository->forceDeleteMultiple($arrId);
            DB::commit();
            return true;
        } catch (Exception $e) {
            logger($e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function getComicNoRelation($ids)
    {
        $result = $this->repository
            ->with(['chapters' => function ($query) {
                $query->select('id', 'comic_id');
            }, 'figures', 'genres'])
            ->doesntHave('chapters')
            ->doesntHave('figures')
            ->whereIn('id', $ids);
        return $result->get();
    }
}

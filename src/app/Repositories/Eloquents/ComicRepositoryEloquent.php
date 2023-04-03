<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ComicRepository;
use App\Models\Comic;
use App\Validators\ComicValidator;

/**
 * Class ComicRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ComicRepositoryEloquent extends BaseRepository implements ComicRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comic::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function deleteMultiple(array $ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function forceDeleteMultiple(array $ids)
    {
        return $this->model->whereIn('id', $ids)->forceDelete();
    }

    public function restoreMultiple(array $ids)
    {
        return $this->model->whereIn('id', $ids)->restore();
    }
}

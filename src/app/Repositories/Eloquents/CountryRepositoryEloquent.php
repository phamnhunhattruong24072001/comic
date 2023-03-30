<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CountryRepository;
use App\Models\Country;
use App\Validators\CountryValidator;

/**
 * Class CountryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class CountryRepositoryEloquent extends BaseRepository implements CountryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Country::class;
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
        $this->model->whereIn('id', $ids)->delete();
    }

    public function forceDeleteMultiple(array $ids)
    {
        $this->model->whereIn('id', $ids)->forceDelete();
    }

    public function restoreMultiple(array $ids)
    {
        $this->model->whereIn('id', $ids)->restore();
    }
}

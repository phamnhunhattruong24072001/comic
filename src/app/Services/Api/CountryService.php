<?php

namespace App\Services\Api;

use App\Repositories\Contracts\CountryRepository;
use App\Services\BaseService;
class CountryService extends BaseService
{
    protected $countryRepository;
    public function __construct(CountryRepository $countryRepository)
    {
        parent::__construct($countryRepository);
        $this->countryRepository = $countryRepository;
    }

    public function getCountryHasComic($columns = ['*'])
    {
        $result = $this->countryRepository->with(['comics' => function ($query) {
            $query->select('id');
        }])
            ->has('comics')
            ->where('is_visible', config('const.activate.on'));
        return $result->get($columns);
    }
}

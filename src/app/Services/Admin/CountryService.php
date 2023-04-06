<?php

namespace App\Services\Admin;

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
}

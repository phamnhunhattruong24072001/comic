<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Admin\CountryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    protected $countryService;
    public function __construct(CountryService $countryService)
    {
       $this->countryService = $countryService;
    }

    public function getList()
    {
        $countries = $this->countryService->getAll(['id', 'slug', 'name']);
        return $this->sendResult(Response::HTTP_OK, trans('country.list_title'), $countries);
    }
}

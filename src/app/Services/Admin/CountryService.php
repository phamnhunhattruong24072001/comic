<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\CountryRepository;

class CountryService
{
   protected $countryRepository;

   public function __construct(CountryRepository $countryRepository)
   {
       $this->countryRepository = $countryRepository;
   }

    public function getListCountryPaginate($param, $columns = ['*'])
    {
        $result = $this->countryRepository->scopeQuery( function($query) use ($param){
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function storeCountry($data)
    {
       return $this->countryRepository->create($data);
    }

    public function findCountryById($id, $columns = ['*'])
    {
        return $this->countryRepository->find($id, $columns);
    }

    public function updateCountryById($data, $id)
    {
        return $this->countryRepository->update($data, $id);
    }

    public function getListTrashCountryPaginate($param, $columns = ['*'])
    {
        $result = $this->countryRepository->scopeQuery( function($query) use ($param){
            $query->onlyTrashed();
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function deleteMultipleCountry(array $ids)
    {
        return $this->countryRepository->deleteMultiple($ids);
    }

    public function forceDeleteMultipleCountry(array $ids)
    {
        return $this->countryRepository->forceDeleteMultiple($ids);
    }

    public function restoreMultipleCountry(array $ids)
    {
        return $this->countryRepository->restoreMultiple($ids);
    }

    public function getAllCountry($columns = ['*'])
    {
        return $this->countryRepository->active()->select($columns)->get();
    }
}

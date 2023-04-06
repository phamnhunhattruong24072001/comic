<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getListCategoryPaginate($param, $columns = ['*'])
    {
        $result = $this->categoryRepository->scopeQuery(function ($query) use ($param) {
            return $query;
        })
        ->orderBy('created_at', 'ASC');
        return $result->paginate($param['limit'], $columns);
    }

    public function storeCategory($data)
    {
        $result = $this->categoryRepository->create($data);
        if($result) {
            $this->categoryRepository->sync($result->id ,'countries', $data['countries']);
        }
        return $result;
    }

    public function findCategoryById($id, $columns = ['*'])
    {
        return $this->categoryRepository->find($id, $columns);
    }

    public function updateCategoryById($data, $id)
    {
        $result = $this->categoryRepository->update($data, $id);
        if($result) {
            $this->categoryRepository->sync($id ,'countries', $data['countries']);
        }
        return $result;
    }

    public function getListTrashCategoryPaginate($param, $columns = ['*'])
    {
        $result = $this->categoryRepository->scopeQuery(function ($query) use ($param) {
            $query->onlyTrashed();
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function deleteMultipleCategory(array $ids)
    {
        return $this->categoryRepository->deleteMultiple($ids);
    }

    public function forceDeleteMultipleCategory(array $ids)
    {
        return $this->categoryRepository->forceDeleteMultiple($ids);
    }

    public function restoreMultipleCategory(array $ids)
    {
        return $this->categoryRepository->restoreMultiple($ids);
    }

    public function getAllCategory($columns = ['*'])
    {
        return $this->categoryRepository->active()->select($columns)->get();
    }
}

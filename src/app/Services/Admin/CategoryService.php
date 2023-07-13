<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepository;
use App\Services\BaseService;

class CategoryService extends BaseService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }

    public function storeCategory($data)
    {
        $result = $this->categoryRepository->create($data);
        if ($result) {
            $this->categoryRepository->sync($result->id, 'countries', $data['countries']);
        }
        return $result;
    }

    public function updateCategoryById($data, $id)
    {
        $result = $this->categoryRepository->update($data, $id);
        if ($result) {
            $this->categoryRepository->sync($id, 'countries', $data['countries']);
        }
        return $result;
    }

    public function forceDeleteMultiple($ids) {
        return $this->categoryRepository->forceDeleteMultiple($ids);
    }
}

<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Contracts\CategoryRepository;

class CategoryService extends BaseService
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryHasComicApi($columns = ['*'])
    {
        $result = $this->categoryRepository->with(['comics' => function ($query) {
            $query->select('id');
        }])
            ->has('comics')
            ->where('is_visible', config('const.activate.on'));
        return $result->get($columns);
    }
}

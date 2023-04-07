<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getList()
    {
        $categories = $this->categoryService->getAll(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, trans('category.list_title'), $categories);
    }
}

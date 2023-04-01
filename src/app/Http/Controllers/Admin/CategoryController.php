<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $param = [
            'limit' => 10,
        ];
        $categories = $this->categoryService->getListCategoryPaginate($param);
        return view('admin.categories.list', compact('categories'));
    }

    public function create()
    {
        $category = new Category();
        $parentCategory = $this->categoryService->getParentCategory();
        return view('admin.categories.create', compact('category', 'parentCategory'));

    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryService->storeCategory($data);
        return redirect()->route('admin.category.list');
    }

    public function edit($id)
    {
        $category = $this->categoryService->findCategoryById($id);
        $parentCategory = $this->categoryService->getParentCategory($id);
        return view('admin.categories.edit', compact('category', 'parentCategory'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $this->categoryService->updateCategoryById($data, $id);
        return redirect()->route('admin.category.list');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->categoryService->deleteMultipleCategory($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->categoryService->restoreMultipleCategory($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->categoryService->forceDeleteMultipleCategory($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $categories = $this->categoryService->getListTrashCategoryPaginate($param);
        return view('admin.categories.trash', compact('categories'));
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->categoryService->updateStatus($param, $id);
    }
}
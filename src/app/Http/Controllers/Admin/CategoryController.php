<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use App\Services\Admin\CountryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $countryService;

    public function __construct(CategoryService $categoryService, CountryService $countryService)
    {
        $this->categoryService = $categoryService;
        $this->countryService = $countryService;
    }

    public function index()
    {
        $param = [
            'limit' => 10,
        ];
        $data = [
            'categories' => $this->categoryService->getListModelPaginate($param)
        ];
        return view('admin.categories.list')->with($data);
    }

    public function create()
    {
        $data = [
            'category' => new Category(),
            'countries' => $this->countryService->getAll(['id', 'name']),
            'countrySelected' => [],
        ];
        return view('admin.categories.create')->with($data);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryService->storeCategory($data);
        return redirect()->route('admin.category.list');
    }

    public function edit($id)
    {
        $data = [
            'category' => $this->categoryService->findModelById($id),
            'countries' => $this->countryService->getAll(['id', 'name']),
            'countrySelected' => $this->categoryService->findModelById($id)->countries()->pluck('country_id')->toArray(),
        ];
        return view('admin.categories.edit')->with($data);
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
        $this->categoryService->deleteMultiple($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->categoryService->restoreMultiple($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->categoryService->forceDeleteMultiple($ids);
        return redirect()->back();
    }
    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $data = [
            'categories' => $this->categoryService->getListTrashModelPaginate($param),
        ];
        return view('admin.categories.trash')->with($data);
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->categoryService->updateCategoryById($param, $id);
    }
}

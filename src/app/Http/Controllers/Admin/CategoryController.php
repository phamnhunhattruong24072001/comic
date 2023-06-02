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
        $this->data['categories'] = $this->categoryService->getListModelPaginate($param);
        return view('admin.categories.list')->with($this->data);
    }

    public function create()
    {
        $this->data['category'] = new Category();
        $this->data['countries'] = $this->countryService->getAll(['id', 'name']);
        $this->data['countrySelected'] = [];
        return view('admin.categories.create')->with($this->data);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryService->storeCategory($data);
        return redirect()->route('admin.category.list');
    }

    public function edit($id)
    {
        $this->data['category'] = $this->categoryService->findModelById($id);
        $this->data['countries'] = $this->countryService->getAll(['id', 'name']);
        $this->data['countrySelected'] = $this->data['category']->countries()->pluck('country_id')->toArray();
        return view('admin.categories.edit')->with($this->data);
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
//ok
    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['categories'] = $this->categoryService->getListTrashModelPaginate($param);
        return view('admin.categories.trash')->with($this->data);
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

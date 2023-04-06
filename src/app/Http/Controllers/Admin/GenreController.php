<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use App\Services\Admin\GenreService;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    protected $genreService;
    protected $categoryService;

    public function __construct(GenreService $genreService, CategoryService $categoryService)
    {
        $this->genreService = $genreService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['genres'] = $this->genreService->getListModelPaginate($param);
        return view('admin.genres.list')->with($this->data);
    }

    public function create()
    {
        $this->data['genre'] = new Genre();
        $this->data['categories'] = $this->categoryService->getAll(['id', 'name']);
        $this->data['categorySelected'] = [];
        return view('admin.genres.create')->with($this->data);
    }

    public function store(GenreRequest $request)
    {
        $data = $request->all();
        $this->genreService->storeGenre($data);
        return redirect()->route('admin.genre.list');
    }

    public function edit($id)
    {
        $this->data['genre'] = $this->genreService->findModelById($id);
        $this->data['categories'] = $this->categoryService->getAll(['id', 'name']);
        $this->data['categorySelected'] = $this->data['genre']->categories()->pluck('category_id')->toArray();
        return view('admin.genres.edit')->with($this->data);
    }

    public function update(GenreRequest $request, $id)
    {
        $data = $request->all();
        $this->genreService->updateGenreById($data, $id);
        return redirect()->route('admin.genre.list');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->genreService->deleteMultiple($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->genreService->restoreMultiple($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->genreService->forceDeleteMultiple($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['genres'] = $this->genreService->getListTrashModelPaginate($param);
        return view('admin.genres.trash')->with($this->data);
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->genreService->updateGenreById($param, $id);
    }
}

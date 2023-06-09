<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComicRequest;
use App\Models\Category;
use App\Models\Comic;
use App\Models\Genre;
use App\Services\Admin\CategoryService;
use App\Services\Admin\ComicService;
use App\Services\Admin\CountryService;
use App\Services\Admin\GenreService;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    protected $comicService;
    protected $genreService;
    protected $countryService;
    protected $categoryService;

    public function __construct(ComicService $comicService, GenreService $genreService, CountryService $countryService, CategoryService $categoryService)
    {
        $this->comicService = $comicService;
        $this->genreService = $genreService;
        $this->countryService = $countryService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['comics'] = $this->comicService->getListModelPaginate($param);
        return view('admin.comics.list')->with($this->data);
    }

    public function create()
    {
        $this->data['comic'] = new Comic();
        $this->data['countries'] = $this->countryService->getAll(['id', 'name']);
        $this->data['genreSelected'] = [];
        return view('admin.comics.create')->with($this->data);
    }

    public function store(ComicRequest $request)
    {
        $data = $request->all();
        $result = $this->comicService->storeComic($data);
        if ($result) {
            return redirect()->route('admin.comic.list');
        }
        return redirect()->route('admin.comic.create');
    }

    public function edit($id)
    {
        $this->data['comic'] = $this->comicService->findModelById($id);
        $this->data['countries'] = $this->countryService->getAll(['id', 'name', 'another_name']);
        $country = $this->countryService->findModelById($this->data['comic']->country_id, ['id']);
        $this->data['categories'] = $country->categories;
        $category = $this->categoryService->findModelById($this->data['comic']->category_id, ['id']);
        $this->data['genres'] = $category->genres;
        $this->data['genreSelected'] = $this->data['comic']->genres()->pluck('genre_id')->toArray();
        $this->data['is_update'] = true;
        return view('admin.comics.edit')->with($this->data);
    }

    public function update(ComicRequest $request, $id)
    {
        $data = $request->all();
        $this->comicService->updateComic($data, $id);
        return redirect()->route('admin.comic.list');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->comicService->deleteMultiple($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->comicService->restoreMultiple($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->comicService->forceDeleteMultiple($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['comics'] = $this->comicService->getListTrashModelPaginate($param);
        return view('admin.comics.trash')->with($this->data);
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $params = [
            'is_visible' => $is_visible
        ];
        $this->comicService->updateComic($params, $id);
    }
}

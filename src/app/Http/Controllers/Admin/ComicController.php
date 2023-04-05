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
        $comics = $this->comicService->getListComicPaginate($param);
        return view('admin.comics.list', compact('comics'));
    }

    public function create()
    {
        $this->data['comic'] = new Comic();
        $this->data['countries'] = $this->countryService->getAllCountry();
        $this->data['genreSelected'] = [];
        return view('admin.comics.create')->with($this->data);
    }

    public function store(ComicRequest $request)
    {
        $data = $request->all();
        $path = config('const.path.comic');
        $data['thumbnail'] = uploadFile($path ,$request->file('thumbnail'));
        $data['cover_image'] = uploadFile($path ,$request->file('cover_image'));
        $this->comicService->storeComic($data);
        return redirect()->route('admin.comic.list');
    }

    public function edit($id)
    {
        $this->data['comic'] = $this->comicService->findComicById($id);
        $this->data['countries'] = $this->countryService->getAllCountry(['id', 'name', 'another_name']);
        $country = $this->countryService->findCountryById($this->data['comic']->country_id, ['id']);
        $this->data['categories'] = $country->categories;
        $category = $this->categoryService->findCategoryById($this->data['comic']->category_id, ['id']);
        $this->data['genres'] = $category->genres;
        $this->data['genreSelected'] = $this->data['comic']->genres()->pluck('genre_id')->toArray();
        $this->data['is_update'] = true;
        return view('admin.comics.edit')->with($this->data);
    }

    public function update(ComicRequest $request, $id)
    {
        $data = $request->all();
        $path = config('const.path.comic');
        if($request->hasFile('thumbnail')){
            deleteFile($data['thumbnail_exist']);
            $data['thumbnail'] = uploadFile($path ,$request->file('thumbnail'));
        }
        if ($request->hasFile('cover_image')) {
            deleteFile($data['cover_image_exist']);
            $data['cover_image'] = uploadFile($path ,$request->file('cover_image'));
        }
        $this->comicService->updateComicById($data, $id);
        return redirect()->route('admin.comic.list');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->comicService->deleteMultipleComic($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->comicService->restoreMultipleComic($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->comicService->forceDeleteMultipleComic($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $comics = $this->comicService->getListTrashComicPaginate($param);
        return view('admin.comics.trash', compact('comics'));
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->comicService->updateStatus($param, $id);
    }
}

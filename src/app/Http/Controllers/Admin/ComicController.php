<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComicRequest;
use App\Models\Comic;
use App\Services\Admin\ComicService;
use App\Services\Admin\GenreService;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    protected $comicService;
    protected $genreService;

    public function __construct(ComicService $comicService, GenreService $genreService)
    {
        $this->comicService = $comicService;
        $this->genreService = $genreService;
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
        $comic = new Comic();
        $genres = $this->genreService->getAllGenre(['id', 'name']);
        $genreSelected = [];
        return view('admin.comics.create', compact('comic', 'genres', 'genreSelected'));
    }

    public function store(ComicRequest $request)
    {
        $data = $request->all();
        $path = config('const.path.comic');
        $data['thumbnail'] = uploadFile($path ,$request->file('thumbnail'), 1);
        $data['cover_image'] = uploadFile($path ,$request->file('cover_image'), 2);
        $this->comicService->storeComic($data);
        return redirect()->route('admin.comic.list');
    }

    public function edit($id)
    {
        $comic = $this->comicService->findComicById($id);
        $genres = $this->genreService->getAllGenre(['id', 'name']);
        $genreSelected = $comic->genres()->pluck('genre_id')->toArray();
        return view('admin.comics.edit', compact('comic', 'genres', 'genreSelected'));
    }

    public function update(ComicRequest $request, $id)
    {
        $data = $request->all();
        $path = config('const.path.comic');
        if($request->hasFile('thumbnail')){
            $data['thumbnail'] = uploadFile($path ,$request->file('thumbnail'), 1);
        }
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = uploadFile($path ,$request->file('cover_image'), 2);
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

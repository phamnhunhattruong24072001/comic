<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;
use App\Services\Admin\ChapterService;
use App\Services\Admin\ComicService;

class ChapterController extends Controller
{
    protected $chapterService;
    protected $comicService;

    public function __construct(ChapterService $chapterService, ComicService $comicService)
    {
        $this->chapterService = $chapterService;
        $this->comicService = $comicService;
    }

    public function index(Request $request, $any = "")
    {
        $param = [
            'limit' => 10
        ];
        if($any != "") {
            $comic = $this->comicService->findComicBySlug($any);
            $chapters = $this->chapterService->getListChapterByIdComic($param, $comic->id);

        }else{
            $comic = new Comic();
            $chapters = $this->chapterService->getListChapterPaginate($param);
        }
        return view('admin.chapters.list', compact('comic', 'chapters'));
    }

    public function create($any = "")
    {
        $chapter = new Chapter();
        $is_list = true;
        if($any != "") {
            $comic = $this->comicService->findComicBySlug($any);
            $is_list = false;
        }else{
            $comic = $this->comicService->getAllComic();
        }
        return view('admin.chapters.create', compact('chapter', 'comic', 'is_list'));
    }

    public function store(ChapterRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('images')) {
            $path = config('const.path.chapter');
            $newFiles = uploadFileMultiple($path, $data['images']);
            $data['content_image'] = json_encode($newFiles);
        }
        $this->chapterService->storeChapter($data);
        if (isset($data['is_comic'])) {
            return redirect()->route('admin.chapter.list', $data['is_comic']);
        }
        return redirect()->route('admin.chapter.list');
    }

    public function edit($id)
    {
        $this->data['chapter'] = $this->chapterService->findChapterById($id);
        $this->data['comic'] = $this->comicService->getAllComic(['id', 'name']);
        $comic = $this->data['chapter']->comic;
        $this->data['chapterImages'] = json_decode($this->data['chapter']->content_image);
        $this->data['is_list'] = true;
        $this->data['type_comic'] = $comic->category->type;
        return view('admin.chapters.edit')->with($this->data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $arrExist = [];
        if($request->has('image_exist')) {
            $arrExist = explode(',', $data['image_exist']);
        }
        if ($request->hasFile('images')) {
            $path = config('const.path.chapter');
            $newFiles = uploadFileMultiple($path, $data['images']);
            $newFiles = array_merge($arrExist, $newFiles);
            $data['content_image'] = json_encode($newFiles);
        }else{
            $data['content_image'] = json_encode($arrExist);
        }
        $this->chapterService->updatecChapter($data, $id);
        return back();
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->chapterService->updateStatus($param, $id);
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->chapterService->deleteMultipleChapter($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->chapterService->restoreMultipleChapter($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->chapterService->forceDeleteMultipleChapter($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $comics = $this->chapterService->getListTrashChapterPaginate($param);
        return view('admin.chapters.trash', compact('comics'));
    }
}

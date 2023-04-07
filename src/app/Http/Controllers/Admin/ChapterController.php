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
            $this->data['comic'] = $this->comicService->findComicBySlug($any);
            $this->data['chapters'] = $this->chapterService->getListChapterByIdComic($param, $this->data['comic']->id);

        }else{
            $this->data['comic'] = new Comic();
            $this->data['chapters'] = $this->chapterService->getListChapterPaginate($param);
        }
        return view('admin.chapters.list')->with($this->data);
    }

    public function create($any = "")
    {
        $this->data['chapter'] = new Chapter();
        $this->data['is_list'] = true;
        if($any != "") {
            $this->data['comic'] = $this->comicService->findComicBySlug($any, ['id', 'name', 'slug', 'category_id']);
            $this->data['type_comic'] = $this->data['comic']->category->type;
            $this->data['is_list'] = false;
        }else{
            $this->data['comic'] = $this->comicService->getAll();
        }
        return view('admin.chapters.create')->with($this->data);
    }

    public function store(ChapterRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('images')) {
            $path = config('const.path.chapter');
            $newFiles = uploadFileMultiple($path, $data['images']);
            $data['content_image'] = json_encode($newFiles);
        }
        $this->chapterService->storeModel($data);
        if (isset($data['is_comic'])) {
            return redirect()->route('admin.chapter.list', $data['is_comic']);
        }
        return redirect()->route('admin.chapter.list');
    }

    public function edit($id)
    {
        $this->data['chapter'] = $this->chapterService->findModelById($id);
        $this->data['comic'] = $this->comicService->getAll(['id', 'name']);
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
        $this->chapterService->updateModel($data, $id);
        return back();
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $data = [
            'is_visible' => $is_visible
        ];
        $this->chapterService->updateModel($data, $id);
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->chapterService->deleteMultiple($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->chapterService->restoreMultiple($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->chapterService->forceDeleteMultiple($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['comics'] = $this->chapterService->getListTrashModelPaginate($param);
        return view('admin.chapters.trash')->with($this->data);
    }

    public function editImage($id)
    {
        $this->data['chapter'] = $this->chapterService->findModelById($id, ['id', 'content_image', 'name']);
        $this->data['arrImage'] = json_decode($this->data['chapter']->content_image);
        return view('admin.chapters.edit_image')->with($this->data);
    }

    public function updateImage(Request $request, $id)
    {
        if ($request->get('image_move')) {
            $image_move = $request->get('image_move');
            $arr = explode(',', $image_move);
            $data['content_image'] = json_encode($arr);
            $this->chapterService->updateModel($data, $id);
        }
        return redirect()->route('admin.chapter.list');
    }
}

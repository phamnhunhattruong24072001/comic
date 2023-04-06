<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FigureRequest;
use App\Models\Figure;
use App\Models\Comic;
use App\Services\Admin\ChapterService;
use App\Services\Admin\ComicService;
use App\Services\Admin\FigureService;
use Illuminate\Http\Request;

class FigureController extends Controller
{
    protected $figureService;
    protected $comicService;
    protected $chapterService;

    public function __construct(FigureService $figureService, ComicService $comicService, ChapterService $chapterService)
    {
        $this->figureService = $figureService;
        $this->comicService = $comicService;
        $this->chapterService = $chapterService;
    }

    public function index(Request $request, $any = "")
    {
        $param = [
            'limit' => 10
        ];
        if($any != "") {
            $this->data['comic'] = $this->comicService->findModelByField('slug', $any);
            $this->data['figures'] = $this->figureService->getListFigureByIdComic($param, $this->data['comic']->id);

        }else{
            $this->data['comic'] = new Comic();
            $this->data['figures'] = $this->figureService->getListModelPaginate($param);
        }
        return view('admin.figures.list')->with($this->data);
    }

    public function create($any = "")
    {
        $this->data['figure'] = new Figure();
        $this->data['is_list'] = true;
        if($any != "") {
            $this->data['comic'] = $this->comicService->findModelByField('slug' ,$any, ['id', 'name', 'slug', 'category_id']);
            $this->data['chapters'] = $this->data['comic']->chapters;
            $this->data['is_list'] = false;
        }else{
            $this->data['comic'] = $this->comicService->getAll();
        }
        return view('admin.figures.create')->with($this->data);
    }

    public function store(FigureRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $path = config('const.path.figure');
            $newFile = uploadFile($path, $data['avatar']);
            $data['avatar'] = $newFile;
        }
        $this->figureService->storeModel($data);
        if (isset($data['is_comic'])) {
            return redirect()->route('admin.figure.list', $data['is_comic']);
        }
        return redirect()->route('admin.figure.list');
    }

    public function edit($id)
    {
        $this->data['figure'] = $this->figureService->findModelById($id);
        $this->data['comic'] = $this->comicService->getAll(['id', 'name']);
        $comic = $this->data['figure']->comic;
        $this->data['chapters'] = $comic->chapters;
        $this->data['is_list'] = true;
        return view('admin.figures.edit')->with($this->data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $arrExist = [];
        if($request->has('image_exist')) {
            $arrExist = explode(',', $data['image_exist']);
        }
        if ($request->hasFile('images')) {
            $path = config('const.path.figure');
            $newFiles = uploadFileMultiple($path, $data['images']);
            $newFiles = array_merge($arrExist, $newFiles);
            $data['content_image'] = json_encode($newFiles);
        }else{
            $data['content_image'] = json_encode($arrExist);
        }
        $this->figureService->updateModel($data, $id);
        return back();
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->figureService->updateModel($param, $id);
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->figureService->deleteMultiple($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->figureService->restoreMultiple($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->figureService->forceDeleteMultiple($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['comics'] = $this->figureService->getListTrashModelPaginate($param);
        return view('admin.figures.trash')->with($this->data);
    }
}

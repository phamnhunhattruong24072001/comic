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
        $this->data['figures'] = $this->figureService->getListModelPaginate($param);
        return view('admin.figures.list')->with($this->data);
    }

    public function create($any = "")
    {
        $this->data['figure'] = new Figure();
        $this->data['comics'] = $this->comicService->getAll(['name', 'id']);
        $this->data['comicSelected'] = [];
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
        $this->figureService->storeFigure($data);
        if (isset($data['is_comic'])) {
            return redirect()->route('admin.figure.list', $data['is_comic']);
        }
        return redirect()->route('admin.figure.list');
    }

    public function edit($id)
    {
        $this->data['figure'] = $this->figureService->findModelById($id);
        $this->data['comics'] = $this->comicService->getAll(['id', 'name']);
        $this->data['comicSelected'] = $this->data['figure']->comics()->pluck('comic_id')->toArray();
        return view('admin.figures.edit')->with($this->data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            deleteFile($data['image_exist']);
            $path = config('const.path.figure');
            $newFile = uploadFile($path, $data['avatar']);
            $data['avatar'] = $newFile;
        }
        $this->figureService->updateFigure($data, $id);
        return redirect()->route('admin.figure.list');
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

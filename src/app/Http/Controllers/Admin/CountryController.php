<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\Admin\CountryService;
use App\Http\Requests\CountryRequest;
use App\Services\ImgurService;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['countries'] = $this->countryService->getListModelPaginate($param);
        return view('admin.countries.list')->with($this->data);
    }

    public function create()
    {
        $this->data['country'] = new Country();
        return view('admin.countries.create')->with($this->data);

    }

    public function store(CountryRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = ImgurService::uploadImage($request->file('avatar'));
        }
        $this->countryService->storeModel($data);
        return redirect()->route('admin.country.list');
    }

    public function edit($id)
    {
        $this->data['country'] = $this->countryService->findModelById($id);
        return view('admin.countries.edit')->with($this->data);
    }

    public function update(CountryRequest $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = ImgurService::uploadImage($request->file('avatar'));
        }
        $this->countryService->updateModel($data, $id);
        return redirect()->route('admin.country.list');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->countryService->deleteMultiple($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->countryService->restoreMultiple($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->countryService->forceDeleteMultiple($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['countries'] = $this->countryService->getListTrashModelPaginate($param);
        return view('admin.countries.trash')->with($this->data);
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->countryService->updateModel($param, $id);
    }

}

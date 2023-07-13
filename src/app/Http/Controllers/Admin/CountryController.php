<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\Admin\CountryService;
use App\Http\Requests\CountryRequest;
use App\Services\ImgurService;
use Illuminate\Support\Facades\Storage;

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
        $data = [
            'countries' => $this->countryService->getListModelPaginate($param)
        ];
        return view('admin.countries.list')->with($data);
    }

    public function create()
    {
        $data = [
            'country' => new Country()
        ];
        return view('admin.countries.create')->with($data);

    }

    public function store(CountryRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadFile('countries', $request->file('avatar'));
        }
        $this->countryService->storeModel($data);
        return redirect()->route('admin.country.list');
    }

    public function edit($id)
    {
        $data = [
            'country' => $this->countryService->findModelById($id)
        ];
        return view('admin.countries.edit')->with($data);
    }

    public function update(CountryRequest $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadFile('countries', $data['avatar'], $data['image_exist']);
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
        $data = [
            'countries' => $this->countryService->getListTrashModelPaginate($param)
        ];
        return view('admin.countries.trash')->with($data);
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

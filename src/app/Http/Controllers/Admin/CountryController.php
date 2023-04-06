<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\Admin\CountryService;
use App\Http\Requests\CountryRequest;

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
        $this->data['countries'] = $this->countryService->getListCountryPaginate($param);
        return view('admin.countries.list')->with($this->data);
    }

    public function create()
    {
        $country = new Country();
        return view('admin.countries.create')->with($this->data);

    }

    public function store(CountryRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $path = config('const.path.country');
            $fileName = uploadFile($path ,$request->file('avatar'));
            $data['avatar'] = $fileName;
        }
        $this->countryService->storeCountry($data);
        return redirect()->route('admin.country.list');
    }

    public function edit($id)
    {
        $this->data['country'] = $this->countryService->findCountryById($id);
        return view('admin.countries.edit')->with($this->data);
    }

    public function update(CountryRequest $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            deleteFile($data['image_exist']);
            $path = config('const.path.country');
            $fileName = uploadFile($path ,$request->file('avatar'));
            $data['avatar'] = $fileName;
        }
        $this->countryService->updateCountryById($data, $id);
        return redirect()->route('admin.country.list');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->countryService->deleteMultipleCountry($ids);
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->countryService->restoreMultipleCountry($ids);
        return redirect()->back();
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->countryService->forceDeleteMultipleCountry($ids);
        return redirect()->back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['countries'] = $this->countryService->getListTrashCountryPaginate($param);
        return view('admin.countries.trash')->with($this->data);
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->countryService->updateCountryById($param, $id);
    }

}

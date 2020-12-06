<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\CountryRepository;
use App\Models\Country;
use App\Http\Services\CountryService;
use Laracasts\Flash\Flash;
use App\Http\Traits\ResponseTrait;

class CountryController extends Controller
{
    use ResponseTrait;

    protected $countryRepository;

    protected $countryService;

    public function __construct(CountryRepository $countryRepository, CountryService $countryService)
    {
        $this->countryRepository = $countryRepository;

        $this->countryService = $countryService;
    }

    public function index() 
    {
        $image = $this->countryRepository->findAll();
       
        return view('admin.country.index', compact('image')); 
    }

    public function create(Country $country)
    {
        $data = $this->countryRepository->getFormData($country);

        return view('admin.country.form', $data);
    }

    public function store(Request $request)
    {
        if($image = $this->countryService->create($request->only('name'))) {
            
            $destinationPath = public_path() . config('dashboard.country_image');

            if ($fileName = isFileExist($request, $image, 'image', $destinationPath)) {
                $image->image = $fileName;
                $image->update();
            }

            Flash::success($this->success());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.country.index');
    }

    public function edit($id)
    {
        $country = $this->countryRepository->find($id);

        $data = $this->countryRepository->getFormData($country);

        return view('admin.country.form', $data);
    }

    public function update(Request $request, $id)
    {
        $image = $this->countryRepository->find($id);

        if($country = $this->countryService->update($image, $request->only('name'))) {

            $destinationPath = public_path() . config('dashboard.country_image');
            
            if ($fileName = isFileExist($request, $image, 'image', $destinationPath)) {
                $image->image = $fileName;
                $image->update();
            }

            Flash::success($this->updated());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.country.index');

    }

    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        $country->radioList()->detach();
        if($this->countryService->delete($country)) {

            Flash::success($this->deleted());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->back();

    }

}

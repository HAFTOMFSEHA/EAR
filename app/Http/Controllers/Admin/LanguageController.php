<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\LanguageRepository;
use App\Models\Language;
use App\Http\Services\LanguageService;
use Laracasts\Flash\Flash;
use App\Http\Traits\ResponseTrait;

class LanguageController extends Controller
{
    use ResponseTrait;

    protected $languageRepository;

    protected $languageService;

    public function __construct(LanguageRepository $languageRepository, LanguageService $languageService)
    {
        $this->languageRepository = $languageRepository;

        $this->languageService = $languageService;
    }

    public function index() 
    {
        $image = $this->languageRepository->findAll();
       
        return view('admin.language.index', compact('image')); 
    }

    public function create(Language $language)
    {
        $data = $this->languageRepository->getFormData($language);

        return view('admin.language.form', $data);
    }

    public function store(Request $request)
    {
        if($image = $this->languageService->create($request->only('name'))) {
            
            Flash::success($this->success());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.language.index');
    }

    public function edit($id)
    {
        $language = $this->languageRepository->find($id);

        $data = $this->languageRepository->getFormData($language);

        return view('admin.language.form', $data);
    }

    public function update(Request $request, $id)
    {
        $image = $this->languageRepository->find($id);

        if($language = $this->languageService->update($image, $request->only('name'))) {

            Flash::success($this->updated());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.language.index');

    }

    public function destroy($id)
    {
        $language = $this->languageRepository->find($id);

        $language->radioList()->detach();
        if($this->languageService->delete($language)) {

            Flash::success($this->deleted());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->back();

    }

}

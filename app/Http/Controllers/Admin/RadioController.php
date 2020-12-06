<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\RadioRepository;
use App\Models\RadioList;
use App\Http\Services\RadioService;
use Laracasts\Flash\Flash;
use App\Http\Traits\ResponseTrait;

class RadioController extends Controller
{
    use ResponseTrait;

    protected $radioRepository;

    protected $radioService;

    public function __construct(RadioRepository $radioRepository, RadioService $radioService)
    {
        $this->radioRepository = $radioRepository;

        $this->radioService = $radioService;
    }

    public function index() 
    {
        $radio = $this->radioRepository->findAll();
       
        return view('admin.radio.index', compact('radio')); 
    }

    public function create(RadioList $radio)
    {
        $data = $this->radioRepository->getFormData($radio);

        return view('admin.radio.form', $data);
    }

    public function store(Request $request)
    {
        if($radio = $this->radioService->create($request->only('language_id', 'country_id', 'genres_id', 'name', 'streaming_link', 'description'))) {
            
            $destinationPath = public_path() . config('dashboard.radio_image');

            if ($fileName = isFileExist($request, $radio, 'image', $destinationPath)) {
                $radio->image = $fileName;
                $radio->update();
            }

            Flash::success($this->success());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.radio.index');
    }

    public function edit($id)
    {
        $radio = $this->radioRepository->find($id);

        $data = $this->radioRepository->getFormData($radio);

        return view('admin.radio.form', $data);
    }

    public function show($id)
    {
        $radio = $this->radioRepository->find($id);

        $data = ['radio' => $radio];

        return view('admin.radio.show', $data);
    }

    public function mostlyPlayedShow($id)
    {
        $radio = $this->radioRepository->find($id);

        $data = ['radio' => $radio];

        return view('admin.radio.mostly-played-show', $data);
    }

    public function update(Request $request, $id)
    {
        $radio = $this->radioRepository->find($id);

        if($radioData = $this->radioService->update($radio, $request->only('language_id', 'genres_id', 'name', 'streaming_link', 'description'))) {
            $destinationPath = public_path() . config('dashboard.radio_image');

            if ($fileName = isFileExist($request, $radio, 'image', $destinationPath)) {
                $radio->image = $fileName;
                $radio->update();
            }

            Flash::success($this->updated());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.radio.index');

    }

    public function destroy($id)
    {
        $radio = $this->radioRepository->find($id);

        if($this->radioService->delete($radio)) {

            Flash::success($this->deleted());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->back();

    }

    public function mostlyPlayed() 
    {
        $radio = $this->radioRepository->mostlyPlayed();
       
        return view('admin.radio.mostly-played', compact('radio')); 
    }

}

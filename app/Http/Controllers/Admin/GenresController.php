<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\GenresRepository;
use App\Models\Genres;
use App\Http\Services\GenresService;
use Laracasts\Flash\Flash;
use App\Http\Traits\ResponseTrait;

class GenresController extends Controller
{
    use ResponseTrait;

    protected $genresRepository;

    protected $genresService;

    public function __construct(GenresRepository $genresRepository, GenresService $genresService)
    {
        $this->genresRepository = $genresRepository;

        $this->genresService = $genresService;
    }

    public function index() 
    {
        $image = $this->genresRepository->findAll();
       
        return view('admin.genres.index', compact('image')); 
    }

    public function create(Genres $genres)
    {
        $data = $this->genresRepository->getFormData($genres);

        return view('admin.genres.form', $data);
    }

    public function store(Request $request)
    {
        if($image = $this->genresService->create($request->only('name'))) {
            
            $destinationPath = public_path() . config('dashboard.genres_image');

            if ($fileName = isFileExist($request, $image, 'image', $destinationPath)) {
                $image->image = $fileName;
                $image->update();
            }

            Flash::success($this->success());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.genres.index');
    }

    public function edit($id)
    {
        $genres = $this->genresRepository->find($id);

        $data = $this->genresRepository->getFormData($genres);

        return view('admin.genres.form', $data);
    }

    public function update(Request $request, $id)
    {
        $image = $this->genresRepository->find($id);

        if($genres = $this->genresService->update($image, $request->only('name'))) {

            $destinationPath = public_path() . config('dashboard.genres_image');

            if ($fileName = isFileExist($request, $image, 'image', $destinationPath)) {
                $image->image = $fileName;
                $image->update();
            }

            Flash::success($this->updated());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.genres.index');

    }

    public function destroy($id)
    {
        $genres = $this->genresRepository->find($id);
        $genres->radioList()->detach();
        if($this->genresService->delete($genres)) {

            Flash::success($this->deleted());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->back();

    }

}

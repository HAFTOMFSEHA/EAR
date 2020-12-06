<?php
    use App\Models\App;

    function isFileExist($request, $model, $requestFileName, $destinationPath)
    {
        if ($request->hasFile($requestFileName) && $request->file($requestFileName)->isValid()) {

            $fileName = $model->id;

            if ($file = uploadImage($request->file($requestFileName), $fileName, $destinationPath)) {
                return $file->getFileName();
            }
        }
        return false;
}

    function isFilesExist($requestFileName, $destinationPath)
    {
        $fileName = "";

        if ($file = uploadImage($requestFileName, $fileName, $destinationPath)) {
            return $file->getFileName();
        }
        
        return false;
    }

    function uploadImage(Illuminate\Http\UploadedFile $file, $fileName, $destinationPath)
    {
        $randomNumber = rand ( 10000 , 99999 );

        $filename = date('Y-m-d-h-i-s')."-". $randomNumber ."-". $fileName . '.' . $file->getClientOriginalExtension();

        return $file->move($destinationPath, $filename);
    }

    function getAppDetail() 
    {
        $key = request()->hash;
        return App::where('key', $key)->value('id');
    }

    function baseUrl() 
    {
        return "https://radio.multikhabar.com";
    }



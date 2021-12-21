<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class GeneralController extends Controller
{
    /**
     * upload media
     * @param  Request $request
     * @return mixed
     */
    public function upload(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'file' => 'required',
            'path' => 'required',
        ]);

        if ($validatedData->fails()) {
            return $this->errorStatus($validatedData->errors()->first());
        }

        if ($request->has('old_file')) {
            File::delete($request->old_file);
        }

        return $this->respondWithItem(upload($request->file, $request->path));
    }
}

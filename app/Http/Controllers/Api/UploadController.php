<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UploadController extends Controller
{

    /**
     * @param Request $request
     * @return array
     */
    public function uploadImage(Request $request) {
        try {
            $this->validate($request, ['img_file' => 'required|file|mimes:jpeg,jpg,png,gif,svg,webp|max:4096']);
            $file = $request->file('img_file');
            $path = $file->storeAs('public/images', $file->getClientOriginalName());
            return ['success' => true, 'data' => url(Storage::url($path))];
        } catch (ValidationException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

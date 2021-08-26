<?php


namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends ApiController
{
    /**
     * @param Request $request
     * @return array
     */
    public function delete(Request $request) {

        try {
            $request->validate(['id' => 'required|numeric']);
            $media = Media::query()->find($request->get('id', 0));
            if ($media) {
                $media->delete();
                return $this->apiResponse(true, 'Xóa ok');
            } else {
                Log::error(MediaController::class . '@delete', [$request->all()]);
            }
        } catch (\Exception $e) {
            Log::error(MediaController::class . '@delete', [$e->getMessage(), $e, $request->all()]);
        }
        return $this->apiResponse(false, 'Xóa thất bại');
    }
}

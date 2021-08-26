<?php


namespace App\Http\Controllers\Api;


use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends ApiController
{
    /**
     * @param Request $request
     * @return array
     */
    public function sortOrder(Request $request) {
        parse_str($request->data, $data);

        if (! isset($data['slide'])) {
            return $this->apiResponse(false, 'lỗi data');
        }

        foreach ($data['slide'] as $index => $id) {
            Slide::query()->where('id', $id)->update(['sort' => $index]);
        }
        return $this->apiResponse(true, 'update sort ok');
    }
}

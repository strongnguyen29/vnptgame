<?php


namespace App\Http\Controllers\Api;


use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OptionController extends ApiController
{

    /**
     * @param Request $request
     * @return array
     */
    public function homeProjectsSort(Request $request) {
        return $this->homeItemSort(Option::HOME_PROJECTS, $request->data);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function homePostsSort(Request $request) {
        return $this->homeItemSort(Option::HOME_POSTS, $request->data);
    }

    /**
     * @param $key
     * @param $rawData
     * @return array
     */
    public function homeItemSort($key , $rawData) {
        parse_str($rawData, $data);

        if (! isset($data[$key])) {
            return $this->apiResponse(false, 'lỗi data');
        }

        $optionData = option($key, []);
        foreach ($data[$key] as $sort => $id) {
            Arr::set($optionData, ''.$id . '.sort', $sort);
        }
        $optionData = collect($optionData)->sortBy('sort', SORT_NUMERIC)->toArray();
        option([$key => $optionData]);
        return $this->apiResponse(true, 'update ok', $optionData);
    }
}

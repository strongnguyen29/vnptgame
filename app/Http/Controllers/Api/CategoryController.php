<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends ApiController
{

    public function active(Request $request) {
        try {
            $this->validate($request, ['id' => 'required|numeric', 'active' => 'required|boolean']);
            $category = Category::find($request->id, ['id','active']);
            if ($category) {
                $category->active = $request->active;
                $category->save();
                return $this->apiResponse(true, __('Update ok'));
            }
            return $this->apiResponse(false, 'Không tìm thấy danh mục', null, 404);
        } catch (ValidationException $e) {
            return $this->apiResponse(false, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getTree(Request $request) {
        $request->validate([
            'type' => 'required|string',
            'lang' => 'nullable|string'
        ]);

        $type = $request->get('type');
        $lang = $request->get('lang', app()->getLocale());

        $categories = Category::with([
                'children' => function ($query) use ($type, $lang) {
                    $query->language($lang)->type($type);
                },
                'children.children' => function ($query) use ($type, $lang) {
                    $query->language($lang)->type($type);
                }
            ])
            ->where('parent_id', 0)
            ->orWhereNull('parent_id')
            ->type($type)
            ->language($lang)
            ->get();

        return $this->apiResponse(true, 'ok', $categories);
    }
}

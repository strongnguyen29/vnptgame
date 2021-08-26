<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'lang' => 'nullable|string'
        ]);

        $this->setPageData('Danh mục');

        $lang = $request->get('lang', app()->getLocale());

        $categories = Category::with([
                'children:id,parent_id,title,slug,sort,active',
                'parent:id,title'
            ])
            ->where('parent_id', 0)
            ->orWhereNull('parent_id')
            ->language($lang)
            ->type($request->type)
            ->get();

        return view('backend.pages.category.index', $this->getViewData(['categories' => $categories]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'lang' => 'nullable|string'
        ]);

        $this->setPageData('Danh mục');

        $lang = $request->get('lang', app()->getLocale());
        $categories = Category::getTreeByLanguage($lang);

        return view('backend.pages.category.create', $this->getViewData(['categories' => $categories]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'language' => 'required|string'
        ]);

        $attrs = $request->except('thumb');
        $attrs['slug'] = Str::slug($attrs['slug'] ?? $attrs['title']);

        $category = Category::query()->create($attrs);

        if($category) {

            $category->setImage($request->file('thumb'));

            return redirect()
                ->route('admin.categories.index', ['type' => $attrs['type']])
                ->with('success', 'Tạo ok');
        }

        return back()->withErrors('Tạo thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return '';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->setPageData('Danh mục');

        $categories = Category::getTreeByLanguage($category->language);

        return view('backend.pages.category.edit', $this->getViewData(['categories' => $categories, 'category' => $category]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'nullable|string|min:3|max:255',
            'slug' => 'nullable|string|max:255',
            'language' => 'nullable|string'
        ]);

        $category->fill($request->all());

        if ($category->save()) {

            if ($request->has('thumb')) {
                $category->setImage($request->file('thumb'));
            }

            return redirect()
                ->route('admin.categories.index', ['type' => $category->type])
                ->with('success', 'Cập nhật ok');
        }

        return back()->withErrors('Cập nhật thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return back()->with('success', 'Xóa ok');
        }

        return back()->withErrors('Xóa không thành công');
    }
}

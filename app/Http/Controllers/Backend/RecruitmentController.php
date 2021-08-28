<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Recruitment;
use App\Models\RecruitmentApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecruitmentController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $lang = $request->get('lang', app()->getLocale());

        $recruitments = Recruitment::with(['categories:id,title'])
            ->withCount('applies')
            ->language($lang)
            ->latest('updated_at')
            ->paginate(10, ['id', 'title', 'slug', 'active', 'language', 'updated_at']);

        $this->setPageData('Tin tuyển dụng');

        return view('backend.pages.recruitment.index', $this->getViewData(['recruitments' => $recruitments]));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $lang = $request->get('lang', app()->getLocale());
        $categories = Category::getTreeByLanguage($lang, Category::TYPE_RECRUIT);
        $this->setPageData('Tuyển dụng - Tạo mới');

        return view('backend.pages.recruitment.create', $this->getViewData([
            'categories' => $categories,
            'lang' => $lang,
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'title' => 'required|string|min:3|max:255',
            'slug' => 'required|string|unique:App\Models\Recruitment,slug',
            'desc' => 'required|string',
            'content' => 'required|string',
            'thumb' => 'required|file|mimes:jpeg,jpg,png,gif,svg,webp|max:4096',
            'language' => 'required|string',
            'deadline' => 'required|date_format:Y-m-d',
            'meta_title' => 'nullable|string',
            'meta_desc' => 'nullable|string'
        ]);

        $attrs = $request->except(['thumb', 'categories']);
        $attrs['slug'] = Str::slug($attrs['slug']);
        $attrs['active'] = $request->has('submit_publish');
        $attrs['user_id'] = Auth::id();

        $model = Recruitment::query()->create($attrs);

        if (!$model) {
            return back()->withErrors('Thêm bài mới thất bại');
        }

        $model->categories()->attach($request->categories);

        $model->setImage($request->file('thumb'));

        return redirect()->route('admin.recruitments.index')->with('success', 'Thêm bài ok');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Recruitment $recruitment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Recruitment $recruitment)
    {
        $categories = Category::getTreeByLanguage($recruitment->language, Category::TYPE_RECRUIT);

        $this->setPageData('Bài viết - Sửa bài - ' . Str::words($recruitment->title, 4, '...'));

        return view('backend.pages.recruitment.edit', $this->getViewData(['recruitment' => $recruitment, 'categories' => $categories]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Recruitment $recruitment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Recruitment $recruitment)
    {
        $request->validate([
            'categories' => 'required|array',
            'title' => 'required|string|min:3|max:255',
            'slug' => 'required|string|unique:App\Models\Recruitment,slug,' . $recruitment->id,
            'desc' => 'nullable|string',
            'content' => 'nullable|string',
            'thumb' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp|max:4096',
            'language' => 'nullable|string',
            'deadline' => 'nullable|date_format:Y-m-d',
            'meta_title' => 'nullable|string',
            'meta_desc' => 'nullable|string'
        ]);

        $attrs = $request->except(['thumb', 'categories']);

        $attrs['slug'] = Str::slug($attrs['slug']);

        $recruitment->fill($attrs);

        if (!$recruitment->save()) {
            return back()->withErrors('Cập nhật bài mới thất bại');
        }
        $recruitment->categories()->sync($request->categories);

        if ($request->file('thumb')) {
            $recruitment->setImage($request->file('thumb'));
        }

        return redirect()->route('admin.recruitments.index')->with('success', 'Cập nhật ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Recruitment::destroy($id)) {
            return back()->with('success', 'Xóa ok');
        }

        return back()->withErrors('error', 'Xóa lỗi');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showApplies(Request $request) {
        $applies = RecruitmentApply::query()->latest();

        if ($id = $request->get('recruitment_id', 0)) {
            $applies->where('recruitment_id', $id);
        }

        $applies = $applies->paginate(20);
        $this->setPageData('Danh sách Ứng tuyển');

        return view('backend.pages.recruitment.applies', $this->getViewData([
            'recruitmentApplies' => $applies
        ]));
    }

    /**
     * @param $recruitmentApplyId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadApplyCV($id) {
        $apply = RecruitmentApply::find($id, ['file_cv']);
        $file = storage_path('app/' . $apply->file_cv);
        return response()->download($file);
    }
}

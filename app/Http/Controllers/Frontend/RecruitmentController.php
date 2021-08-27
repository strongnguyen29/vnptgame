<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\MetaTag;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RecruitmentApply;
use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\Contracts\RecruitmentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecruitmentController extends Controller
{
    /**
     * @var RecruitmentInterface
     */
    protected $recruitmentRepo;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepo;

    /**
     * RecruitmentController constructor.
     * @param RecruitmentInterface $recruitmentRepo
     * @param CategoryInterface $categoryRepo
     */
    public function __construct(RecruitmentInterface $recruitmentRepo, CategoryInterface $categoryRepo)
    {
        $this->recruitmentRepo = $recruitmentRepo;
        $this->categoryRepo = $categoryRepo;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) {
        $request->validate(['category_id' => 'nullable|numeric']);

        MetaTag::prependTitle('Tin tuyển dụng');
        MetaTag::setBreadcrumb([['title' => __('Tuyển dụng')]]);

        $recruitments = $this->recruitmentRepo->paginationWithCategory($request->get('category_id', 0));

        $categories = $this->categoryRepo->getAll(Category::TYPE_RECRUIT);

        return view('front.pages.recruitment.index', ['recruitments' => $recruitments, 'categories' => $categories]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($slug) {
        $recruitment = $this->recruitmentRepo->findBySlug($slug);

        MetaTag::prependTitle($recruitment->meta_title ?? $recruitment->title);
        MetaTag::setDesc($recruitment->meta_desc ?? strip_tags($recruitment->desc));

        MetaTag::setBreadcrumb([
            ['title' => __('Tuyển dụng'), 'url' => route('front.recruitments.index')],
            ['title' => $recruitment->title]
        ]);

        MetaTag::set('image', $recruitment->getImageUrl());
        MetaTag::set('type', 'article');

        return view('front.pages.recruitment.detail', ['recruitment' => $recruitment]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeApply(Request $request) {

        $request->validate([
            'recruitment_id' => 'required|numeric',
            'full_name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:8',
            'position' => 'required|string|min:3',
            'file_cv_upload' => 'required|file|mimes:pdf,doc,docx',
            'g-recaptcha-response' => 'required|recaptchav3:recruitment_apply,0.5'
        ]);

        $attrs = $request->except(['file_cv_upload', 'g-recaptcha-response']);
        $file = $request->file('file_cv_upload');
        $attrs['file_cv'] = $file->storeAs('recruitment_applies_cv', $file->getClientOriginalName());

        if (RecruitmentApply::query()->create($attrs)) {
            return back()->with('success', __('Gửi CV thành công, cảm ơn bạn đã ứng tuyển!'));
        }
        return back()->withErrors('Có lỗi xảy ra, hyax thử lại');
    }
}

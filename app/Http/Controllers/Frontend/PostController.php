<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\MetaTag;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\Contracts\PostInterface;
use Illuminate\Http\Request;

class PostController extends FrontendController
{
    /**
     * @var PostInterface
     */
    protected $postRepo;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepo;

    /**
     * PostController constructor.
     * @param PostInterface $postRepo
     * @param CategoryInterface $categoryRepo
     */
    public function __construct(PostInterface $postRepo, CategoryInterface $categoryRepo)
    {
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) {
        $request->validate(['category_id' => 'nullable|numeric']);

        MetaTag::prependTitle('Tin tức');
        MetaTag::setBreadcrumb([['title' => __('Tin tức')]]);

        $posts = $this->postRepo->paginationWithCategory($request->get('category_id', 0));

        $categories = $this->categoryRepo->getAll(Category::TYPE_POST);

        return view('front.pages.post.index', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postDetail($slug) {

        $post = $this->postRepo->findBySlug($slug);
        $post->loadMissing('categories:id,title,slug');
        $relatedPosts = $this->postRepo->getRelatedPosts($post->categories->pluck('id')->toArray());

        MetaTag::prependTitle($post->meta_title ?? $post->title);
        MetaTag::setDesc($post->meta_desc ?? strip_tags($post->desc));

        MetaTag::setBreadcrumb([
            ['title' => __('Tin tức'), 'url' => route('front.posts.index')],
            ['title' => $post->title]
        ]);

        MetaTag::set('image', $post->getImageUrl());
        MetaTag::set('type', 'article');

        return view('front.pages.post.detail', ['post' => $post, 'relatedPosts' => $relatedPosts]);
    }
}

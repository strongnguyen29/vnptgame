<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\MetaTag;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\Contracts\PostInterface;
use Illuminate\Http\Request;

class PostController extends FrontendController
{
    /**
     * @var PostInterface
     */
    protected $postRepo;

    /**
     * PostController constructor.
     * @param PostInterface $postRepo
     */
    public function __construct(PostInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }


    /**
     * @param $rootSlug
     * @param null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($rootSlug, $slug = null) {
        $rootCat = Category::active()->where('slug', $rootSlug)->firstOrFail();
        $categories = Category::active()
            ->type(Category::TYPE_POST)
            ->where('parent_id', $rootCat->id)
            ->sort()
            ->get(['id', 'slug', 'title']);

        $imgUrl = $rootCat->getImageUrl();

        if ($slug) {
            $category = Category::query()->where('slug', $slug)->firstOrFail();
            $posts = $category->posts();

            $breadcrumb = [
                ['title' => $rootCat->title, 'url' => route('front.posts.index', ['rootSlug' => $rootCat->slug])],
                ['title' => $category->title]
            ];

            MetaTag::prependTitle($category->meta_title ?? $rootCat->title . ' | ' . $category->title);
            MetaTag::setDesc($category->meta_desc ?? strip_tags($category->desc));

            if ($category->getImageUrl()) {
                $imgUrl = $category->getImageUrl();
            }
        } else {
            $catIds = $categories->pluck('id')->toArray();
            $catIds[] = $rootCat->id;
            $posts = Post::whereHas('categories', function ($query) use ($catIds) {
                $query->whereIn('id', $catIds);
            });
            $breadcrumb = [['title' => $rootCat->title]];
            MetaTag::prependTitle($rootCat->title);
            MetaTag::set('description', $rootCat->meta_desc ?? strip_tags($rootCat->desc));
        }

        if ($imgUrl) MetaTag::set('image', $imgUrl);

        MetaTag::setBreadcrumb($breadcrumb);

        $posts = $posts->active()->paginate(10, ['id', 'title', 'slug', 'desc', 'created_at']);
        $posts->load('categories:id,title');
        return view('front.pages.post.index', ['posts' => $posts, 'rootCategory' => $rootCat, 'categories' => $categories->toArray(), 'projects' => $posts, 'slug' => $slug]);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postDetail($slug) {

        $post = $this->postRepo->findBySlug($slug);

        MetaTag::prependTitle($post->meta_title ?? $post->title);
        MetaTag::setDesc($post->meta_desc ?? strip_tags($post->desc));

        MetaTag::setBreadcrumb([
            ['title' => __('Tin tức'), 'url' => route('front.posts.index')],
            ['title' => $post->title]
        ]);

        MetaTag::set('image', $post->getImageUrl());
        MetaTag::set('type', 'article');

        return view('front.pages.post.detail', ['post' => $post]);
    }
}

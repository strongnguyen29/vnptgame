<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $lang = $request->get('lang', app()->getLocale());

        $posts = Post::with(['categories:id,title'])
            ->language($lang)
            ->latest('updated_at')
            ->paginate(10, ['id', 'title', 'slug', 'active', 'language', 'updated_at']);

        $this->setPageData('Danh sách bài viết');

        return view('backend.pages.post.index', $this->getViewData(['posts' => $posts]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create(Request $request)
    {
        $lang = $request->get('lang', app()->getLocale());
        $categories = Category::getTreeByLanguage($lang);
        $this->setPageData('Bài viết - Tạo mới');

        return view('backend.pages.post.create', $this->getViewData([
            'categories' => $categories,
            'lang' => $lang,
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'title' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255',
            'desc' => 'nullable|string',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_desc' => 'nullable|string',
            'thumb' => 'required|file|mimes:jpeg,jpg,png,gif,svg,webp|max:4096',
            'tags' => 'nullable|string',
            'language' => 'required|string',
        ]);

        $attrs = $request->except('thumb');
        $attrs['slug'] = Str::slug($attrs['slug']);
        $attrs['active'] = $request->has('submit_publish');
        $attrs['user_id'] = Auth::id();

        if (isset($attrs['tags']) && $attrs['tags']) {
            $attrs['tags'] = explode(',', $attrs['tags']);
        }

        $post = Post::query()->create($attrs);

        if (!$post) {
            return back()->withErrors('Thêm bài mới thất bại');
        }

        $post->categories()->attach($request->categories);

        $post->setImage($request->file('thumb'));
        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài ok');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $categories = Category::getTreeByLanguage($post->language);

        $this->setPageData('Bài viết - Sửa bài - ' . Str::words($post->title, 4, '...'));

        return view('backend.pages.post.edit', $this->getViewData(['post' => $post, 'categories' => $categories]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'categories' => 'required|array',
            'title' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255',
            'desc' => 'nullable|string',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_desc' => 'nullable|string',
            'thumb' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp|max:4096',
            'tags' => 'nullable|string',
            'language' => 'required|string'
        ]);

        $attrs = $request->all();

        $attrs['slug'] = Str::slug($attrs['slug']);

        if (isset($attrs['tags']) && $attrs['tags']) {
            $attrs['tags'] = explode(',', $attrs['tags']);
        }

        $post->fill($attrs);

        if (!$post->save()) {
            return back()->withErrors('Cập nhật bài mới thất bại');
        }

        $post->categories()->sync($request->categories);

        if ($request->file('thumb')) $post->setImage($request->file('thumb'));

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Xóa ok');
    }
}

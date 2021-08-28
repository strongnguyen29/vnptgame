<?php


namespace App\View\Composers\Backend;


use App\Models\Post;
use App\Repositories\Contracts\PostInterface;
use Illuminate\View\View;

class NewPostsComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $posts = Post::with(['author:id,name', 'categories:id,title'])
            ->latest()
            ->take(5)
            ->get(['id', 'title', 'language', 'created_at', 'active']);

        $postAll = Post::all(['id', 'active', 'language']);

        $postVi = $postAll->where('language', 'vi');
        $postEn = $postAll->where('language', 'vi');

        $view->with([
            'posts'=> $posts,
            'totalVi' => $postVi->count(),
            'publicVi' => $postVi->where('active', true)->count(),
            'privateVi' => $postVi->where('active', false)->count(),
            'totalEn' => $postEn->count(),
            'publicEn' => $postEn->where('active', true)->count(),
            'privateEn' => $postEn->where('active', false)->count()
        ]);
    }
}

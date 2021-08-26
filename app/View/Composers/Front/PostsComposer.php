<?php


namespace App\View\Composers\Front;


use App\Repositories\Contracts\PostInterface;
use Illuminate\View\View;

class PostsComposer
{
    /**
     * @var PostInterface
     */
    protected $postRepo;

    /**
     * PostsComposer constructor.
     * @param PostInterface $postRepo
     */
    public function __construct(PostInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }


    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $posts = $this->postRepo->getLatestPosts();

        $view->with('posts', $posts);
    }
}

<?php


namespace App\Repositories\Contracts;


use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostInterface
{
    /**
     * Lấy bài đăng gần nhất
     *
     * @param $limit int limit
     * @return Collection
     */
    public function getLatestPosts($limit = 10);

    /**
     * Get post by slug
     *
     * @param $slug string
     * @return Post|null
     */
    public function findBySlug($slug);
}

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

    /**
     * Tin lien quan
     *
     * @param int $limit
     * @param $categoryIds
     * @return Collection
     */
    public function getRelatedPosts($categoryIds, $limit = 6);

    /**
     * Phan trang tin tuc
     *
     * @param int $categoryId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginationWithCategory($categoryId = 0);
}

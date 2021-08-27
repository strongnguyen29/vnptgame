<?php


namespace App\Repositories\Contracts;


use App\Models\Recruitment;

interface RecruitmentInterface
{

    /**
     * Phan trang tin tuyen dung
     *
     * @param int $categoryId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginationWithCategory($categoryId = 0);

    /**
     * Get post by slug
     *
     * @param $slug string
     * @return Recruitment|null
     */
    public function findBySlug($slug);
}

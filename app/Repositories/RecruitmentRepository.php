<?php


namespace App\Repositories;


use App\Models\Recruitment;
use App\Repositories\Contracts\RecruitmentInterface;

class RecruitmentRepository extends BaseRepository implements RecruitmentInterface
{

    /**
     * Get modal name
     *
     * @return string
     */
    protected function getModel()
    {
        return Recruitment::class;
    }

    /**
     * Get new query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() {
        return $this->model->newQuery()
            ->language(app()->getLocale())
            ->active();
    }

    /**
     * Phan trang tin tuyen dung
     *
     * @param int $categoryId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginationWithCategory($categoryId = 0) {
        $query = $this->query();
        if ($categoryId) {
            $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

        return $query->paginate(6, ['id', 'title', 'slug', 'desc', 'active', 'language', 'deadline', 'created_at']);
    }

    /**
     * Get post by slug
     *
     * @param $slug string
     * @return Recruitment|null
     */
    public function findBySlug($slug)
    {
        return $this->query()->slug($slug)->firstOrFail();
    }
}

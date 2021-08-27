<?php


namespace App\Repositories;


use App\Models\Post;
use App\Repositories\Contracts\PostInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostRepository extends BaseRepository implements PostInterface
{
    const CACHE_KEY = 'post_';
    const CACHE_TIME = 3600; // 1h

    protected function getModel()
    {
        return Post::class;
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
     * Lấy bài đăng gần nhất
     *
     * @param $limit int limit
     * @return Collection
     */
    public function getLatestPosts($limit = 10)
    {
        $key = $this->getCacheKey('latest_' . $limit);

        return Cache::remember($key, self::CACHE_TIME, function () use ($limit) {
            return $this->query()->latest()->take($limit)->get($this->getColumnNameLite());
        });
    }

    /**
     * @param $str
     * @return string
     */
    protected function getCacheKey($str) {
        return app()->getLocale() . '_' . self::CACHE_TIME . Str::slug($str);
    }

    /**
     * Get post by slug
     *
     * @param $slug string
     * @return Post|null
     */
    public function findBySlug($slug)
    {
        return $this->query()->slug($slug)->firstOrFail();
    }

    /**
     * Tin lien quan
     *
     * @param int $limit
     * @param $categoryIds
     * @return Collection
     */
    public function getRelatedPosts($categoryIds, $limit = 6)
    {
        return $this->query()
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('id', $categoryIds);
            })
            ->latest()
            ->take($limit)
            ->get($this->getColumnNameLite());
    }

    /**
     * Phan trang tin tuc
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

        return $query->paginate(18, $this->getColumnNameLite());
    }

    /**
     * Lay cac thuoc tinh cho danh sach dai
     *
     * @return string[]
     */
    protected function getColumnNameLite() {
        return ['id', 'title', 'slug', 'desc', 'active', 'language', 'created_at'];
    }
}

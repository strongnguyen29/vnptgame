<?php


namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Contracts\CategoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryInterface
{

    /**
     * Get modal name
     *
     * @return string
     */
    protected function getModel()
    {
        return Category::class;
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
     * @param $type
     * @return Collection
     */
    public function getAll($type)
    {
        return $this->query()->type($type)->get(['id', 'title', 'slug']);
    }
}

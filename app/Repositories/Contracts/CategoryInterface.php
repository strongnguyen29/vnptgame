<?php


namespace App\Repositories\Contracts;


use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    /**
     * @param $type
     * @return Collection
     */
    public function getAll($type);
}

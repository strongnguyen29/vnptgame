<?php


namespace App\Repositories\Contracts;


interface BaseRepositoryInterface
{

    /**
     * Get new query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();


}

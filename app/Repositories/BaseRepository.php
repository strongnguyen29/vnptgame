<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get modal name
     *
     * @return string
     */
    abstract protected function getModel();

    /**
     * Set model
     */
    protected function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get new query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() {
        return $this->model->newQuery();
    }

}

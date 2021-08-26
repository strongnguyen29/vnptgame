<?php

namespace App\Observers;

use App\Jobs\CreateSiteMapJob;
use Illuminate\Database\Eloquent\Model;

class CreateSiteMapObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param Model $model
     * @return void
     */
    public function created(Model $model)
    {
        dispatch(new CreateSiteMapJob());
    }

    /**
     * Handle the User "updated" event.
     *
     * @param Model $model
     * @return void
     */
    public function updated(Model $model)
    {
        dispatch(new CreateSiteMapJob());
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Model $model
     * @return void
     */
    public function deleted(Model $model)
    {
        dispatch(new CreateSiteMapJob());
    }
}

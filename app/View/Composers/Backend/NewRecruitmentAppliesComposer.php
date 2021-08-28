<?php


namespace App\View\Composers\Backend;


use App\Models\Post;
use App\Models\Recruitment;
use App\Models\RecruitmentApply;
use App\Repositories\Contracts\PostInterface;
use Illuminate\View\View;

class NewRecruitmentAppliesComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $applies = RecruitmentApply::latest()
            ->take(5)
            ->get();

        $view->with([
            'applies'=> $applies
        ]);
    }
}

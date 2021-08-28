<?php


namespace App\View\Composers\Backend;


use App\Models\Post;
use App\Models\Recruitment;
use App\Repositories\Contracts\PostInterface;
use Illuminate\View\View;

class NewRecruitmentComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $recruitments = Recruitment::with(['author:id,name', 'categories:id,title'])
            ->latest()
            ->take(5)
            ->get(['id', 'title', 'language', 'created_at', 'active', 'deadline']);

        $postAll = Recruitment::all(['id', 'active', 'language']);

        $postVi = $postAll->where('language', 'vi');
        $postEn = $postAll->where('language', 'vi');

        $view->with([
            'recruitments'=> $recruitments,
            'totalVi' => $postVi->count(),
            'publicVi' => $postVi->where('active', true)->count(),
            'privateVi' => $postVi->where('active', false)->count(),
            'totalEn' => $postEn->count(),
            'publicEn' => $postEn->where('active', true)->count(),
            'privateEn' => $postEn->where('active', false)->count()
        ]);
    }
}

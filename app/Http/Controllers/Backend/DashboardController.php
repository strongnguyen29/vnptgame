<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class DashboardController extends BackendController
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) {
        $this->setPageData('Dashboard');
        return view('backend.pages.dashboard.index', $this->getViewData());
    }
}

<?php


namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class BackendController extends Controller
{

    /**
     * @var array
     */
    protected $pageData = [];

    /**
     * BackendController constructor.
     * @param array $pageData
     */
    public function __construct()
    {
        Paginator::useBootstrap();
    }

    /**
     * @param string $title
     * @param array $breadcrumb
     */
    protected function setPageData($title = 'Page title', $breadcrumb = []): void
    {
        $breadcrumb[] = ['title' => $title];

        $this->pageData = [
            'title' => $title,
            'breadcrumb' => $breadcrumb
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getViewData($data = [])
    {
        $data['pageData'] = $this->pageData;
        return $data;
    }
}

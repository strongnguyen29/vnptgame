<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;

class PageCategoryList extends Component
{
    public $routeName, $routeData, $categories, $currentSlug;

    /**
     * PageCategoryList constructor.
     * @param $categories
     * @param $routeName
     * @param array $routeData
     * @param string $currentSlug
     */
    public function __construct($categories, $routeName, $routeData = [], $currentSlug = '')
    {
        $this->categories = $categories;
        $this->currentSlug = $currentSlug;
        $this->routeName = $routeName;
        $this->routeData = $routeData;

    }

    public function getRouteData($slug) {
        $route = $this->routeData;
        $route['slug'] = $slug;
        return $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.front.page-category-list');
    }
}

<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;

class TagList extends Component
{
    public $tags;

    /**
     * Create a new component instance.
     *
     * @param $tags
     */
    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.front.tag-list');
    }
}

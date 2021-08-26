<?php

namespace App\View\Components\Backend\Button;

use Illuminate\View\Component;

class Actions extends Component
{
    public $model;
    public $routeData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model, $routeData)
    {
        $this->model = $model;
        $this->routeData = $routeData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.button.actions');
    }
}

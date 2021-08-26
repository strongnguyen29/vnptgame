<?php

namespace App\View\Components\Backend\Button;

use Illuminate\View\Component;

class Edit extends Component
{
    public $routeName;
    public $routeData;
    public $btnClass;
    public $btnText;

    /**
     * DelBtn constructor.
     *
     * @param $routeName
     * @param $routeData
     * @param $btnClass
     * @param $btnText
     */
    public function __construct($routeName, $routeData = [], $btnClass = '', $btnText = null)
    {
        $this->routeName = $routeName;
        $this->routeData = $routeData;
        $this->btnClass = $btnClass;
        $this->btnText = $btnText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.button.edit');
    }
}

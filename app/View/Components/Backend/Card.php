<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;

class Card extends Component
{
    public $type;

    public $title;

    public $bodyClass;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param null $title
     */
    public function __construct($type = 'primary', $title = null, $bodyClass = '')
    {
        $this->type = $type;
        $this->title = $title;
        $this->bodyClass = $bodyClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.card');
    }
}

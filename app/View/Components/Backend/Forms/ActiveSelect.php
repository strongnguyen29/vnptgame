<?php

namespace App\View\Components\Backend\Forms;

use Illuminate\View\Component;

class ActiveSelect extends Component
{
    public $checked;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($checked)
    {
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.active-select');
    }
}

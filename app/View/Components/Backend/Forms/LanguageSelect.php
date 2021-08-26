<?php

namespace App\View\Components\Backend\Forms;

use Illuminate\View\Component;

class LanguageSelect extends Component
{
    public $value, $readonly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value, $readonly = false)
    {
        $this->value = $value;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.language-select');
    }
}

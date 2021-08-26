<?php

namespace App\View\Components\Backend\Forms;

use Illuminate\View\Component;

class Editor extends Component
{
    public $inputId, $label, $name, $value, $inputClass, $helpText, $required;

    /**
     * Input constructor.
     * @param $name
     * @param string $inputId
     * @param string $label
     * @param string $value
     * @param string $helpText
     * @param bool $required
     */
    public function __construct($name, $inputId = '', $label = '', $value = '',  $helpText = '', $required = false)
    {
        $this->inputId = $inputId;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->helpText = $helpText;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.editor');
    }
}

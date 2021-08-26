<?php

namespace App\View\Components\Backend\Forms;

use Illuminate\View\Component;

class InputUpload extends Component
{
    public $inputId, $label, $name, $inputClass, $helpText, $required, $multi, $accept;

    /**
     * Input constructor.
     * @param $name
     * @param string $inputId
     * @param string $label
     * @param string $helpText
     * @param string $accept
     * @param bool $required
     * @param bool $multi
     */
    public function __construct($name, $inputId = '', $label = '',  $helpText = '', $accept = '', $required = false, $multi = false)
    {
        $this->inputId = $inputId;
        $this->label = $label;
        $this->name = $name;
        $this->multi = $multi;
        $this->helpText = $helpText;
        $this->required = $required;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.input-upload');
    }
}

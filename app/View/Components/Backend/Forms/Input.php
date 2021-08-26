<?php

namespace App\View\Components\Backend\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $inputId, $label, $type, $name, $value, $placeholder, $inputClass, $helpText, $required, $readonly;

    /**
     * Input constructor.
     * @param $name
     * @param string $label
     * @param string $inputId
     * @param string $type
     * @param string $value
     * @param string $placeholder
     * @param string $inputClass
     * @param string $helpText
     * @param bool $required
     * @param bool $readonly
     */
    public function __construct($name, $label = '', $inputId = null, $type = 'text', $value = '',
                                $placeholder = '', $inputClass = '', $helpText = '', $required = false, $readonly = false)
    {
        $this->inputId = $inputId;
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->inputClass = $inputClass;
        $this->helpText = $helpText;
        $this->required = $required;
        $this->readonly = $readonly;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.input');
    }
}

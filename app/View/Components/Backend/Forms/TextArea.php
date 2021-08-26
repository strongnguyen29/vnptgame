<?php

namespace App\View\Components\Backend\Forms;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $label, $name, $value, $placeholder, $inputClass, $helpText, $required, $readonly, $rows;

    /**
     * Input constructor.
     * @param $name
     * @param string $label
     * @param string $value
     * @param string $placeholder
     * @param string $inputClass
     * @param string $helpText
     * @param bool $required
     * @param bool $readonly
     * @param int $rows
     */
    public function __construct($name, $label = '', $value = '', $placeholder = '', $inputClass = '', $helpText = '',
                                $required = false, $readonly = false, $rows = 3)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->inputClass = $inputClass;
        $this->helpText = $helpText;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.text-area');
    }
}

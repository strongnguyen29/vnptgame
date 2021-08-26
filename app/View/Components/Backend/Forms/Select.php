<?php

namespace App\View\Components\Backend\Forms;

use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class Select extends Component
{
    public $selectId, $label, $name, $value, $inputClass, $helpText, $required, $readonly, $multi, $options;

    /**
     * Input constructor.
     * @param string $name
     * @param array $options
     * @param string $label
     * @param string $selectId
     * @param string $value
     * @param string $inputClass
     * @param string $helpText
     * @param bool $required
     * @param bool $readonly
     * @param bool $multi
     */
    public function __construct($name, $options, $label = '', $selectId = '', $value = '',
                                $inputClass = '', $helpText = '', $required = false, $readonly = false, $multi = false)
    {
        $this->name = $name;
        $this->options = $options;
        $this->selectId = $selectId;
        $this->label = $label;
        $this->value = $value;
        $this->inputClass = $inputClass;
        $this->helpText = $helpText;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->multi = $multi;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.select');
    }
}

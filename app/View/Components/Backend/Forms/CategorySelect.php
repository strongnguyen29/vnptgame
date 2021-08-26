<?php

namespace App\View\Components\Backend\Forms;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class CategorySelect extends Component
{
    public $label, $name, $value, $optionDefault;
    public $htmlOptions = '';
    public $ml = 0;

    /**
     * CategorySelect constructor.
     * @param $name
     * @param array $categories
     * @param string $label
     * @param int $value
     * @param bool $optionDefault
     */
    public function __construct($name, $categories = [], $label = 'Danh mục cha', $value = 0, $optionDefault = true)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->optionDefault = $optionDefault;

        $this->renderOptions($categories);

    }

    /**
     * @param $categories
     */
    public function renderOptions($categories) {

        foreach ($categories as $category) {
            $this->htmlOptions .= sprintf('<option value="%s" %s>%s %s</option>',
                $category->id, $this->selected($category), $this->renderSlash(), $category->title);

            if ($category->children && $category->children->count() > 0) {
                $this->ml += 2;
                $this->renderOptions($category->children);
                $this->ml -= 2;
            }
        }

    }

    /**
     * @param $category Category
     * @return string
     */
    public function selected($category) {
        return $this->value == $category->id ? 'selected' : '';
    }

    public function renderSlash() {
        $slash = '';
        for ($i = 1; $i <= $this->ml; $i++) {
            $slash .= '-';
        }
        return $slash;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.category-select');
    }
}

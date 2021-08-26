<?php

namespace App\View\Components\Backend\Forms;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryCheckbox extends Component
{
    public $values;

    public $htmlItems = '';

    public $ml = 0;

    /**
     * CategoryCheckbox constructor.
     * @param array $categories
     * @param array $values
     */
    public function __construct($categories = [], $values = [])
    {
        $this->values = $values;

        $this->renderItemsHtml($categories);
    }

    /**
     * @param $categories
     */
    public function renderItemsHtml($categories) {

        foreach ($categories as $category) {

            $this->htmlItems .= view(
                'components.backend.forms.category-checkbox-item',
                ['ml' => $this->ml, 'category' => $category, 'values' => $this->values]
            )->render();

            if ($category->children && $category->children->count() > 0) {
                $this->ml += 15;
                $this->renderItemsHtml($category->children);
                $this->ml -= 15;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.backend.forms.category-checkbox');
    }
}

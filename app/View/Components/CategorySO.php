<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategorySO extends Component
{
    public $category;
    public $parentId;
    /**
     * Create a new component instance.
     */
    public function __construct($category,$parentId)
    {
        $this->category = $category;
        $this->parentId = $parentId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-s-o',["category" => $this->category,"parentId" => $this->parentId]);
    }
}

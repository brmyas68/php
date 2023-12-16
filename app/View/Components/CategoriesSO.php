<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoriesSO extends Component
{
    public $categories;
    public $parentId;
    /**
     * Create a new component instance.
     */
    public function __construct($categories,$parentId)
    {
        $this->categories = $categories;
        $this->parentId = $parentId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories-s-o',["categories" => $this->categories,"parentId" => $this->parentId]);
    }
}

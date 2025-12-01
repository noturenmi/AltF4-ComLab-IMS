<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class categoryCard extends Component
{
    public int $id;

    public Collection $category;

    /**
     * Create a new component instance.
     */
    public function __construct(
        int $id,
        Collection $category
    ) {
        $this->id = $id;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-card');
    }
}

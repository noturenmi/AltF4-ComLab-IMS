<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class itemRow extends Component
{
    public int $id;

    public Collection $item;

    public Collection $categories;

    /**
     * Create a new component instance.
     */
    public function __construct(
        int $id,
        Collection $item,
        Collection $categories,
    ) {
        $this->id = $id;
        $this->item = $item;
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-row');
    }
}

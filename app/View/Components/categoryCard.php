<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class categoryCard extends Component
{
    public int $id;

    public string $name;

    public int $itemCount;

    /**
     * Create a new component instance.
     */
    public function __construct(int $id, string $name, int $itemCount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->itemCount = $itemCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-card');
    }
}

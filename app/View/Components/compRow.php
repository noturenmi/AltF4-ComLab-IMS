<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class compRow extends Component
{
    public int $id;

    public Collection $computer;

    public Collection $laboratories;

    /**
     * Create a new component instance.
     */
    public function __construct(
        int $id,
        Collection $computer,
        Collection $laboratories
    ) {
        $this->id = $id;
        $this->computer = $computer;
        $this->laboratories = $laboratories;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comp-row');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class labDisplay extends Component
{
    public int $id;

    public Collection $laboratory;

    /**
     * Create a new component instance.
     */
    public function __construct(
        int $id,
        Collection $laboratory
    ) {
        $this->id = $id;
        $this->laboratory = $laboratory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lab-display');
    }
}

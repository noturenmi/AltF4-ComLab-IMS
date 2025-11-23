<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dashboardCounter extends Component
{
    public string $label;

    public int $counter;

    public string $color;

    public string $bg;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label, int $counter, string $color, string $bg)
    {
        $this->label = $label;
        $this->counter = $counter;
        $this->color = $color;
        $this->bg = $bg;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-counter');
    }
}

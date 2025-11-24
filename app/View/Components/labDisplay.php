<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class labDisplay extends Component
{
    public int $id;

    public string $label;

    public string $status;

    public int $computerCount;

    public int $itemCount;

    /**
     * Create a new component instance.
     */
    public function __construct(int $id, string $label, string $status, int $computerCount, int $itemCount)
    {
        $this->id = $id;
        $this->$label = $label;
        $this->$status = $status;
        $this->$computerCount = $computerCount;
        $this->$itemCount = $itemCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lab-display');
    }
}

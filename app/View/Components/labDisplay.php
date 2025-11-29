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

    public int $activeCount;

    public int $inactiveCount;

    public int $maintenanceCount;

    /**
     * Create a new component instance.
     */
    public function __construct(
        int $id,
        string $label,
        string $status,
        int $computerCount,
        int $activeCount,
        int $inactiveCount,
        int $maintenanceCount,
    ) {
        $this->id = $id;
        $this->$label = $label;
        $this->$status = $status;
        $this->$computerCount = $computerCount;
        $this->$activeCount = $activeCount;
        $this->$inactiveCount = $inactiveCount;
        $this->$maintenanceCount = $maintenanceCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lab-display');
    }
}

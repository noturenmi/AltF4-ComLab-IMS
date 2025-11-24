<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class compRow extends Component
{
    public int $id;

    public string $name;

    public string $lab;

    public string $model;

    public string $status;

    public string $assignedDate;

    /**
     * Create a new component instance.
     */
    public function __construct(int $id, string $name, string $lab, string $model, string $status, string $assignedDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lab = $lab;
        $this->model = $model;
        $this->status = $status;
        $this->assignedDate = $assignedDate;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comp-row');
    }
}

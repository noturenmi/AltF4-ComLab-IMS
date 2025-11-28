<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class itemRow extends Component
{
    public int $id;

    public string $category;

    public int $quantity;

    public string $status;

    /**
     * Create a new component instance.
     */
    public function __construct(int $id, string $category, int $quantity, string $status)
    {
        $this->id = $id;
        $this->category = $category;
        $this->quantity = $quantity;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-row');
    }
}

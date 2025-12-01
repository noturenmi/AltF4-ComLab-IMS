<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class transactRow extends Component
{
    public int $id;

    public Collection $transaction;

    /**
     * Create a new component instance.
     */
    public function __construct(
        int $id,
        Collection $transaction
    ) {
        $this->id = $id;
        $this->transaction = $transaction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transact-row');
    }
}

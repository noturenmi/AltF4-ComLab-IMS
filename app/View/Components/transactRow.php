<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class transactRow extends Component
{
    public int $id;

    public string $user;

    public string $action;

    public string $timestamp;

    public string $desc;

    /**
     * Create a new component instance.
     */
    public function __construct(int $id, string $user, string $action, string $timestamp, string $desc)
    {
        $this->id = $id;
        $this->user = $user;
        $this->action = $action;
        $this->timestamp = $timestamp;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transact-row');
    }
}

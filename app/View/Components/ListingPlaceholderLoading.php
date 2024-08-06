<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListingPlaceholderLoading extends Component
{
    /**
     * Create a new component instance.
     */
    public string $view;
    public function __construct($view = 'grid')
    {
        $this->view = $view;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listing-placeholder-loading',[
            'view' => $this->view,
        ]);
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListingGrid extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $listing, public $thumb = 'default', public $class = 'card card-light card-hover h-100')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listing-grid');
    }
}

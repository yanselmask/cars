<?php

namespace App\View\Components;

use App\Models\Listing;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListingShort extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $listings)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listing-short');
    }
}

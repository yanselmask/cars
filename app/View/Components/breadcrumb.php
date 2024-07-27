<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */
    public $class;
    public $routes;
    public $active;
    public function __construct($class = 'mb-4 pt-md-3',  $routes = [], $active = 'Home')
    {
        $this->class = $class;
        $this->routes = $routes;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}

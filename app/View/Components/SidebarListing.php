<?php

namespace App\View\Components;

use App\Models\Color;
use App\Models\Condition;
use App\Models\DriveType;
use App\Models\Feature;
use App\Models\FuelType;
use App\Models\ListedBy;
use App\Models\Listing;
use App\Models\Make;
use App\Models\MakeModel;
use App\Models\Transmission;
use App\Models\Type;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarListing extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-listing', [
            'condition' => Condition::select('id', 'name')->get(),
            'types' => Type::select('id', 'name')->get(),
            'makes' => Make::select('id', 'name')->has('listings')->get(),
            'drives' => DriveType::select('id', 'name')->get(),
            'fuels' => FuelType::select('id', 'name')->get(),
            'transmissions' => Transmission::select('id', 'name')->get(),
            'colors' => Color::select('id', 'name')->get(),
            'sellers' => ListedBy::select('id', 'name')->get(),
            'models' => request()->query('make') ? MakeModel::where('make_id', request()->query('make'))->get() : [],
            'locations' => Listing::select('city')
                ->whereNotNull('city')
                ->distinct()
                ->get(),
            'features' => Feature::select('id', 'name')->get()->mapWithKeys(fn ($f) => [$f->id => $f->name])
        ]);
    }
}

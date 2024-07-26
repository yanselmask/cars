<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('Users'), \App\Models\User::count()),
            Stat::make(__('Listing'), \App\Models\Listing::count()),
            Stat::make(__('Pages'), \App\Models\Page::count()),
            Stat::make(__('Posts'), \App\Models\Post::count()),
            Stat::make(__('Conditions'), \App\Models\Condition::count()),
            Stat::make(__('Types'), \App\Models\Type::count()),
            Stat::make(__('Makes'), \App\Models\Make::count()),
            Stat::make(__('Models'), \App\Models\MakeModel::count()),
            Stat::make(__('OfferTypes'), \App\Models\OfferType::count()),
            Stat::make(__('DriveTypes'), \App\Models\DriveType::count()),
            Stat::make(__('Transmissions'), \App\Models\Transmission::count()),
            Stat::make(__('Fuel'), \App\Models\FuelType::count()),
            Stat::make(__('Engines'), \App\Models\Engine::count()),
            Stat::make(__('Colors'), \App\Models\Engine::count()),
            Stat::make(__('Features'), \App\Models\Feature::count()),
            Stat::make(__('ListedBy'), \App\Models\ListedBy::count()),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->can('view users overview');
    }
}

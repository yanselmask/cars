<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardCardVendor extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(__('Approved Listing'), auth()->user()->listings()->approved()->count()),
            Stat::make(__('Pending Listing'), auth()->user()->listings()->pending()->count()),
            Stat::make(__('Rejected Listing'), auth()->user()->listings()->rejected()->count()),
            Stat::make(__('Current Subscription Plan'), auth()->user()->sparkPlan()?->name ?? __('No Plan')),
            Stat::make(__('Credits Restants'), auth()->user()->credits),
            Stat::make(__('Features Restants'), auth()->user()->credits_features)
        ];
    }
}

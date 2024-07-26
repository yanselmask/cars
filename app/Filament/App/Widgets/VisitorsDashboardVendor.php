<?php

namespace App\Filament\App\Widgets;

use App\Models\Listing;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\Builder;
use Shetabit\Visitor\Models\Visit;

class VisitorsDashboardVendor extends ChartWidget
{
    protected static ?string $heading = 'Visitors';

    protected int | string | array $columnSpan = 'full';

    public ?string $filter = 'month';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $listing = Trend::query(
            Visit::query()
                ->where('visitable_type', Listing::class)
                ->whereIn('visitable_id', auth()->user()->listings()->pluck('id'))
        )
            ->between(
                start: match ($activeFilter) {
                    'today' => now()->startOfDay(),
                    'week' => now()->startOfWeek(),
                    'month' => now()->startOfMonth(),
                    'year' => now()->startOfYear()
                },
                end: match ($activeFilter) {
                    'today' => now()->endOfDay(),
                    'week' => now()->endOfWeek(),
                    'month' => now()->endOfMonth(),
                    'year' => now()->endOfYear()
                },
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => __('Visitors'),
                    'data' => $listing->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],

            ],
            'labels' => $listing->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    public function getDescription(): ?string
    {
        return 'The number of listing published.';
    }
}

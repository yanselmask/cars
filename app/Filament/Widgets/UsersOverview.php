<?php

namespace App\Filament\Widgets;

use App\Models\Listing;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class UsersOverview extends ChartWidget
{
    protected static ?string $heading = 'Overview';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $users = Trend::model(User::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        $listing = Trend::model(Listing::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        $posts = Trend::model(Post::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        $pages = Trend::model(Page::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => __('Users'),
                    'data' => $users->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
                [
                    'label' => __('Listing'),
                    'data' => $listing->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#FF6384',
                    'borderColor' => '#FF9BB3',
                ],
                [
                    'label' => __('Posts'),
                    'data' => $posts->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#4BC0C0',
                    'borderColor' => '#A7F3F3',
                ],
                [
                    'label' => __('Pages'),
                    'data' => $pages->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#FFCE56',
                    'borderColor' => '#FFE082',
                ],

            ],
            'labels' => $users->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

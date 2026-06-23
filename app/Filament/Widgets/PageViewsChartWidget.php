<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class PageViewsChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected ?string $heading = 'Daily Page Views (Last 30 Days)';

    protected function getData(): array
    {
        $data = collect(range(29, 0))->mapWithKeys(function ($daysAgo) {
            $date = today()->subDays($daysAgo)->toDateString();
            return [$date => 0];
        });

        $views = PageView::where('created_at', '>=', today()->subDays(30))
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $data = $data->merge($views);

        return [
            'datasets' => [
                [
                    'label' => 'Page Views',
                    'data' => $data->values()->toArray(),
                    'borderColor' => '#3b82f6',
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => $data->keys()->map(fn ($date) => date('M d', strtotime($date)))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

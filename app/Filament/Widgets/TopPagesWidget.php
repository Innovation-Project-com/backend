<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class TopPagesWidget extends ChartWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    protected ?string $heading = 'Top 10 Visited Pages';

    protected function getData(): array
    {
        $topPages = PageView::selectRaw('page_url, count(*) as count')
            ->groupBy('page_url')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Views',
                    'data' => $topPages->pluck('count')->toArray(),
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => $topPages->pluck('page_url')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

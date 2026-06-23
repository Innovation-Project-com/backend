<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class TrafficSourceWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Traffic Sources';

    protected function getData(): array
    {
        $views = PageView::select('referer')->get();
        $sources = [
            'Direct' => 0,
            'Organic Search' => 0,
            'Social Media' => 0,
            'Referral' => 0,
        ];

        foreach ($views as $view) {
            $referer = $view->referer;
            if (empty($referer)) {
                $sources['Direct']++;
            } elseif (preg_match('/google|bing|yahoo|duckduckgo/i', $referer)) {
                $sources['Organic Search']++;
            } elseif (preg_match('/linkedin|twitter|facebook|instagram|t\.co|youtube/i', $referer)) {
                $sources['Social Media']++;
            } else {
                $sources['Referral']++;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Traffic Source',
                    'data' => array_values($sources),
                    'backgroundColor' => [
                        '#3b82f6', // Direct - Blue
                        '#10b981', // Organic - Green
                        '#8b5cf6', // Social - Purple
                        '#64748b', // Referral - Slate
                    ],
                ],
            ],
            'labels' => array_keys($sources),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

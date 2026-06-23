<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadsByStatusWidget extends ChartWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Leads by Pipeline Status';

    protected function getData(): array
    {
        $leads = Lead::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $statuses = [
            'new' => 'New Lead',
            'contacted' => 'Contacted',
            'qualified' => 'Qualified',
            'proposal_sent' => 'Proposal Sent',
            'closed' => 'Closed (Won)',
            'archived' => 'Archived (Lost)',
        ];

        $data = collect($statuses)->mapWithKeys(function ($label, $key) use ($leads) {
            return [$key => $leads->get($key, 0)];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        '#ef4444', // New - Red
                        '#f59e0b', // Contacted - Yellow
                        '#3b82f6', // Qualified - Blue
                        '#06b6d4', // Proposal Sent - Cyan
                        '#10b981', // Closed - Green
                        '#64748b', // Archived - Slate
                    ],
                ],
            ],
            'labels' => $data->keys()->map(fn ($key) => $statuses[$key])->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

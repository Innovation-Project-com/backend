<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use App\Models\PageView;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // 1. Page views
        $todayViews = PageView::whereDate('created_at', today())->count();
        $yesterdayViews = PageView::whereDate('created_at', today()->subDay())->count();
        
        $viewsDiff = $todayViews - $yesterdayViews;
        $viewsTrend = $yesterdayViews > 0 ? round(($viewsDiff / $yesterdayViews) * 100, 2) : 0;
        $viewsIcon = $viewsTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $viewsColor = $viewsTrend >= 0 ? 'success' : 'danger';
        $viewsDescription = $viewsTrend >= 0 
            ? "+{$viewsTrend}% from yesterday" 
            : "{$viewsTrend}% from yesterday";

        // 2. Unique visitors
        $uniqueVisitors = PageView::distinct('session_id')->count('session_id');
        $uniqueVisitorsToday = PageView::whereDate('created_at', today())->distinct('session_id')->count('session_id');

        // 3. Leads
        $totalLeads = Lead::count();
        $leadsThisMonth = Lead::where('created_at', '>=', now()->startOfMonth())->count();
        $leadsLastMonth = Lead::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(), 
            now()->subMonth()->endOfMonth()
        ])->count();
        $leadsDiff = $leadsThisMonth - $leadsLastMonth;
        $leadsTrend = $leadsLastMonth > 0 ? round(($leadsDiff / $leadsLastMonth) * 100, 2) : 0;
        $leadsColor = $leadsTrend >= 0 ? 'success' : 'danger';
        $leadsDescription = $leadsTrend >= 0
            ? "+{$leadsTrend}% from last month"
            : "{$leadsTrend}% from last month";

        // 4. Conversion Rate (last 30 days)
        $visitors30Days = PageView::where('created_at', '>=', now()->subDays(30))
            ->distinct('session_id')
            ->count('session_id');
        $leads30Days = Lead::where('created_at', '>=', now()->subDays(30))->count();
        
        $conversionRate = $visitors30Days > 0 
            ? round(($leads30Days / $visitors30Days) * 100, 2) 
            : 0;

        return [
            Stat::make('Total Page Views Today', $todayViews)
                ->description($viewsDescription)
                ->descriptionIcon($viewsIcon)
                ->color($viewsColor),
            Stat::make('Unique Visitors (All-time)', $uniqueVisitors)
                ->description("Today: {$uniqueVisitorsToday} unique users")
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            Stat::make('Total Leads', $totalLeads)
                ->description($leadsDescription)
                ->descriptionIcon('heroicon-m-envelope')
                ->color($leadsColor),
            Stat::make('Conversion Rate (30 Days)', "{$conversionRate}%")
                ->description('Unique visitors to lead submissions ratio')
                ->descriptionIcon('heroicon-m-chart-bar-square')
                ->color('info'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Solution;
use App\Models\PageView;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PopularSolutionsWidget extends TableWidget
{
    protected static ?string $heading = 'Popular Solutions';

    protected static ?int $sort = 7;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Solution::query()
                    ->select('solutions.*')
                    ->selectSub(
                        PageView::query()
                            ->whereColumn('referrable_id', 'solutions.id')
                            ->where('referrable_type', Solution::class)
                            ->selectRaw('count(*)'),
                        'views_count'
                    )
                    ->orderByRaw('COALESCE(views_count, 0) DESC')
                    ->limit(5)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug'),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                        'danger' => 'archived',
                    ]),
                TextColumn::make('views_count')
                    ->label('Page Views')
                    ->getStateUsing(fn ($record) => $record->views_count ?? 0)
                    ->numeric()
                    ->sortable(),
            ]);
    }
}

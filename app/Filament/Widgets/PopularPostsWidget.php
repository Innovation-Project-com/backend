<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\PageView;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PopularPostsWidget extends TableWidget
{
    protected static ?string $heading = 'Popular Blog Posts';

    protected static ?int $sort = 9;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Post::query()
                    ->select('posts.*')
                    ->selectSub(
                        PageView::query()
                            ->whereColumn('referrable_id', 'posts.id')
                            ->where('referrable_type', Post::class)
                            ->selectRaw('count(*)'),
                        'views_count'
                    )
                    ->orderByRaw('COALESCE(views_count, 0) DESC')
                    ->limit(5)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                        'danger' => 'archived',
                    ]),
                TextColumn::make('views_count')
                    ->label('Views')
                    ->getStateUsing(fn ($record) => $record->views_count ?? 0)
                    ->numeric()
                    ->sortable(),
            ]);
    }
}

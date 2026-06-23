<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentLeadsWidget extends TableWidget
{
    protected static ?string $heading = 'Recent Leads';

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Lead::query()->latest()->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('interested_solution')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'danger' => 'new',
                        'warning' => 'contacted',
                        'primary' => 'qualified',
                        'info' => 'proposal_sent',
                        'success' => 'closed',
                        'gray' => 'archived',
                    ]),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Submitted At'),
            ]);
    }
}

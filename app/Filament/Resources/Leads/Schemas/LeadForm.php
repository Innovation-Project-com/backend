<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->components([
                        Grid::make(1)
                            ->columnSpan(2)
                            ->components([
                                Section::make('Submission Details')
                                    ->components([
                                        Grid::make(2)
                                            ->components([
                                                TextInput::make('name')
                                                    ->disabled(),
                                                TextInput::make('company')
                                                    ->disabled(),
                                                TextInput::make('email')
                                                    ->email()
                                                    ->disabled(),
                                                TextInput::make('phone')
                                                    ->disabled(),
                                            ]),
                                        TextInput::make('interested_solution')
                                            ->disabled(),
                                        Textarea::make('message')
                                            ->disabled()
                                            ->rows(5),
                                        TextInput::make('source_page')
                                            ->disabled(),
                                    ]),
                            ]),

                        Grid::make(1)
                            ->columnSpan(1)
                            ->components([
                                Section::make('Pipeline Management')
                                    ->components([
                                        Select::make('status')
                                            ->required()
                                            ->options([
                                                'new' => 'New Lead',
                                                'contacted' => 'Contacted',
                                                'qualified' => 'Qualified',
                                                'proposal_sent' => 'Proposal Sent',
                                                'closed' => 'Closed (Won)',
                                                'archived' => 'Archived (Lost)',
                                            ])
                                            ->default('new'),
                                        Textarea::make('follow_up_notes')
                                            ->rows(5)
                                            ->placeholder('Add follow up notes or call summary...'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}

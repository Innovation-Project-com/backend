<?php

namespace App\Filament\Resources\Solutions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Str;

class SolutionForm
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
                                Section::make('Solution Overview')
                                    ->components([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, $set) => 
                                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                            ),
                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(table: 'solutions', column: 'slug', ignoreRecord: true),
                                        Textarea::make('short_description')
                                            ->required()
                                            ->rows(3),
                                        RichEditor::make('description')
                                            ->required(),
                                    ]),

                                Section::make('Benefits & Use Cases')
                                    ->description('Configure solution benefits and target use cases.')
                                    ->components([
                                        Repeater::make('benefits')
                                            ->simple(
                                                TextInput::make('value')
                                                    ->required()
                                                    ->placeholder('e.g. Reduce reporting time by 50%')
                                            )
                                            ->label('Benefits')
                                            ->default([]),
                                        Repeater::make('use_cases')
                                            ->simple(
                                                TextInput::make('value')
                                                    ->required()
                                                    ->placeholder('e.g. Distributed warehouses')
                                            )
                                            ->label('Use Cases')
                                            ->default([]),
                                    ]),

                                Section::make('Features')
                                    ->description('Detailed features list.')
                                    ->components([
                                        Repeater::make('features')
                                            ->schema([
                                                TextInput::make('title')->required(),
                                                Textarea::make('description')->required()->rows(2),
                                                TextInput::make('icon')->placeholder('lucide icon name (e.g. Settings, Shield)'),
                                            ])
                                            ->grid(2)
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->default([]),
                                    ]),

                                Section::make('FAQ Items')
                                    ->description('Frequently asked questions for this solution.')
                                    ->components([
                                        Repeater::make('faq_items')
                                            ->schema([
                                                TextInput::make('question')->required(),
                                                Textarea::make('answer')->required()->rows(2),
                                            ])
                                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                                            ->default([]),
                                    ]),
                            ]),

                        Grid::make(1)
                            ->columnSpan(1)
                            ->components([
                                Section::make('Status & Ordering')
                                    ->components([
                                        Select::make('status')
                                            ->required()
                                            ->options([
                                                'draft' => 'Draft',
                                                'published' => 'Published',
                                                'archived' => 'Archived',
                                            ])
                                            ->default('draft'),
                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                    ]),

                                Section::make('SEO & Sharing')
                                    ->components([
                                        TextInput::make('seo_title')
                                            ->maxLength(255),
                                        Textarea::make('seo_description')
                                            ->rows(3),
                                        SpatieMediaLibraryFileUpload::make('og_image')
                                            ->collection('og_image')
                                            ->image()
                                            ->maxSize(2048),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}

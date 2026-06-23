<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Str;

class PageForm
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
                                Section::make('Page Content')
                                    ->components([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, $set) => 
                                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                            ),
                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(table: 'pages', column: 'slug', ignoreRecord: true),
                                        Select::make('page_type')
                                            ->required()
                                            ->options([
                                                'home' => 'Home Page',
                                                'about' => 'About Us Page',
                                                'contact' => 'Contact Page',
                                                'blog' => 'Blog Listing Page',
                                                'custom' => 'Custom Layout Page',
                                            ]),
                                    ]),

                                Section::make('Hero Header')
                                    ->description('Banner header at the top of the page.')
                                    ->components([
                                        TextInput::make('hero_title')
                                            ->maxLength(255),
                                        Textarea::make('hero_subtitle')
                                            ->rows(3),
                                    ]),

                                Section::make('Content Blocks')
                                    ->description('Build dynamic section blocks for this page.')
                                    ->components([
                                        Builder::make('content_blocks')
                                            ->blocks([
                                                Block::make('hero_banner')
                                                    ->label('Hero Banner Section')
                                                    ->icon('heroicon-o-sparkles')
                                                    ->schema([
                                                        TextInput::make('badge')->placeholder('e.g. Solution, Service'),
                                                        TextInput::make('title')->required(),
                                                        Textarea::make('subtitle')->rows(2),
                                                        Grid::make(2)->components([
                                                            TextInput::make('primary_cta_label'),
                                                            TextInput::make('primary_cta_url'),
                                                            TextInput::make('secondary_cta_label'),
                                                            TextInput::make('secondary_cta_url'),
                                                        ]),
                                                    ]),

                                                Block::make('problem_section')
                                                    ->label('Problem Identification')
                                                    ->icon('heroicon-o-exclamation-triangle')
                                                    ->schema([
                                                        TextInput::make('title')->required(),
                                                        Textarea::make('subtitle')->rows(2),
                                                        Repeater::make('items')
                                                            ->schema([
                                                                TextInput::make('code')->required()->placeholder('e.g. disconnected_systems'),
                                                                TextInput::make('title')->required(),
                                                                TextInput::make('short')->required(),
                                                                Textarea::make('description')->required()->rows(2),
                                                                TextInput::make('metric')->placeholder('e.g. 80%'),
                                                                TextInput::make('progress')->integer()->placeholder('e.g. 80'),
                                                                TextInput::make('image_url')->placeholder('Unsplash image URL'),
                                                            ])
                                                            ->grid(2)
                                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                                    ]),

                                                Block::make('why_us_section')
                                                    ->label('Why Choose Us')
                                                    ->icon('heroicon-o-hand-thumb-up')
                                                    ->schema([
                                                        TextInput::make('title')->required(),
                                                        Textarea::make('subtitle')->rows(2),
                                                        Repeater::make('items')
                                                            ->schema([
                                                                TextInput::make('title')->required(),
                                                                Textarea::make('description')->required()->rows(2),
                                                            ])
                                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                                    ]),

                                                Block::make('process_section')
                                                    ->label('Methodology / Process Steps')
                                                    ->icon('heroicon-o-arrow-path')
                                                    ->schema([
                                                        TextInput::make('title')->required(),
                                                        Textarea::make('subtitle')->rows(2),
                                                        Repeater::make('steps')
                                                            ->schema([
                                                                TextInput::make('title')->required(),
                                                                Textarea::make('description')->required()->rows(2),
                                                            ])
                                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                                    ]),

                                                Block::make('rich_text')
                                                    ->label('HTML / Rich Text Content')
                                                    ->icon('heroicon-o-document-text')
                                                    ->schema([
                                                        RichEditor::make('content')->required(),
                                                    ]),

                                                Block::make('cta_section')
                                                    ->label('Call To Action Banner')
                                                    ->icon('heroicon-o-phone')
                                                    ->schema([
                                                        TextInput::make('title')->required(),
                                                        Textarea::make('subtitle')->rows(2),
                                                        TextInput::make('btn_label'),
                                                        TextInput::make('btn_url'),
                                                    ]),
                                            ])
                                            ->collapsible()
                                            ->cloneable(),
                                    ]),
                            ]),

                        Grid::make(1)
                            ->columnSpan(1)
                            ->components([
                                Section::make('Publish Status')
                                    ->components([
                                        Select::make('status')
                                            ->required()
                                            ->options([
                                                'draft' => 'Draft',
                                                'published' => 'Published',
                                                'archived' => 'Archived',
                                            ])
                                            ->default('draft'),
                                        DateTimePicker::make('published_at'),
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

<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Str;

class PostForm
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
                                Section::make('Article Content')
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
                                            ->unique(table: 'posts', column: 'slug', ignoreRecord: true),
                                        Textarea::make('excerpt')
                                            ->rows(3)
                                            ->placeholder('Provide a brief summary of the article...'),
                                        RichEditor::make('body')
                                            ->required(),
                                    ]),

                                Section::make('Featured Image')
                                    ->components([
                                        SpatieMediaLibraryFileUpload::make('featured_image')
                                            ->collection('featured_image')
                                            ->image()
                                            ->maxSize(2048),
                                    ]),
                            ]),

                        Grid::make(1)
                            ->columnSpan(1)
                            ->components([
                                Section::make('Metadata & Classification')
                                    ->components([
                                        Select::make('category_id')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required(),
                                        Select::make('tags')
                                            ->relationship('tags', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload(),
                                        TextInput::make('author_name')
                                            ->required()
                                            ->default('Admin')
                                            ->maxLength(100),
                                        TextInput::make('reading_time')
                                            ->numeric()
                                            ->default(1)
                                            ->suffix('min')
                                            ->required(),
                                    ]),

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
                                        DateTimePicker::make('published_at')
                                            ->default(now()),
                                        Toggle::make('is_featured')
                                            ->label('Featured Post')
                                            ->default(false),
                                    ]),

                                Section::make('SEO Settings')
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

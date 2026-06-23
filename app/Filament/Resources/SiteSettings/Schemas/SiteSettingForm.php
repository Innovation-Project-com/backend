<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->description('Manage company name and footer text.')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('company_name')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('footer_text')
                                    ->rows(3),
                            ]),
                    ]),

                Section::make('Contact Details')
                    ->description('Company contact address, phone, and email.')
                    ->components([
                        Grid::make(3)
                            ->components([
                                TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(40),
                                Textarea::make('address')
                                    ->rows(3),
                            ]),
                    ]),

                Section::make('Branding Media')
                    ->description('Upload website logo and favicon.')
                    ->components([
                        Grid::make(2)
                            ->components([
                                SpatieMediaLibraryFileUpload::make('logo')
                                    ->collection('logo')
                                    ->image()
                                    ->maxSize(2048),
                                SpatieMediaLibraryFileUpload::make('favicon')
                                    ->collection('favicon')
                                    ->image()
                                    ->maxSize(512),
                            ]),
                    ]),

                Section::make('Social Links')
                    ->description('Add social media profile URLs.')
                    ->components([
                        KeyValue::make('social_links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL')
                            ->keyPlaceholder('e.g. linkedin, twitter')
                            ->valuePlaceholder('https://...'),
                    ]),

                Section::make('Default SEO Metadata')
                    ->description('Configure default SEO meta tags for pages without custom SEO.')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('default_seo_title')
                                    ->maxLength(255),
                                Textarea::make('default_seo_description')
                                    ->rows(3),
                            ]),
                    ]),
            ]);
    }
}

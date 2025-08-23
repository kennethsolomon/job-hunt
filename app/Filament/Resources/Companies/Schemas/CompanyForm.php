<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                ->default(fn () => auth()->id())
                ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Company Name'),
                TextInput::make('website')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://example.com')
                    ->label('Website'),
                TextInput::make('location')
                    ->maxLength(255)
                    ->placeholder('City, Country')
                    ->label('Location'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Company'),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Full Name'),

                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->label('Email Address'),

                TextInput::make('role')
                    ->maxLength(255)
                    ->placeholder('e.g. Hiring Manager, HR Director')
                    ->label('Job Title/Role'),

                TextInput::make('linkedin')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://linkedin.com/in/username')
                    ->label('LinkedIn Profile'),
            ])
            ->columns(2);
    }
}

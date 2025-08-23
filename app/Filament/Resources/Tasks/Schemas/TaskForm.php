<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn () => auth()->id())
                    ->required(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Select::make('application_id')
                    ->relationship('application', 'role')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->label('Related Application'),

                DateTimePicker::make('due_at')
                    ->required()
                    ->native(false)
                    ->label('Due Date & Time'),

                DateTimePicker::make('completed_at')
                    ->nullable()
                    ->native(false)
                    ->label('Completed At'),
            ])
            ->columns(2);
    }
}
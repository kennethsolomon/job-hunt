<?php

namespace App\Filament\Resources\Applications\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;

class CompanyRelationManager extends RelationManager
{
    protected static string $relationship = 'company';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company Information')
                    ->schema([
                        Hidden::make('user_id')
                            ->default(fn () => auth()->user()?->id)
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
                    ])
                    ->columnSpanFull(), // Make this section take full width

                Section::make('Contacts')
                    ->schema([
                        Repeater::make('contacts')
                            ->relationship('contacts')
                            ->schema([
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
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'New Contact')
                            ->addActionLabel('Add Contact')
                            ->collapsible()
                            ->defaultItems(0)
                            ->reorderableWithButtons()
                            ->cloneable(),
                    ])
                    ->columnSpanFull() // Make this section take full width
                    ->collapsible()
                    ->collapsed(fn (?string $operation): bool => $operation === 'create'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Company Name'),

                TextColumn::make('website')
                    ->url(fn ($record) => $record->website)
                    ->openUrlInNewTab()
                    ->placeholder('No website')
                    ->label('Website'),

                TextColumn::make('location')
                    ->searchable()
                    ->sortable()
                    ->placeholder('No location')
                    ->label('Location'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->modalWidth('4xl')
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

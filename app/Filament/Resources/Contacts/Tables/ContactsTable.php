<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Full Name'),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->placeholder('No email')
                    ->label('Email'),
                TextColumn::make('role')
                    ->searchable()
                    ->placeholder('No role specified')
                    ->label('Role'),
                TextColumn::make('linkedin')
                    ->url(fn ($record) => $record->linkedin)
                    ->openUrlInNewTab()
                    ->placeholder('No LinkedIn')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->linkedin)
                    ->label('LinkedIn'),
                TextColumn::make('company.name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('No company')
                    ->label('Company'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

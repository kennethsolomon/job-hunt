<?php

namespace App\Filament\Resources\Companies\RelationManagers;

use App\Filament\Resources\Contacts\Schemas\ContactForm;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    public function form(Schema $schema): Schema
    {
        return ContactForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

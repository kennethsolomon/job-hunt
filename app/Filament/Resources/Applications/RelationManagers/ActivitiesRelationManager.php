<?php

namespace App\Filament\Resources\Applications\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')->options([
                    'note'=>'Note','email'=>'Email','call'=>'Call','followup'=>'Follow-up','status_change'=>'Status Change',
                ])->required(),
                Textarea::make('body')->rows(3),
                TextInput::make('outcome')->maxLength(100)->placeholder('sent / left voicemail ...'),
                DateTimePicker::make('happened_at')->required()->default(now()),
            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('activity')
            ->columns([
                TextColumn::make('type')->badge(),
                TextColumn::make('body')->limit(60)->wrap(),
                TextColumn::make('outcome'),
                TextColumn::make('happened_at')->since(),
            ])
            ->defaultSort('happened_at','desc')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
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

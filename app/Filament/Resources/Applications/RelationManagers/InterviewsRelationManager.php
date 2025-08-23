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
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InterviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'interviews';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

            TextInput::make('type')
                ->label('Type')
                ->required()
                ->maxLength(255)
                ->helperText('e.g. phone, tech-screen, onsite, final'),

            TextInput::make('scheduled_at')
                ->label('Scheduled At')
                ->type('datetime-local')
                ->required(),

            TextInput::make('location')
                ->label('Location')
                ->maxLength(255)
                ->helperText('Zoom/Meet link or address (optional)'),

            TextInput::make('panel')
                ->label('Panel')
                ->json()
                ->helperText('JSON: e.g. [{"name":"Jane","email":"jane@x.com","role":"Interviewer"}] (optional)'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('test')
            ->columns([
            TextColumn::make('type')
                ->label('Type')
                ->sortable()
                ->searchable(),

            TextColumn::make('scheduled_at')
                ->label('Scheduled At')
                ->dateTime('M d, Y H:i')
                ->sortable(),

            TextColumn::make('location')
                ->label('Location')
                ->limit(30)
                ->searchable(),

            TextColumn::make('panel')
                ->label('Panel')
                ->formatStateUsing(function ($state) {
                    if (empty($state)) {
                        return '-';
                    }
                    $panel = json_decode($state, true);
                    if (!is_array($panel)) {
                        return '-';
                    }
                    return collect($panel)
                        ->pluck('name')
                        ->filter()
                        ->implode(', ');
                })
                ->wrap()
                ->tooltip(function ($state) {
                    if (empty($state)) {
                        return null;
                    }
                    $panel = json_decode($state, true);
                    if (!is_array($panel)) {
                        return null;
                    }
                    return collect($panel)
                        ->map(function ($member) {
                            return $member['name'] . (isset($member['role']) ? " ({$member['role']})" : '');
                        })
                        ->implode(', ');
                }),
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

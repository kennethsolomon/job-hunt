<?php

namespace App\Filament\Resources\Applications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('role')->searchable()->sortable()->wrap(),
                TextColumn::make('company.name')->label('Company')->searchable()->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'prospect',
                        'info' => 'applied',
                        'warning' => 'replied',
                        'indigo' => 'interview',
                        'success' => ['offer','accepted'],
                        'danger' => 'rejected',
                    ])
                    ->sortable(),
                TextColumn::make('applied_on')->date()->sortable(),
                TextColumn::make('next_follow_up_at')->since()->label('Next Follow-up'),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'prospect'=>'Prospect','applied'=>'Applied','replied'=>'Replied','interview'=>'Interview','offer'=>'Offer','accepted'=>'Accepted','rejected'=>'Rejected','archived'=>'Archived',
                ]),
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

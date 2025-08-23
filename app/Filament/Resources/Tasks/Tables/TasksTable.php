<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->weight(fn ($record) => $record->completed_at ? 'medium' : 'bold'),

                TextColumn::make('application.role')
                    ->label('Application')
                    ->searchable()
                    ->sortable()
                    ->placeholder('No application')
                    ->limit(30),

                TextColumn::make('due_at')
                    ->label('Due')
                    ->dateTime('M j, Y g:i A')
                    ->sortable()
                    ->color(fn ($record) => $record->due_at < now() && !$record->completed_at ? 'danger' : 'gray'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(fn ($record) => $record->completed_at ? 'completed' : 'pending')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->colors([
                        'success' => 'completed',
                        'warning' => 'pending',
                    ])
                    ->sortable(query: function ($query, string $direction): Builder {
                        return $query->orderBy('completed_at', $direction);
                    }),
            ])
            ->filters([
                TernaryFilter::make('completed_at')
                    ->label('Status')
                    ->placeholder('All tasks')
                    ->trueLabel('Completed')
                    ->falseLabel('Pending')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('completed_at'),
                        false: fn ($query) => $query->whereNull('completed_at'),
                    ),
            ])
            ->recordActions([
                Action::make('complete')
                    ->label(fn ($record) => $record->completed_at ? 'Mark Incomplete' : 'Mark Complete')
                    ->icon(fn ($record) => $record->completed_at ? 'heroicon-o-arrow-uturn-left' : 'heroicon-o-check')
                    ->color(fn ($record) => $record->completed_at ? 'gray' : 'success')
                    ->action(function ($record) {
                        $record->update([
                            'completed_at' => $record->completed_at ? null : now(),
                        ]);
                    })
                    ->requiresConfirmation(false),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('due_at', 'asc')
            ->striped()
            ->recordClasses(fn ($record) => $record->completed_at ? 'opacity-70' : null);
    }
}

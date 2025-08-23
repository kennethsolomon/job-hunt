<?php

namespace App\Filament\Resources\Companies\RelationManagers;

use App\Filament\Resources\Applications\Schemas\ApplicationForm;
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
use Filament\Tables\Columns\BadgeColumn;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    public function form(Schema $schema): Schema
    {
        return ApplicationForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('role')
            ->columns([
                TextColumn::make('role')
                    ->searchable()
                    ->sortable()
                    ->label('Role'),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'secondary' => 'prospect',
                        'primary' => 'applied',
                        'info' => 'replied',
                        'warning' => 'interview',
                        'success' => ['offer', 'accepted'],
                        'danger' => 'rejected',
                        'gray' => 'archived',
                    ])
                    ->sortable(),
                TextColumn::make('salary_ask')
                    ->money('PHP')
                    ->sortable()
                    ->placeholder('Not specified')
                    ->label('Salary Ask'),
                TextColumn::make('salary_offer')
                    ->money('PHP')
                    ->sortable()
                    ->placeholder('Not offered')
                    ->label('Salary Offer'),
                TextColumn::make('applied_on')
                    ->date()
                    ->sortable()
                    ->placeholder('Not applied')
                    ->label('Applied On'),
                TextColumn::make('next_follow_up_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('No follow-up')
                    ->label('Next Follow-up'),
                TextColumn::make('source_url')
                    ->url(fn ($record) => $record->source_url)
                    ->openUrlInNewTab()
                    ->placeholder('No URL')
                    ->limit(30)
                    ->label('Job URL'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created'),
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

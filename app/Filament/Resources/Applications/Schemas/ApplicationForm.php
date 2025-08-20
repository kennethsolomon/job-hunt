<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Select::make('company_id')->relationship('company','name')->searchable()->preload()->required(),
                TextInput::make('user_id')
                    ->label('User')
                    ->default(fn () => auth()->id())
                    ->required(),
                TextInput::make('role')->required()->maxLength(150),
                TextInput::make('source_url')->url()->label('Job URL')->nullable(),
                Select::make('status')->options([
                    'prospect'=>'Prospect','applied'=>'Applied','replied'=>'Replied',
                    'interview'=>'Interview','offer'=>'Offer','accepted'=>'Accepted',
                    'rejected'=>'Rejected','archived'=>'Archived',
                ])->required()->default('prospect')->native(false),
                TextInput::make('salary_ask')->numeric()->prefix('₱')->nullable(),
                TextInput::make('salary_offer')->numeric()->prefix('₱')->nullable(),
                DatePicker::make('applied_on')->native(false),
                DateTimePicker::make('next_follow_up_at')->native(false),
                Textarea::make('job_description')->rows(6)->columnSpanFull(),
                TagsInput::make('tags')->suggestions(fn()=>\App\Models\Tag::where('user_id',auth()->id())->pluck('name')->all())
                    ->separator(','),
            ])->columns(2);
    }
}

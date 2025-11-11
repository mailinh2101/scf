<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Công việc';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('position')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\RichEditor::make('description')
                    ->nullable()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('employment_type')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('salary_range')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\Textarea::make('requirements')
                    ->nullable()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('benefits')
                    ->nullable()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('contact_email')
                    ->email()
                    ->nullable(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->nullable(),
                Forms\Components\Toggle::make('published')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employment_type'),
                Tables\Columns\IconColumn::make('published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('published')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}

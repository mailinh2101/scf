<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Tuyển dụng';

    protected static ?string $modelLabel = 'Việc làm';

    protected static ?string $pluralModelLabel = 'Việc làm';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tiêu đề việc làm')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('position')
                            ->label('Vị trí tuyển dụng')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('employment_type')
                            ->label('Loại hình công việc')
                            ->options([
                                'full-time' => 'Toàn thời gian',
                                'part-time' => 'Bán thời gian',
                                'contract' => 'Hợp đồng',
                            ])
                            ->default('full-time')
                            ->required(),
                        Forms\Components\TextInput::make('location')
                            ->label('Địa điểm làm việc')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('salary_range')
                            ->label('Mức lương')
                            ->placeholder('VD: 15-20 triệu')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Email liên hệ')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Chi tiết')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả công việc')
                            ->rows(8)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('requirements')
                            ->label('Yêu cầu')
                            ->rows(6)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('benefits')
                            ->label('Quyền lợi')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Xuất bản')
                    ->schema([
                        Forms\Components\Toggle::make('published')
                            ->label('Công khai')
                            ->default(true),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Ngày xuất bản')
                            ->native(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Vị trí')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Địa điểm')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employment_type')
                    ->label('Loại hình')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => match($state) {
                        'full-time' => 'Toàn thời gian',
                        'part-time' => 'Bán thời gian',
                        'contract' => 'Hợp đồng',
                        default => $state,
                    })
                    ->color(fn(string $state) => match($state) {
                        'full-time' => 'success',
                        'part-time' => 'warning',
                        'contract' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('published')
                    ->label('Công khai')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tạo ngày')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('employment_type')
                    ->label('Loại hình')
                    ->options([
                        'full-time' => 'Toàn thời gian',
                        'part-time' => 'Bán thời gian',
                        'contract' => 'Hợp đồng',
                    ]),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Công khai'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
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

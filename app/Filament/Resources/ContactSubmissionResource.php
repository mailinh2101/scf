<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $label = 'Liên hệ từ khách';

    protected static ?string $pluralLabel = 'Liên hệ từ khách';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin liên hệ')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Họ và tên')
                            ->required()
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Điện thoại')
                            ->tel()
                            ->disabled(),
                        Forms\Components\TextInput::make('subject')
                            ->label('Tiêu đề')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Nội dung')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Tin nhắn')
                            ->required()
                            ->disabled()
                            ->rows(6),
                    ]),

                Forms\Components\Section::make('Trạng thái')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'pending' => 'Chưa xem',
                                'read' => 'Đã xem',
                                'replied' => 'Đã trả lời',
                            ])
                            ->required()
                            ->default('pending'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Tên')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Điện thoại')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Tiêu đề')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'read',
                        'success' => 'replied',
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'pending' => 'Chưa xem',
                        'read' => 'Đã xem',
                        'replied' => 'Đã trả lời',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày gửi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chưa xem',
                        'read' => 'Đã xem',
                        'replied' => 'Đã trả lời',
                    ]),
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
            'index' => Pages\ListContactSubmissions::route('/'),
            'edit' => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}

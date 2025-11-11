<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactSubmissionResource\Pages;
use App\Filament\Admin\Resources\ContactSubmissionResource\RelationManagers;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Liên hệ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin người liên hệ')
                    ->description('Thông tin cá nhân của khách hàng (Chỉ xem)')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->label('Họ và tên')
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-o-user'),
                                
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-o-envelope'),
                                
                                Forms\Components\TextInput::make('phone')
                                    ->label('Số điện thoại')
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-o-phone'),
                            ]),
                    ])
                    ->columns(1),
                
                Forms\Components\Section::make('Nội dung liên hệ')
                    ->description('Thông tin yêu cầu của khách hàng (Chỉ xem)')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label('Tiêu đề / Chủ đề')
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('message')
                            ->label('Nội dung chi tiết')
                            ->disabled()
                            ->dehydrated()
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Quản lý trạng thái')
                    ->description('Cập nhật tình trạng xử lý')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái xử lý')
                            ->options([
                                'pending' => '⏳ Chờ xử lý',
                                'read' => '👁️ Đã đọc',
                                'replied' => '✅ Đã trả lời',
                            ])
                            ->default('pending')
                            ->required()
                            ->helperText('Cập nhật trạng thái sau khi xử lý yêu cầu')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
    
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Thông tin người liên hệ')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('first_name')
                                    ->label('Họ và tên')
                                    ->icon('heroicon-o-user')
                                    ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                                    ->weight('bold'),
                                
                                Infolists\Components\TextEntry::make('email')
                                    ->label('Email')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable()
                                    ->copyMessage('Đã copy email!'),
                                
                                Infolists\Components\TextEntry::make('phone')
                                    ->label('Số điện thoại')
                                    ->icon('heroicon-o-phone')
                                    ->copyable()
                                    ->copyMessage('Đã copy số điện thoại!')
                                    ->placeholder('Không có'),
                            ]),
                    ]),
                
                Infolists\Components\Section::make('Nội dung liên hệ')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->schema([
                        Infolists\Components\TextEntry::make('subject')
                            ->label('Chủ đề')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->icon('heroicon-o-document-text')
                            ->columnSpanFull(),
                        
                        Infolists\Components\TextEntry::make('message')
                            ->label('Nội dung chi tiết')
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
                
                Infolists\Components\Section::make('Trạng thái và thời gian')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('status')
                                    ->label('Trạng thái xử lý')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'read' => 'info',
                                        'replied' => 'success',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'pending' => '⏳ Chờ xử lý',
                                        'read' => '👁️ Đã đọc',
                                        'replied' => '✅ Đã trả lời',
                                        default => $state,
                                    }),
                                
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Ngày gửi')
                                    ->dateTime('d/m/Y H:i')
                                    ->icon('heroicon-o-calendar')
                                    ->since(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'read',
                        'success' => 'replied',
                    ])
                    ->icons([
                        'heroicon-o-clock' => 'pending',
                        'heroicon-o-eye' => 'read',
                        'heroicon-o-check-circle' => 'replied',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Chờ xử lý',
                        'read' => 'Đã đọc',
                        'replied' => 'Đã trả lời',
                        default => $state,
                    })
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Thông tin liên hệ')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->email)
                    ->icon('heroicon-o-user')
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('phone')
                    ->label('SĐT')
                    ->icon('heroicon-o-phone')
                    ->searchable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('subject')
                    ->label('Tiêu đề & Nội dung')
                    ->searchable()
                    ->description(fn ($record) => \Str::limit($record->message, 80))
                    ->wrap()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày gửi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->description(fn ($record) => $record->created_at->format('d/m/Y H:i')),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => '⏳ Chờ xử lý',
                        'read' => '👁️ Đã đọc',
                        'replied' => '✅ Đã trả lời',
                    ])
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Xem'),
                
                Tables\Actions\EditAction::make()
                    ->label('Sửa trạng thái'),
                
                // Cho phép cập nhật trạng thái nhanh
                Tables\Actions\Action::make('mark_as_read')
                    ->label('Đã đọc')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->action(fn ($record) => $record->update(['status' => 'read']))
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation(false),
                
                Tables\Actions\Action::make('mark_as_replied')
                    ->label('Đã trả lời')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn ($record) => $record->update(['status' => 'replied']))
                    ->visible(fn ($record) => $record->status !== 'replied')
                    ->requiresConfirmation(false),
                
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
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
            'index' => Pages\ListContactSubmissions::route('/'),
            'view' => Pages\ViewContactSubmission::route('/{record}'),
            'edit' => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
    
    // Tắt tính năng tạo mới từ admin
    public static function canCreate(): bool
    {
        return false;
    }    
}

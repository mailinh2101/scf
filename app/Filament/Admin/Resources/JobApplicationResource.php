<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JobApplicationResource\Pages;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Đơn ứng tuyển';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin ứng viên')
                    ->description('Thông tin cá nhân của người ứng tuyển (Chỉ xem)')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
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
                                
                                Forms\Components\TextInput::make('position')
                                    ->label('Vị trí ứng tuyển')
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-o-briefcase'),
                            ]),
                    ])
                    ->columns(1),
                
                Forms\Components\Section::make('Thư giới thiệu')
                    ->description('Lời nhắn và giới thiệu bản thân (Chỉ xem)')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Nội dung thư')
                            ->rows(5)
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Hồ sơ đính kèm')
                    ->description('CV/Resume của ứng viên (Chỉ xem)')
                    ->icon('heroicon-o-document')
                    ->schema([
                        Forms\Components\FileUpload::make('cv_path')
                            ->label('Tệp CV/Resume')
                            ->directory('resumes')
                            ->downloadable()
                            ->openable()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Quản lý trạng thái')
                    ->description('Cập nhật tình trạng xét duyệt')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái xét duyệt')
                            ->options([
                                'new' => '📩 Mới nhận',
                                'reviewing' => '👀 Đang xem xét',
                                'shortlisted' => '⭐ Lọt vòng',
                                'interviewed' => '🎤 Đã phỏng vấn',
                                'rejected' => '❌ Từ chối',
                                'accepted' => '✅ Chấp nhận',
                            ])
                            ->default('new')
                            ->required()
                            ->helperText('Cập nhật trạng thái hồ sơ ứng viên')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
    
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Thông tin ứng viên')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('name')
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
                                    ->copyMessage('Đã copy số điện thoại!'),
                                
                                Infolists\Components\TextEntry::make('position')
                                    ->label('Vị trí ứng tuyển')
                                    ->icon('heroicon-o-briefcase')
                                    ->badge()
                                    ->color('primary'),
                            ]),
                    ]),
                
                Infolists\Components\Section::make('Thư giới thiệu')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        Infolists\Components\TextEntry::make('message')
                            ->label('')
                            ->placeholder('Không có thư giới thiệu')
                            ->markdown()
                            ->columnSpanFull(),
                    ])
                    ->collapsed(fn ($record) => empty($record->message)),
                
                Infolists\Components\Section::make('Hồ sơ đính kèm')
                    ->icon('heroicon-o-document')
                    ->schema([
                        Infolists\Components\TextEntry::make('cv_path')
                            ->label('File CV/Resume')
                            ->formatStateUsing(fn ($state) => $state ? basename($state) : 'Không có file đính kèm')
                            ->url(fn ($record) => $record->cv_path ? asset('storage/' . $record->cv_path) : null)
                            ->openUrlInNewTab()
                            ->icon(fn ($record) => $record->cv_path ? 'heroicon-o-document-arrow-down' : 'heroicon-o-document-minus')
                            ->color(fn ($record) => $record->cv_path ? 'success' : 'gray'),
                    ]),
                
                Infolists\Components\Section::make('Trạng thái và thời gian')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('status')
                                    ->label('Trạng thái xét duyệt')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'new' => 'secondary',
                                        'reviewing' => 'info',
                                        'shortlisted' => 'warning',
                                        'interviewed' => 'primary',
                                        'rejected' => 'danger',
                                        'accepted' => 'success',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'new' => '📩 Mới nhận',
                                        'reviewing' => '👀 Đang xem xét',
                                        'shortlisted' => '⭐ Lọt vòng',
                                        'interviewed' => '🎤 Đã phỏng vấn',
                                        'rejected' => '❌ Từ chối',
                                        'accepted' => '✅ Chấp nhận',
                                        default => $state,
                                    }),
                                
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Ngày ứng tuyển')
                                    ->dateTime('d/m/Y H:i')
                                    ->icon('heroicon-o-calendar'),
                                
                                Infolists\Components\TextEntry::make('ip_address')
                                    ->label('IP Address')
                                    ->icon('heroicon-o-globe-alt')
                                    ->placeholder('Không có'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ứng viên')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->email)
                    ->icon('heroicon-o-user-circle')
                    ->weight('bold')
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('phone')
                    ->label('SĐT')
                    ->icon('heroicon-o-phone')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Đã copy số điện thoại!')
                    ->copyMessageDuration(1500),
                
                Tables\Columns\TextColumn::make('position')
                    ->label('Vị trí ứng tuyển')
                    ->searchable()
                    ->icon('heroicon-o-briefcase')
                    ->badge()
                    ->color('primary'),
                
                Tables\Columns\IconColumn::make('cv_path')
                    ->label('CV')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-check')
                    ->falseIcon('heroicon-o-document-minus')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => $record->cv_path ? 'Có CV đính kèm' : 'Không có CV'),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->colors([
                        'secondary' => 'new',
                        'info' => 'reviewing',
                        'warning' => 'shortlisted',
                        'primary' => 'interviewed',
                        'danger' => 'rejected',
                        'success' => 'accepted',
                    ])
                    ->icons([
                        'heroicon-o-inbox' => 'new',
                        'heroicon-o-eye' => 'reviewing',
                        'heroicon-o-star' => 'shortlisted',
                        'heroicon-o-microphone' => 'interviewed',
                        'heroicon-o-x-circle' => 'rejected',
                        'heroicon-o-check-circle' => 'accepted',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'Mới',
                        'reviewing' => 'Xem xét',
                        'shortlisted' => 'Lọt vòng',
                        'interviewed' => 'Đã PV',
                        'rejected' => 'Từ chối',
                        'accepted' => 'Chấp nhận',
                        default => $state,
                    })
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày ứng tuyển')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->description(fn ($record) => $record->created_at->format('d/m/Y H:i')),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->label('Vị trí')
                    ->options(function () {
                        return \App\Models\JobApplication::query()
                            ->whereNotNull('position')
                            ->distinct()
                            ->pluck('position', 'position')
                            ->toArray();
                    })
                    ->multiple(),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'new' => 'Mới',
                        'reviewing' => 'Đang xem xét',
                        'shortlisted' => 'Lọt vòng',
                        'interviewed' => 'Đã phỏng vấn',
                        'rejected' => 'Từ chối',
                        'accepted' => 'Chấp nhận',
                    ])
                    ->multiple(),
                
                Tables\Filters\Filter::make('has_cv')
                    ->label('Có CV đính kèm')
                    ->query(fn ($query) => $query->whereNotNull('cv_path')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Xem'),
                
                Tables\Actions\EditAction::make()
                    ->label('Sửa trạng thái'),
                
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobApplications::route('/'),
            'view' => Pages\ViewJobApplication::route('/{record}'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
    
    // Tắt tính năng tạo mới từ admin
    public static function canCreate(): bool
    {
        return false;
    }
}

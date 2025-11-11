<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SiteSettingResource\Pages;
use App\Helpers\SiteSettingsHelper;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Cài đặt';

    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('key')
                    ->label('Chọn cài đặt')
                    ->options(SiteSettingsHelper::getDescriptions())
                    ->searchable()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled(fn (?SiteSetting $record) => $record !== null)
                    ->live()
                    ->columnSpanFull(),

                Forms\Components\Placeholder::make('description')
                    ->label('Mô tả')
                    ->content(fn (Forms\Get $get) => SiteSettingsHelper::getDescription($get('key') ?? ''))
                    ->columnSpanFull(),

                // Section cho Upload Hình ảnh
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('value')
                            ->label('Chọn hình ảnh')
                            ->image()
                            ->directory('site-settings')
                            ->imageEditor()
                            ->required()
                            ->hint('Upload hình ảnh. Hệ thống sẽ tự động lưu vào /storage/site-settings/')
                            ->helperText('Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB'),
                    ])
                    ->visible(fn (Forms\Get $get) => SiteSettingsHelper::isImageField($get('key') ?? ''))
                    ->columnSpanFull(),

                // Section cho Email
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->placeholder('hello@starvik.vn')
                            ->suffixIcon('heroicon-o-envelope'),
                    ])
                    ->visible(fn (Forms\Get $get) => SiteSettingsHelper::isEmailField($get('key') ?? ''))
                    ->columnSpanFull(),

                // Section cho Số điện thoại
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Số điện thoại')
                            ->tel()
                            ->required()
                            ->placeholder('+84 90 123 4567')
                            ->suffixIcon('heroicon-o-phone'),
                    ])
                    ->visible(fn (Forms\Get $get) => SiteSettingsHelper::isPhoneField($get('key') ?? ''))
                    ->columnSpanFull(),

                // Section cho URL/Link
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Link URL')
                            ->url()
                            ->required()
                            ->placeholder('https://facebook.com/yourpage')
                            ->suffixIcon('heroicon-o-link')
                            ->helperText('Nhập URL đầy đủ, bắt đầu bằng http:// hoặc https://'),
                    ])
                    ->visible(fn (Forms\Get $get) => SiteSettingsHelper::isUrlField($get('key') ?? ''))
                    ->columnSpanFull(),

                // Section cho Textarea (mô tả dài)
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Textarea::make('value')
                            ->label('Nội dung')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->visible(fn (Forms\Get $get) => SiteSettingsHelper::isTextareaField($get('key') ?? ''))
                    ->columnSpanFull(),

                // Section cho Text ngắn (mặc định)
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Giá trị')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->visible(fn (Forms\Get $get) => !SiteSettingsHelper::isImageField($get('key') ?? '') 
                        && !SiteSettingsHelper::isEmailField($get('key') ?? '')
                        && !SiteSettingsHelper::isPhoneField($get('key') ?? '')
                        && !SiteSettingsHelper::isUrlField($get('key') ?? '')
                        && !SiteSettingsHelper::isTextareaField($get('key') ?? ''))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Khóa cài đặt')
                    ->formatStateUsing(fn ($state) => SiteSettingsHelper::getDescription($state))
                    ->searchable('key')
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Giá trị')
                    ->limit(100)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('key')
                    ->label('Lọc theo cài đặt')
                    ->options(SiteSettingsHelper::getDescriptions()),
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}

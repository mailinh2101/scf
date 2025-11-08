<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Cài đặt trang web';

    protected static ?string $modelLabel = 'Cài đặt';

    protected static ?string $pluralModelLabel = 'Cài đặt';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->label('Khóa cài đặt')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->disabled(fn ($record) => $record !== null)
                    ->hint('Ví dụ: contact_email, logo, hero_bg')
                    ->columnSpanFull(),

                // Dùng FileUpload cho các keys hình ảnh
                Forms\Components\FileUpload::make('value')
                    ->label('Hình ảnh')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public')
                    ->previewable(true)
                    ->downloadable()
                    ->hidden(fn (Forms\Get $get) => !in_array($get('key'), [
                        'logo', 'logo_footer', 'hero_bg', 'hero_image',
                        'sub_logo', 'footer_decor', 'placeholder_image'
                    ]))
                    ->columnSpanFull(),

                // Dùng Textarea cho giá trị text thông thường
                Forms\Components\Textarea::make('value')
                    ->label('Giá trị')
                    ->required()
                    ->rows(5)
                    ->hint('Nhập giá trị tương ứng với khóa trên')
                    ->hidden(fn (Forms\Get $get) => in_array($get('key'), [
                        'logo', 'logo_footer', 'hero_bg', 'hero_image',
                        'sub_logo', 'footer_decor', 'placeholder_image'
                    ]))
                    ->columnSpanFull(),

                Forms\Components\Placeholder::make('helper')
                    ->label('Gợi ý các khóa thường dùng')
                    ->content('
                        **Liên hệ:** contact_email, contact_phone, office_address, working_hours

                        **Trang web:** site_domain, site_description, contact_button_label, read_more_label

                        **Hình ảnh (dùng upload):** logo, logo_footer, hero_bg, hero_image, sub_logo, footer_decor, placeholder_image

                        **Blog:** blog_section_title, blog_section_subtitle

                        **Bản đồ:** map_embed_src
                    ')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Khóa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Giá trị')
                    ->limit(60)
                    ->wrap(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật lúc')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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

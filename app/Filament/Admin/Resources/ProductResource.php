<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Sản phẩm';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Thông tin chính')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Nội dung sản phẩm')
                                    ->description('Thông tin cơ bản về sản phẩm')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Tiêu đề sản phẩm')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Nhập tên sản phẩm...')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\TextInput::make('slug')
                                            ->label('Đường dẫn (URL)')
                                            ->maxLength(255)
                                            ->placeholder('san-pham-demo')
                                            ->helperText('Để trống để tự động tạo từ tiêu đề')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\Textarea::make('description')
                                            ->label('Mô tả sản phẩm')
                                            ->rows(4)
                                            ->placeholder('Mô tả chi tiết về sản phẩm...')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\TextInput::make('category')
                                            ->label('Danh mục')
                                            ->maxLength(255)
                                            ->placeholder('VD: Phần mềm, Thiết bị...')
                                            ->datalist([
                                                'Phần mềm',
                                                'Phần cứng',
                                                'Dịch vụ',
                                                'Giải pháp',
                                            ])
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                
                                Forms\Components\Section::make('Hình ảnh')
                                    ->description('Upload hình ảnh đại diện cho sản phẩm')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Hình ảnh sản phẩm')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('products')
                                            ->maxSize(2048)
                                            ->helperText('Định dạng: JPG, PNG, GIF. Tối đa 2MB')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\Section::make('Tối ưu hóa công cụ tìm kiếm')
                                    ->description('Cải thiện thứ hạng tìm kiếm của sản phẩm')
                                    ->icon('heroicon-o-chart-bar')
                                    ->schema([
                                        Forms\Components\TextInput::make('seo_title')
                                            ->label('Tiêu đề SEO')
                                            ->maxLength(60)
                                            ->placeholder('Tối đa 60 ký tự')
                                            ->helperText('Tiêu đề hiển thị trên Google')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\Textarea::make('seo_description')
                                            ->label('Mô tả SEO')
                                            ->maxLength(160)
                                            ->rows(3)
                                            ->placeholder('Tối đa 160 ký tự')
                                            ->helperText('Mô tả hiển thị trên kết quả tìm kiếm')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('Xuất bản')
                            ->icon('heroicon-o-eye')
                            ->schema([
                                Forms\Components\Section::make('Trạng thái xuất bản')
                                    ->schema([
                                        Forms\Components\Toggle::make('published')
                                            ->label('Xuất bản sản phẩm')
                                            ->helperText('Bật để hiển thị sản phẩm trên website')
                                            ->default(false)
                                            ->inline(false),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Tên sản phẩm')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->category)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Mô tả')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->toggleable(),
                
                Tables\Columns\ToggleColumn::make('published')
                    ->label('Hiển thị')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Danh mục')
                    ->options(function () {
                        return \App\Models\Product::query()
                            ->whereNotNull('category')
                            ->distinct()
                            ->pluck('category', 'category')
                            ->toArray();
                    }),
                
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Trạng thái')
                    ->placeholder('Tất cả')
                    ->trueLabel('Đã xuất bản')
                    ->falseLabel('Bản nháp')
                    ->native(false),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

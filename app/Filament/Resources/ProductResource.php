<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Sản phẩm';

    protected static ?string $modelLabel = 'Sản phẩm';

    protected static ?string $pluralModelLabel = 'Sản phẩm';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin chính')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            ),
                        Forms\Components\TextInput::make('slug')
                            ->label('Đường dẫn (slug)')
                            ->maxLength(255)
                            ->hint('Tự động tạo từ tiêu đề'),
                        Forms\Components\Select::make('category')
                            ->label('Danh mục')
                            ->options([
                                'do-gia-dung' => 'Đồ gia dụng',
                                'thuc-pham-chuc-nang' => 'Thực phẩm chức năng',
                            ])
                            ->required()
                            ->native(false),
                    ])->columns(2),

                Forms\Components\Section::make('Mô tả & Giá')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Mô tả chi tiết')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(1),

                Forms\Components\Section::make('Hình ảnh')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Hình ảnh sản phẩm')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->visibility('public')
                            ->previewable(true)
                            ->downloadable(),
                    ]),

                Forms\Components\Section::make('SEO & Xuất bản')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('Tiêu đề SEO')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('seo_description')
                            ->label('Mô tả SEO')
                            ->rows(3)
                            ->maxLength(500),
                        Forms\Components\Toggle::make('published')
                            ->label('Công khai')
                            ->default(true),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->disk('public')
                    ->width(60)
                    ->height(60),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category')
                    ->label('Danh mục')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'do-gia-dung' => 'info',
                        'thuc-pham-chuc-nang' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'do-gia-dung' => 'Đồ gia dụng',
                        'thuc-pham-chuc-nang' => 'Thực phẩm chức năng',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND')
                    ->sortable(),
                Tables\Columns\IconColumn::make('published')
                    ->label('Công khai')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Danh mục')
                    ->options([
                        'do-gia-dung' => 'Đồ gia dụng',
                        'thuc-pham-chuc-nang' => 'Thực phẩm chức năng',
                    ]),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Công khai')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Bài viết';

    protected static ?string $modelLabel = 'Bài viết';

    protected static ?string $pluralModelLabel = 'Bài viết';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Nội dung chính')
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
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Tóm tắt')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Nội dung chi tiết')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Hình ảnh & Xuất bản')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Ảnh đại diện')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->visibility('public')
                            ->previewable(true)
                            ->downloadable(),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Ngày xuất bản')
                            ->default(now())
                            ->native(false)
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('Tiêu đề SEO')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('seo_description')
                            ->label('Mô tả SEO')
                            ->rows(3)
                            ->maxLength(500),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Ảnh đại diện')
                    ->disk('public')
                    ->width(60)
                    ->height(60),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Ngày xuất bản')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('published')
                    ->label('Đã xuất bản')
                    ->query(fn ($query) => $query->where('published_at', '<=', now())),
                Tables\Filters\Filter::make('unpublished')
                    ->label('Chưa xuất bản')
                    ->query(fn ($query) => $query->where('published_at', '>', now())),
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
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

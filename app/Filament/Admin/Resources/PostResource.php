<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationLabel = 'Bài viết';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Nội dung')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Section::make('Thông tin bài viết')
                                    ->description('Tiêu đề và nội dung chính của bài viết')
                                    ->icon('heroicon-o-pencil')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Tiêu đề bài viết')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Nhập tiêu đề hấp dẫn...')
                                            ->live(onBlur: true)
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\TextInput::make('slug')
                                            ->label('Đường dẫn (URL)')
                                            ->maxLength(255)
                                            ->placeholder('bai-viet-demo')
                                            ->helperText('Để trống để tự động tạo từ tiêu đề')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\Textarea::make('excerpt')
                                            ->label('Tóm tắt ngắn')
                                            ->rows(3)
                                            ->placeholder('Tóm tắt ngắn gọn nội dung bài viết (hiển thị ở trang danh sách)...')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\RichEditor::make('content')
                                            ->label('Nội dung chi tiết')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                                'link',
                                                'heading',
                                                'bulletList',
                                                'orderedList',
                                                'blockquote',
                                                'codeBlock',
                                                'undo',
                                                'redo',
                                            ])
                                            ->placeholder('Viết nội dung bài viết tại đây...')
                                            ->columnSpanFull(),
                                    ]),
                                
                                Forms\Components\Section::make('Hình ảnh nổi bật')
                                    ->description('Hình ảnh đại diện cho bài viết')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Chọn ảnh nổi bật')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('posts')
                                            ->maxSize(2048)
                                            ->helperText('Khuyến nghị: 1200x630px. Tối đa 2MB')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('Xuất bản')
                            ->icon('heroicon-o-calendar')
                            ->schema([
                                Forms\Components\Section::make('Lịch xuất bản')
                                    ->description('Thiết lập thời gian xuất bản bài viết')
                                    ->schema([
                                        Forms\Components\DateTimePicker::make('published_at')
                                            ->label('Ngày & giờ xuất bản')
                                            ->placeholder('Chọn ngày giờ xuất bản')
                                            ->helperText('Để trống = xuất bản ngay lập tức')
                                            ->native(false)
                                            ->displayFormat('d/m/Y H:i')
                                            ->seconds(false)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\Section::make('Tối ưu hóa SEO')
                                    ->description('Cải thiện thứ hạng tìm kiếm')
                                    ->icon('heroicon-o-chart-bar')
                                    ->schema([
                                        Forms\Components\TextInput::make('seo_title')
                                            ->label('Tiêu đề SEO')
                                            ->maxLength(60)
                                            ->placeholder('Tối đa 60 ký tự')
                                            ->helperText('Hiển thị trên Google Search')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\Textarea::make('seo_description')
                                            ->label('Mô tả SEO')
                                            ->maxLength(160)
                                            ->rows(3)
                                            ->placeholder('Tối đa 160 ký tự')
                                            ->helperText('Mô tả ngắn gọn cho Google')
                                            ->columnSpanFull(),
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
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Ảnh nổi bật')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề bài viết')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->excerpt ? \Str::limit($record->excerpt, 60) : null)
                    ->wrap(),
                
                Tables\Columns\IconColumn::make('published_at')
                    ->label('Xuất bản')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable()
                    ->tooltip(fn ($record) => $record->published_at 
                        ? 'Đã xuất bản: ' . $record->published_at->format('d/m/Y H:i')
                        : 'Bản nháp'),
                
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Ngày xuất bản')
                    ->date('d/m/Y')
                    ->sortable()
                    ->placeholder('Chưa xuất bản')
                    ->toggleable(),
                
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
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('published')
                    ->label('Đã xuất bản')
                    ->query(fn ($query) => $query->whereNotNull('published_at')),
                
                Tables\Filters\Filter::make('draft')
                    ->label('Bản nháp')
                    ->query(fn ($query) => $query->whereNull('published_at')),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

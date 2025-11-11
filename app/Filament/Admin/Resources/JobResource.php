<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Công việc';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Thông tin công việc')
                            ->icon('heroicon-o-briefcase')
                            ->schema([
                                Forms\Components\Section::make('Thông tin cơ bản')
                                    ->description('Tiêu đề và vị trí tuyển dụng')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Tiêu đề tin tuyển dụng')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('VD: Tuyển Senior Developer Backend')
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('Đường dẫn (URL)')
                                            ->maxLength(255)
                                            ->placeholder('tuyen-senior-developer')
                                            ->helperText('Để trống để tự động tạo')
                                            ->columnSpanFull(),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('position')
                                                    ->label('Chức vụ / Vị trí')
                                                    ->maxLength(255)
                                                    ->placeholder('VD: Senior Developer')
                                                    ->datalist([
                                                        'Junior Developer',
                                                        'Senior Developer',
                                                        'Team Leader',
                                                        'Project Manager',
                                                        'Business Analyst',
                                                        'Designer',
                                                    ]),

                                                Forms\Components\TextInput::make('employment_type')
                                                    ->label('Loại hình công việc')
                                                    ->maxLength(255)
                                                    ->placeholder('VD: Full-time, Part-time')
                                                    ->datalist([
                                                        'Full-time',
                                                        'Part-time',
                                                        'Contract',
                                                        'Internship',
                                                        'Remote',
                                                    ]),

                                                Forms\Components\TextInput::make('location')
                                                    ->label('Địa điểm làm việc')
                                                    ->maxLength(255)
                                                    ->placeholder('VD: Hà Nội, TP.HCM')
                                                    ->suffixIcon('heroicon-o-map-pin'),

                                                Forms\Components\TextInput::make('salary_range')
                                                    ->label('Mức lương')
                                                    ->maxLength(255)
                                                    ->placeholder('VD: 15-25 triệu, Thỏa thuận')
                                                    ->suffixIcon('heroicon-o-currency-dollar'),
                                            ]),
                                    ]),

                                Forms\Components\Section::make('Mô tả chi tiết')
                                    ->description('Nội dung mô tả công việc')
                                    ->icon('heroicon-o-document')
                                    ->schema([
                                        Forms\Components\RichEditor::make('description')
                                            ->label('Mô tả công việc')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'bulletList',
                                                'orderedList',
                                                'heading',
                                                'undo',
                                                'redo',
                                            ])
                                            ->placeholder('Mô tả chi tiết về công việc...')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Yêu cầu & Quyền lợi')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                Forms\Components\Section::make('Yêu cầu ứng viên')
                                    ->description('Các yêu cầu cần thiết cho ứng viên')
                                    ->icon('heroicon-o-check-circle')
                                    ->schema([
                                        Forms\Components\Textarea::make('requirements')
                                            ->label('Yêu cầu công việc')
                                            ->rows(6)
                                            ->placeholder("VD:\n- Tốt nghiệp Đại học chuyên ngành CNTT\n- 3+ năm kinh nghiệm PHP/Laravel\n- Biết MySQL, Git, Docker")
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Quyền lợi')
                                    ->description('Chế độ đãi ngộ và phúc lợi')
                                    ->icon('heroicon-o-gift')
                                    ->schema([
                                        Forms\Components\Textarea::make('benefits')
                                            ->label('Quyền lợi được hưởng')
                                            ->rows(6)
                                            ->placeholder("VD:\n- Lương tháng 13, thưởng dự án\n- Bảo hiểm đầy đủ\n- Du lịch hàng năm\n- Laptop + thiết bị làm việc")
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Liên hệ & Xuất bản')
                            ->icon('heroicon-o-envelope')
                            ->schema([
                                Forms\Components\Section::make('Thông tin liên hệ')
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_email')
                                            ->label('Email nhận hồ sơ')
                                            ->email()
                                            ->placeholder('hr@starvik.vn')
                                            ->suffixIcon('heroicon-o-envelope')
                                            ->helperText('Email để ứng viên gửi CV')
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Thời gian xuất bản')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\DateTimePicker::make('published_at')
                                                    ->label('Ngày đăng tuyển')
                                                    ->native(false)
                                                    ->displayFormat('d/m/Y H:i')
                                                    ->seconds(false)
                                                    ->helperText('Thời gian bắt đầu tuyển dụng'),

                                                Forms\Components\Toggle::make('published')
                                                    ->label('Trạng thái tuyển dụng')
                                                    ->helperText('Bật = Đang tuyển, Tắt = Đã đóng')
                                                    ->default(true)
                                                    ->inline(false),
                                            ]),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề công việc')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->position)
                    ->wrap(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Địa điểm')
                    ->icon('heroicon-o-map-pin')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('employment_type')
                    ->label('Loại hình')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Full-time' => 'success',
                        'Part-time' => 'warning',
                        'Contract' => 'info',
                        'Remote' => 'primary',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('salary_range')
                    ->label('Mức lương')
                    ->icon('heroicon-o-currency-dollar')
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('published')
                    ->label('Đang tuyển')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Ngày đăng')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Trạng thái tuyển dụng')
                    ->placeholder('Tất cả')
                    ->trueLabel('Đang tuyển')
                    ->falseLabel('Đã đóng')
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}

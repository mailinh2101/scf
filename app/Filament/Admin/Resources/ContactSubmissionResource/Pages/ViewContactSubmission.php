<?php

namespace App\Filament\Admin\Resources\ContactSubmissionResource\Pages;

use App\Filament\Admin\Resources\ContactSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactSubmission extends ViewRecord
{
    protected static string $resource = ContactSubmissionResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_as_read')
                ->label('Đánh dấu đã đọc')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->action(function () {
                    $this->record->update(['status' => 'read']);
                    $this->refreshFormData(['status']);
                })
                ->visible(fn () => $this->record->status === 'pending'),
            
            Actions\Action::make('mark_as_replied')
                ->label('Đánh dấu đã trả lời')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function () {
                    $this->record->update(['status' => 'replied']);
                    $this->refreshFormData(['status']);
                })
                ->visible(fn () => $this->record->status !== 'replied'),
        ];
    }
}

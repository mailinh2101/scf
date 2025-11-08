<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'message',
        'cv_path',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the application status label
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            'new' => 'Mới',
            'reviewing' => 'Đang xem xét',
            'shortlisted' => 'Đã rút gọn',
            'interviewed' => 'Đã phỏng vấn',
            'rejected' => 'Từ chối',
            'accepted' => 'Chấp nhận',
        ];

        return $statuses[$this->status] ?? 'Không xác định';
    }

    /**
     * Scope: Get new applications
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new')->orderBy('created_at', 'desc');
    }

    /**
     * Scope: Get applications for a specific position
     */
    public function scopeForPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Scope: Get applications from a date range
     */
    public function scopeFromDate($query, $date)
    {
        return $query->where('created_at', '>=', $date);
    }
}
